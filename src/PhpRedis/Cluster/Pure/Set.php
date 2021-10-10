<?php

declare(strict_types=1);

namespace PB\Redis\PhpRedis\Cluster\Pure;

use PB\Redis\PhpRedis\Cluster\PhpRedisCluster;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
final class Set extends PhpRedisCluster
{
    /**
     * @param string $key
     * @param $value
     */
    public function __invoke(string $key, $value): void
    {
        $this->cluster()->set($key, $value);
    }
}
