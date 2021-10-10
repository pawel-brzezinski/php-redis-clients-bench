<?php

declare(strict_types=1);

namespace PB\Redis\PhpRedis\Cluster\Pure;

use PB\Redis\PhpRedis\Cluster\PhpRedisCluster;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
final class Get extends PhpRedisCluster
{
    /**
     * @param string $key
     */
    public function __invoke(string $key): void
    {
        $this->cluster()->get($key);
    }
}
