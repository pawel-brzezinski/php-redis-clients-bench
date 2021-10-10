<?php

declare(strict_types=1);

namespace PB\Redis\PhpRedis\Cluster;

use PB\Redis\RedisConfig;
use RedisCluster;
use RedisClusterException;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
abstract class PhpRedisCluster
{
    private const NODES = [
        RedisConfig::MASTER_NODE_1.':6379',
        RedisConfig::MASTER_NODE_2.':6379',
        RedisConfig::MASTER_NODE_3.':6379',
    ];

    private RedisCluster $cluster;

    /**
     * @throws RedisClusterException
     */
    public function __construct()
    {
        $this->createCluster();
    }

    /**
     * @return RedisCluster
     */
    public function cluster(): RedisCluster
    {
        return $this->cluster;
    }

    /**
     * @throws RedisClusterException
     */
    private function createCluster(): void
    {
        $this->cluster = new RedisCluster(
            null,
            self::NODES,
            10,
            10,
            true,
            RedisConfig::AUTH
        );
    }
}
