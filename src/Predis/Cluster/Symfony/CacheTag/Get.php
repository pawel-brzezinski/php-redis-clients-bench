<?php

declare(strict_types=1);

namespace PB\Redis\Predis\Cluster\Symfony\CacheTag;

use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\CacheItem;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
final class Get extends SymfonyCacheTagPredisCluster
{
    /**
     * @param string $key
     *
     * @return CacheItem
     *
     * @throws InvalidArgumentException
     */
    public function __invoke(string $key): CacheItem
    {
        return $this->pool()->getItem($key);
    }
}
