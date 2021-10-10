<?php

declare(strict_types=1);

namespace PB\Redis\PhpRedis\Cluster\Symfony\Cache;

use PB\Redis\PhpRedis\Cluster\PhpRedisCluster;
use RedisClusterException;
use Symfony\Component\Cache\Adapter\RedisAdapter;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
abstract class SymfonyCachePhpRedisCluster extends PhpRedisCluster
{
    private RedisAdapter $pool;

    /**
     * @throws RedisClusterException
     */
    public function __construct()
    {
        parent::__construct();
        $this->createPool();
    }

    /**
     * @return RedisAdapter
     */
    public function pool(): RedisAdapter
    {
        return $this->pool;
    }

    /**
     *
     */
    private function createPool(): void
    {
        $this->pool = new RedisAdapter($this->cluster());
    }
}
