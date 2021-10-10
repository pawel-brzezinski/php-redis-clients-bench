<?php

declare(strict_types=1);

namespace PB\Redis\Predis\Cluster\Symfony\CacheTag;

use Psr\Cache\InvalidArgumentException;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
final class Save extends SymfonyCacheTagPredisCluster
{
    /**
     * @param string $key
     * @param $value
     * @param array $tags
     *
     * @throws InvalidArgumentException
     */
    public function __invoke(string $key, $value, array $tags): void
    {
        $cacheItem = $this->pool()->getItem($key);
        $cacheItem->set($value);
        $cacheItem->tag($tags);

        $this->pool()->save($cacheItem);
    }
}
