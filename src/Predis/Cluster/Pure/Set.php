<?php

declare(strict_types=1);

namespace PB\Redis\Predis\Cluster\Pure;

use PB\Redis\Predis\Cluster\PredisCluster;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
final class Set extends PredisCluster
{
    /**
     * @param string $key
     * @param $value
     */
    public function __invoke(string $key, $value): void
    {
        $this->client()->set($key, $value);
    }
}
