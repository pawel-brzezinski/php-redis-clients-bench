<?php

declare(strict_types=1);

namespace PB\Redis\Tests\Benchmark\Predis;

use Predis\Command\{KeyDelete, KeyScan};
use PB\Component\FirstAidTests\Faker\FakerTrait;
use PB\Redis\Predis\Cluster\Pure\Set;
use PB\Redis\Tests\Benchmark\AbstractRedis;
use Predis\Connection\StreamConnection;

/**
 * @author Paweł Brzeziński <pawel.brzezinski@smartint.pl>
 */
abstract class AbstractPredis extends AbstractRedis
{
    use FakerTrait;

    /**
     *
     */
    protected static function flushRedis(): void
    {
        $scanCommand = new KeyScan();
        $scanCommand->setArguments([0, ['MATCH' => '*', 'COUNT' => 1000]]);

        /** @var StreamConnection $node */
        foreach (static::createObjectUnderTest()->client()->getConnection() as $node) {
            $result = $node->executeCommand($scanCommand);

            foreach ($result[1] as $key) {
                $delCommand = new KeyDelete();
                $delCommand->setArguments([$key]);

                $node->executeCommand($delCommand);
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    protected static function fillRedis(int $count): void
    {
        $value = self::loremText();

        for ($i = 1; $i <= $count; $i++) {
            $key = 'key-'.$i;

            (new Set())($key, $value);
        }
    }
}
