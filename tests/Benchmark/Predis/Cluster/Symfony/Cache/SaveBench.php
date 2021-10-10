<?php

declare(strict_types=1);

namespace PB\Redis\Tests\Benchmark\Predis\Cluster\Symfony\Cache;

use PB\Redis\Predis\Cluster\Symfony\Cache\Save;
use PB\Redis\Tests\Benchmark\Predis\AbstractPredis;
use PhpBench\Benchmark\Metadata\Annotations\{Groups, Iterations, Revs};
use Psr\Cache\InvalidArgumentException;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 *
 * @BeforeClassMethods({"setUpBeforeClass"})
 * @BeforeMethods("setUpSave")
 * @Groups({"predis", "sf-cache-save", "sf-cache-no-tag-save"})
 */
final class SaveBench extends AbstractPredis
{
    /**
     *
     */
    public static function setUpBeforeClass(): void
    {
        self::flushRedis();
    }

    /**
     * @Iterations(50)
     * @Revs(50)
     *
     * @throws InvalidArgumentException
     */
    public function benchPredisClusterSymfonyCacheSave(): void
    {
        (self::createObjectUnderTest())($this->cacheKey, $this->cacheValue);
    }

    /**
     * {@inheritDoc}
     */
    protected static function createObjectUnderTest(): Save
    {
        return new Save();
    }
}
