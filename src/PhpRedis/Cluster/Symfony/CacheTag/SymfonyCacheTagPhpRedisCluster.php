<?php

declare(strict_types=1);

namespace PB\Redis\PhpRedis\Cluster\Symfony\CacheTag;

use PB\Redis\PhpRedis\Cluster\PhpRedisCluster;
use Symfony\Component\Cache\Adapter\{RedisAdapter, TagAwareAdapter};
use RedisClusterException;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
abstract class SymfonyCacheTagPhpRedisCluster extends PhpRedisCluster
{
    private TagAwareAdapter $pool;

    /**
     * @throws RedisClusterException
     */
    public function __construct()
    {
        parent::__construct();
        $this->createPool();
    }

    /**
     * @return TagAwareAdapter
     */
    public function pool(): TagAwareAdapter
    {
        return $this->pool;
    }

    /**
     *
     */
    private function createPool(): void
    {
        $this->pool = new TagAwareAdapter(new RedisAdapter($this->cluster()));
    }
}
