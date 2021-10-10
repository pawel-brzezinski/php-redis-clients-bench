<?php

declare(strict_types=1);

namespace PB\Redis\Tests\Benchmark\Fake;

use Assert\AssertionFailedException;
use PB\Component\CQRS\Domain\DateTime\Exception\DateTimeException;
use PB\Component\CQRS\Domain\DateTime\ValueObject\DateTime;
use PB\Component\CQRS\Domain\String\ValueObject\NonEmpty;
use PB\Component\FirstAid\Accessor\ValueAccessorTrait;
use PB\Component\FirstAidTests\Faker\FakerTrait;
use PB\Redis\Tests\Benchmark\Fake\Article\Category;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 *
 * @method NonEmpty uuid()
 * @method Category category()
 * @method NonEmpty title()
 * @method NonEmpty text()
 * @method Category[] additionalCategories()
 * @method DateTime createdAt()
 * @method DateTime updatedAt()
 */
final class Article
{
    use FakerTrait;

    use ValueAccessorTrait;

    private NonEmpty $uuid;

    private Category $category;

    private NonEmpty $title;

    private NonEmpty $text;

    /** @var Category[] */
    private array $additionalCategories;

    private DateTime $createdAt;

    private DateTime $updatedAt;

    /**
     * @param NonEmpty $uuid
     * @param Category $category
     * @param NonEmpty $title
     * @param NonEmpty $text
     * @param array $additionalCategories
     * @param DateTime $createdAt
     * @param DateTime $updatedAt
     */
    public function __construct(
        NonEmpty $uuid,
        Category $category,
        NonEmpty $title,
        NonEmpty $text,
        array $additionalCategories,
        DateTime $createdAt,
        DateTime $updatedAt
    ) {
        $this->uuid = $uuid;
        $this->category = $category;
        $this->title = $title;
        $this->text = $text;
        $this->additionalCategories = $additionalCategories;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
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
            Category::fake(),
            NonEmpty::fromString($faker->sentence(10)),
            NonEmpty::fromString($faker->realText(2000)),
            [Category::fake(), Category::fake(), Category::fake()],
            DateTime::fromString($faker->dateTime()->format('c')),
            DateTime::fromString($faker->dateTime()->format('c'))
        );
    }
}
