<?php

/**
 * This file is part of the Phalcon Framework.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Phalcon\Test\Unit\Security\JWT\Signer\None;

use Phalcon\Security\JWT\Signer\None;
use UnitTester;

class ConstructCest
{
    /**
     * Unit Tests Phalcon\Security\JWT\Signer\None :: __construct()
     *
     * @author Phalcon Team <team@phalcon.io>
     * @since  2019-12-22
     */
    public function securityJWTSignerNoneConstruct(UnitTester $I)
    {
        $I->wantToTest('Security\JWT\Signer\None - __construct()');

        $signer = new None();
        $I->assertInstanceOf(None::class, $signer);
    }
}
