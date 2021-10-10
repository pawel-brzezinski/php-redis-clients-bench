<?php

declare(strict_types=1);

namespace PB\Redis\Tests\Benchmark;

use Assert\AssertionFailedException;
use PB\Component\CQRS\Domain\DateTime\Exception\DateTimeException;
use PB\Redis\Tests\Benchmark\Fake\Article;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\{AdapterInterface, TagAwareAdapterInterface};

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
abstract class AbstractRedis
{
    protected const CACHE_TAGS = ['tag-1', 'tag-2', 'tag-3', 'tag-4', 'tag-5'];

    protected string $cacheKey;

    protected Article $cacheValue;

    /**
     * @throws AssertionFailedException
     * @throws DateTimeException
     */
    public function setUpSave(): void
    {
        $this->cacheValue = Article::fake();
        $this->cacheKey = $this->cacheValue->uuid()->toString();
    }

    /**
     * @return mixed
     */
    abstract protected static function createObjectUnderTest();

    /**
     *
     */
    abstract protected static function flushRedis(): void;

    /**
     * @param int $count
     */
    abstract protected static function fillRedis(int $count): void;

    /**
     * @return string
     */
    protected static function loremText(): string
    {
        return file_get_contents(__DIR__.'/Fake/lorem.txt');
    }

    /**
     * @param int $count
     *
     * @throws AssertionFailedException
     * @throws DateTimeException
     * @throws InvalidArgumentException
     */
    protected static function fillSymfonyCache(int $count): void
    {
        /** @var AdapterInterface|TagAwareAdapterInterface $pool */
        $pool = static::createObjectUnderTest()->pool();
        $value = Article::fake();

        for ($i = 1; $i <= $count; $i++) {
            $key = 'key-'.$i;

            $cacheItem = $pool->getItem($key);
            $cacheItem->set($value);
            $cacheItem->tag(self::CACHE_TAGS);

            $pool->save($cacheItem);
        }
    }
}
