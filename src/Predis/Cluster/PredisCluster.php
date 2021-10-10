<?php

declare(strict_types=1);

namespace PB\Redis\Predis\Cluster;

use PB\Redis\RedisConfig;
use Predis\Client;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
abstract class PredisCluster
{
    private const CLUSTER_TYPE = 'redis';
    private const NODES = [
        'tcp://'.RedisConfig::MASTER_NODE_1,
        'tcp://'.RedisConfig::MASTER_NODE_2,
        'tcp://'.RedisConfig::MASTER_NODE_3,
    ];

    private Client $client;

    /**
     *
     */
    public function __construct()
    {
        $this->createClient();
    }

    /**
     * @return Client
     */
    public function client(): Client
    {
        return $this->client;
    }

    /**
     *
     */
    private function createClient(): void
    {
        $this->client = new Client(self::NODES, [
            'cluster' => self::CLUSTER_TYPE,
            'parameters' => [
                'password' => RedisConfig::AUTH,
            ],
        ]);
    }
}
