<?php
declare(strict_types=1);

namespace ElasticTests;

use PHPUnit\Framework\TestCase;
use think\App;

class BaseTest extends TestCase
{
    /**
     * @var App
     */
    protected App $app;

    public function setUp(): void
    {
        parent::setUp();
        $this->app = new App();
        $this->app->initialize();
    }
}