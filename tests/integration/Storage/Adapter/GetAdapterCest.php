<?php

/**
 * This file is part of the Phalcon Framework.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Phalcon\Test\Integration\Storage\Adapter;

use Codeception\Example;
use Memcached as NativeMemcached;
use Phalcon\Storage\Adapter\Apcu;
use Phalcon\Storage\Adapter\Libmemcached;
use Phalcon\Storage\Adapter\Memory;
use Phalcon\Storage\Adapter\Redis;
use Phalcon\Storage\Adapter\Stream;
use Phalcon\Storage\SerializerFactory;
use Redis as NativeRedis;
use IntegrationTester;

use function array_merge;
use function getOptionsLibmemcached;
use function getOptionsRedis;
use function outputDir;
use function uniqid;

class GetAdapterCest
{
    /**
     * Tests Phalcon\Storage\Adapter\* :: getAdapter()
     *
     * @dataProvider getExamples
     *
     * @author Phalcon Team <team@phalcon.io>
     * @since  2020-09-09
     */
    public function storageAdapterGetAdapter(IntegrationTester $I, Example $example)
    {
        $I->wantToTest(
            'Storage\Adapter\'' . $example['className'] . ' - getAdapter()'
        );

        $extension  = $example['extension'];
        $class      = $example['class'];
        $options    = $example['options'];

        if (!empty($extension)) {
            $I->checkExtensionIsLoaded($extension);
        }

        $serializer = new SerializerFactory();
        $adapter = new $class($serializer, $options);

        $expected = $example['expected'];
        $actual   = $adapter->getAdapter();

        if (null === $expected) {
            $I->assertNull($actual);
        } else {
            $I->assertInstanceOf($expected, $actual);
        }
    }

    /**
     * @return array[]
     */
    private function getExamples(): array
    {
        return [
            [
                'className' => 'Apcu',
                'class'     => Apcu::class,
                'options'   => [],
                'expected'  => null,
                'extension' => 'apcu',
            ],
            [
                'className' => 'Libmemcached',
                'class'     => Libmemcached::class,
                'options'   => getOptionsLibmemcached(),
                'expected'  => NativeMemcached::class,
                'extension' => 'memcached',
            ],
            [
                'className' => 'Memory',
                'label'     => 'default',
                'class'     => Memory::class,
                'options'   => [],
                'expected'  => null,
                'extension' => '',
            ],
            [
                'className' => 'Redis',
                'label'     => 'default',
                'class'     => Redis::class,
                'options'   => getOptionsRedis(),
                'expected'  => NativeRedis::class,
                'extension' => 'redis',
            ],
            [
                'className' => 'Stream',
                'label'     => 'default',
                'class'     => Stream::class,
                'options'   => [
                    'storageDir' => outputDir(),
                ],
                'expected'  => null,
                'extension' => '',
            ],
        ];
    }
}
