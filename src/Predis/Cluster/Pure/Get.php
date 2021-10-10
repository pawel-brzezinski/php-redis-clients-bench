<?php

declare(strict_types=1);

namespace PB\Redis\Predis\Cluster\Pure;

use PB\Redis\Predis\Cluster\PredisCluster;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
final class Get extends PredisCluster
{
    /**
     * @param string $key
     *
     * @return string|null
     */
    public function __invoke(string $key): ?string
    {
        return $this->client()->get($key);
    }
}
