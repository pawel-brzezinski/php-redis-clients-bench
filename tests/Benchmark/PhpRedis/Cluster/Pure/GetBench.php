<?php

declare(strict_types=1);

namespace PB\Redis\Tests\Benchmark\PhpRedis\Cluster\Pure;

use PB\Redis\PhpRedis\Cluster\Pure\Get;
use PhpBench\Benchmark\Metadata\Annotations\{Groups, Iterations, Revs};
use PB\Redis\Tests\Benchmark\PhpRedis\AbstractPhpRedis;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 *
 * @BeforeClassMethods({"setUpBeforeClass"})
 * @Groups({"phpredis", "get-string"})
 */
final class GetBench extends AbstractPhpRedis
{
    /**
     *
     */
    public static function setUpBeforeClass(): void
    {
        self::flushRedis();
        self::fillRedis(1000);
    }

    /**
     * @Iterations(50)
     * @Revs(50)
     */
    public function benchPhpRedisClusterGetStringValue(): void
    {
        $key = 'key-86';
        (self::createObjectUnderTest())($key);
    }

    /**
     * @return Get
     */
    protected static function createObjectUnderTest(): Get
    {
        return new Get();
    }
}
