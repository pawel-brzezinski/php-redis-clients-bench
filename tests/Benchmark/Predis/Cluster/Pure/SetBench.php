<?php

declare(strict_types=1);

namespace PB\Redis\Tests\Benchmark\Predis\Cluster\Pure;

use PB\Component\FirstAidTests\Faker\FakerTrait;
use PB\Redis\Predis\Cluster\Pure\Set;
use PhpBench\Benchmark\Metadata\Annotations\{Groups, Iterations, Revs};
use PB\Redis\Tests\Benchmark\Predis\AbstractPredis;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 *
 * @BeforeClassMethods({"setUpBeforeClass"})
 * @Groups({"predis", "set-string"})
 */
final class SetBench extends AbstractPredis
{
    use FakerTrait;

    /**
     *
     */
    public static function setUpBeforeClass(): void
    {
        self::flushRedis();
    }

    /**
     * @Iterations(10)
     * @Revs(100)
     */
    public function benchPredisClusterSetStringValue(): void
    {
        $key = self::getFaker()->uuid();
        $value = self::loremText();

        (self::createObjectUnderTest())($key, $value);
    }

    /**
     * @return Set
     */
    protected static function createObjectUnderTest(): Set
    {
        return new Set();
    }
}
