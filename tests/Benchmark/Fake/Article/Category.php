<?php

declare(strict_types=1);

namespace PB\Redis\Tests\Benchmark\Fake\Article;

use Assert\AssertionFailedException;
use PB\Component\CQRS\Domain\DateTime\Exception\DateTimeException;
use PB\Component\CQRS\Domain\DateTime\ValueObject\DateTime;
use PB\Component\CQRS\Domain\String\ValueObject\NonEmpty;
use PB\Component\FirstAid\Accessor\ValueAccessorTrait;
use PB\Component\FirstAidTests\Faker\FakerTrait;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 *
 * @method NonEmpty uuid()
 * @method NonEmpty name()
 * @method NonEmpty url()
 * @method NonEmpty[] children()
 * @method DateTime[] createdAt()
 */
final class Category
{
    use FakerTrait;

    use ValueAccessorTrait;

    private NonEmpty $uuid;

    private NonEmpty $name;

    private NonEmpty $url;

    /** @var NonEmpty[] */
    private array $children;

    private DateTime $createdAt;

    /**
     * @param NonEmpty $uuid
     * @param NonEmpty $name
     * @param NonEmpty $url
     * @param array $children
     * @param DateTime $createdAt
     */
    public function __construct(
        NonEmpty $uuid,
        NonEmpty $name,
        NonEmpty $url,
        array $children,
        DateTime $createdAt
    ) {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->url = $url;
        $this->children = $children;
        $this->createdAt = $createdAt;
    }

    /**
     * @return static
     *
     * @throws AssertionFailedException
     * @throws DateTimeException
     */
    public static function fake(): self
    {
        $faker = self::getFaker();

        return new self(
            NonEmpty::fromString($faker->uuid()),
            NonEmpty::fromString($faker->sentence()),
            NonEmpty::fromString($faker->url()),
            [NonEmpty::fromString($faker->word()), NonEmpty::fromString($faker->word()), NonEmpty::fromString($faker->word())],
            DateTime::fromString($faker->dateTime()->format('c'))
        );
    }
}
