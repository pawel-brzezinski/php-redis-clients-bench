<?php

declare(strict_types=1);

namespace PB\Redis\Predis\Cluster\Symfony\Cache;

use PB\Redis\Predis\Cluster\PredisCluster;
use Symfony\Component\Cache\Adapter\RedisAdapter;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
abstract class SymfonyCachePredisCluster extends PredisCluster
{
    private RedisAdapter $pool;

    /**
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->createPool();
    }

    /**
     * @return RedisAdapter
     */
    public function pool(): RedisAdapter
    {
        return $this->pool;
    }

    /**
     *
     */
    private function createPool(): void
    {
        $this->pool = new RedisAdapter($this->client());
    }
}
