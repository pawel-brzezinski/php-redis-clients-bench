<?php

declare(strict_types=1);

namespace PB\Redis\Tests\Benchmark\Predis\Cluster\Symfony\CacheTag;

use PB\Redis\Predis\Cluster\Symfony\CacheTag\Save;
use PB\Redis\Tests\Benchmark\Predis\AbstractPredis;
use PhpBench\Benchmark\Metadata\Annotations\{Groups, Iterations, Revs};
use Psr\Cache\InvalidArgumentException;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 *
 * @BeforeClassMethods({"setUpBeforeClass"})
 * @BeforeMethods("setUpSave")
 * @Groups({"predis", "sf-cache-save", "sf-cache-tag-save"})
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
    public function benchPredisClusterSymfonyCacheTagSave(): void
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
