<?php
/**
 * Created by PhpStorm.
 * User: liuwave
 * Date: 2020/2/27 15:53
 * Description:
 */
use think\facade\Env;
return [
  'default' => [
      // 集群连接
    'hosts' => explode(',', Env::get('elasticsearch.hosts', 'localhost:9200')),
      // 重试次数
    'retries' => 0,
      // 公共CA证书
    'SSLVerification' => null,
      // 开启日志
    'logger' => null,
      // 配置 HTTP Handler
    'handler' => null,
      // 设置连接池
    'connectionPool' => Elasticsearch\ConnectionPool\StaticNoPingConnectionPool::class,
      // 设置选择器
    'selector' => Elasticsearch\ConnectionPool\Selectors\RoundRobinSelector::class,
      // 设置序列化器
    'serializer' => Elasticsearch\Serializers\SmartSerializer::class
  ]
];