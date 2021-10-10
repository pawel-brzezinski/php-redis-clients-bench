<?php

declare(strict_types=1);

namespace PB\Redis\Tests\Benchmark\Predis\Cluster\Pure;

use PB\Redis\Predis\Cluster\Pure\Get;
use PhpBench\Benchmark\Metadata\Annotations\{Groups, Iterations, Revs};
use PB\Redis\Tests\Benchmark\Predis\AbstractPredis;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 *
 * @BeforeClassMethods({"setUpBeforeClass"})
 * @Groups({"predis", "get-string"})
 */
final class GetBench extends AbstractPredis
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
    public function benchPredisClusterGetStringValue(): void
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
