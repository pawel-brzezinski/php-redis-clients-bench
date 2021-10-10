<?php

declare(strict_types=1);

namespace PB\Redis\Predis\Cluster\Symfony\CacheTag;

use PB\Redis\Predis\Cluster\PredisCluster;
use Symfony\Component\Cache\Adapter\{RedisAdapter, TagAwareAdapter};

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
abstract class SymfonyCacheTagPredisCluster extends PredisCluster
{
    private TagAwareAdapter $pool;

    /**
     *
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
        $this->pool = new TagAwareAdapter(new RedisAdapter($this->client()));
    }
}
