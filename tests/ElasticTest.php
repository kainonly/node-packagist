<?php
declare(strict_types=1);

namespace ElasticTests;

use think\elastic\ElasticFactory;
use think\elastic\ElasticService;

class ElasticTest extends BaseTest
{
    /**
     * @var ElasticFactory
     */
    private $elastic;

    public function setUp(): void
    {
        parent::setUp();
        $this->app->register(ElasticService::class);
        $this->elastic = $this->app->get('elasticsearch');
    }

    public function testIndex(): void
    {
        $response = $this->elastic->client()->index([
            'index' => 'test',
            'id' => 'one',
            'body' => [
                'name' => 'elastic',
                'value' => 1
            ]
        ]);
        self::assertNotEmpty($response);
        self::assertEquals(1, $response['_shards']['successful']);
    }

    public function testDelete(): void
    {
        $response = $this->elastic->client()->delete([
            'index' => 'test',
            'id' => 'one'
        ]);
        self::assertNotEmpty($response);
        self::assertEquals(1, $response['_shards']['successful']);
    }
}