<?php

declare(strict_types=1);

namespace PB\Redis\Tests\Benchmark\Predis\Cluster\Symfony\Cache;

use Assert\AssertionFailedException;
use PB\Component\CQRS\Domain\DateTime\Exception\DateTimeException;
use PB\Redis\Predis\Cluster\Symfony\Cache\Get;
use PB\Redis\Tests\Benchmark\Predis\AbstractPredis;
use PhpBench\Benchmark\Metadata\Annotations\{Groups, Iterations, Revs};
use Psr\Cache\InvalidArgumentException;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 *
 * @BeforeClassMethods({"setUpBeforeClass"})
 * @Groups({"predis", "sf-cache-get", "sf-cache-no-tag-get"})
 */
final class GetBench extends AbstractPredis
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
    public function benchPredisClusterSymfonyCacheGet(): void
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
