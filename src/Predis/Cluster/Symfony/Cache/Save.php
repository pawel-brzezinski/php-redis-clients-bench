<?php

declare(strict_types=1);

namespace PB\Redis\Predis\Cluster\Symfony\Cache;

use Psr\Cache\InvalidArgumentException;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
final class Save extends SymfonyCachePredisCluster
{
    /**
     * @param string $key
     * @param $value
     *
     * @throws InvalidArgumentException
     */
    public function __invoke(string $key, $value): void
    {
        $cacheItem = $this->pool()->getItem($key);
        $cacheItem->set($value);

        $this->pool()->save($cacheItem);
    }
}
