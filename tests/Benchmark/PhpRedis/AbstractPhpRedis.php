<?php

declare(strict_types=1);

namespace PB\Redis\Tests\Benchmark\PhpRedis;

use PB\Component\FirstAidTests\Faker\FakerTrait;
use PB\Redis\PhpRedis\Cluster\PhpRedisCluster;
use PB\Redis\PhpRedis\Cluster\Pure\Set;
use PB\Redis\RedisConfig;
use PB\Redis\Tests\Benchmark\AbstractRedis;
use Redis;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
abstract class AbstractPhpRedis extends AbstractRedis
{
    use FakerTrait;

    /**
     *
     */
    protected static function flushRedis(): void
    {
        /** @var PhpRedisCluster $objectUnderTest */
        $objectUnderTest = static::createObjectUnderTest();

        foreach ($objectUnderTest->cluster()->_masters() as [$host, $port]) {
            $master = new Redis();
            $master->connect($host, $port);
            $master->auth(RedisConfig::AUTH);
            $master->flushAll();
        }
    }

    /**
     * {@inheritDoc}
     */
    protected static function fillRedis(int $count): void
    {
        $value = self::loremText();

        for ($i = 1; $i <= $count; $i++) {
            $key = 'key-'.$i;

            (new Set())($key, $value);
        }
    }
}
