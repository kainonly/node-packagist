<?php
declare (strict_types=1);

namespace think\elastic\service;

use think\elastic\common\ElasticFactory;
use think\Service;

class ElasticService extends Service
{
    public function register(): void
    {
        $this->app->bind('elasticsearch', function () {
            $config = $this->app->config
                ->get('database.elasticsearch');

            return new ElasticFactory($config);
        });
    }
}