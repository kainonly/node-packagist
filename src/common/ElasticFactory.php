<?php
declare (strict_types=1);

namespace think\elastic\common;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use InvalidArgumentException;

class ElasticFactory
{
    /**
     * 配置
     * @var array
     */
    private array $options;

    /**
     * 客户端集合
     * @var array
     */
    private array $clients;

    /**
     * ElasticFactory constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }

    /**
     * 客户端生产
     * @param array $option 客户端配置
     * @return Client
     */
    private function factory(array $option): Client
    {
        $clientBuilder = ClientBuilder::create()
            ->setHosts($option['hosts'])
            ->setRetries($option['retries'])
            ->setConnectionPool($option['connectionPool'])
            ->setSelector($option['selector'])
            ->setSerializer($option['serializer']);

        if (!empty($option['SSLVerification'])) {
            $clientBuilder->setSSLVerification($option['SSLVerification']);
        }

        if (!empty($option['logger'])) {
            $clientBuilder->setLogger($option['logger']);
        }

        if (!empty($option['handler'])) {
            $clientBuilder->setHandler($option['handler']);
        }

        return $clientBuilder->build();
    }

    /**
     * 创建 ElasticSearch 客户端
     * @param string $label 客户端配置标识
     * @return Client
     */
    public function client(string $label = 'default'): Client
    {
        if (!empty($this->clients[$label])) {
            return $this->clients[$label];
        }
        if (empty($this->options[$label])) {
            throw new InvalidArgumentException("The [$label] does not exist.");
        }
        $this->clients[$label] = $this->factory($this->options[$label]);
        return $this->clients[$label];
    }
}