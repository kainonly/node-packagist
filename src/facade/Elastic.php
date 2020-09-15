<?php
/**
 * Created by PhpStorm.
 * User: liuwave
 * Date: 2020/2/27 16:42
 * Description:
 */

namespace think\elastic\facade;

/**
 * Class Elastic
 * @package think\elastic\facade
 * @mixin \think\elastic\common\ElasticFactory;
 */
class Elastic extends \think\Facade
{
    
    /**
     * @return string
     */
    protected static function getFacadeClass()
    {
        return \think\elastic\common\ElasticFactory::class;
    }
}