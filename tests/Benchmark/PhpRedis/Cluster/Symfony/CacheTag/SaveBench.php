<?php

declare(strict_types=1);

namespace PB\Redis\Tests\Benchmark\PhpRedis\Cluster\Symfony\CacheTag;

use PB\Redis\PhpRedis\Cluster\Symfony\CacheTag\Save;
use PB\Redis\Tests\Benchmark\PhpRedis\AbstractPhpRedis;
use PhpBench\Benchmark\Metadata\Annotations\{Groups, Iterations, Revs};
use Psr\Cache\InvalidArgumentException;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 *
 * @BeforeClassMethods({"setUpBeforeClass"})
 * @BeforeMethods("setUpSave")
 * @Groups({"phpredis", "sf-cache-save", "sf-cache-tag-save"})
 */
final class SaveBench extends AbstractPhpRedis
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
    public function benchPhpRedisClusterSymfonyCacheTagSave(): void
    {
        (self::createObjectUnderTest())($this->cacheKey, $this->cacheValue, self::CACHE_TAGS);
    }

    /**
     * {@inheritDoc}
     */
    protected static function createObjectUnderTest(): Save
    {
        return new Save();
    }
}
