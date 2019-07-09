const COS = require('cos-nodejs-sdk-v5');
const got = require('got');
const { env } = require('process');

const httpClient = got.extend({
  baseUrl: env.SOURCE,
  json: true,
});

const cos = new COS({
  SecretId: env.SECRETID,
  SecretKey: env.SECRETKEY,
});

const params = (args: any) => {
  return Object.assign({
    Bucket: env.BUCKET,
    Region: env.REGION,
  }, args);
};

const cosGet = (key: string) => new Promise((resolve, reject) => {
  cos.getObject(params({
    Key: key,
  }), (err: any, response: any) => {
    if (err) {
      reject(err);
    } else {
      resolve(response);
    }
  });
});

const cosPut = (key: string, data: any) => new Promise((resolve, reject) => {
  cos.putObject(params({
    Key: key,
    Body: Buffer.from(data),
  }), (err: any, response: any) => {
    if (err) {
      reject(err);
    } else {
      resolve(response);
    }
  });
});

const cosDelete = (key: string) => new Promise((resolve, reject) => {
  cos.deleteObject(params({
    Key: key,
  }), (err: any, response: any) => {
    if (err) {
      reject(err);
    } else {
      resolve(response);
    }
  });
});

export { httpClient };
