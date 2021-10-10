<?php

declare(strict_types=1);

namespace PB\Redis\Tests\Benchmark\PhpRedis\Cluster\Symfony\CacheTag;

use Assert\AssertionFailedException;
use PB\Component\CQRS\Domain\DateTime\Exception\DateTimeException;
use PB\Redis\PhpRedis\Cluster\Symfony\CacheTag\Get;
use PB\Redis\Tests\Benchmark\PhpRedis\AbstractPhpRedis;
use PhpBench\Benchmark\Metadata\Annotations\{Groups, Iterations, Revs};
use Psr\Cache\InvalidArgumentException;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 *
 * @BeforeClassMethods({"setUpBeforeClass"})
 * @Groups({"phpredis", "sf-cache-get", "sf-cache-tag-get"})
 */
final class GetBench extends AbstractPhpRedis
{
    /**
     * @throws AssertionFailedException
     * @throws InvalidArgumentException
     * @throws DateTimeException
     */
    public static function setUpBeforeClass(): void
    {
        self::flushRedis();
        self::fillSymfonyCache(100);
    }

    /**
     * @Iterations(50)
     * @Revs(50)
     *
     * @throws InvalidArgumentException
     */
    public function benchPhpRedisClusterSymfonyCacheTagGet(): void
    {
        (self::createObjectUnderTest())('key-100');
    }

    /**
     * {@inheritDoc}
     */
    protected static function createObjectUnderTest()
    {
        return new Get();
    }
}
