<?php

/**
 * This file is part of the Phalcon Framework.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Phalcon\Test\Unit\Security\JWT\Builder;

use Phalcon\Security\JWT\Builder;
use Phalcon\Security\JWT\Signer\Hmac;
use UnitTester;

class GetSetIssuerCest
{
    /**
     * Unit Tests Phalcon\Security\JWT\Builder :: getIssuer()/setIssuer()
     *
     * @author Phalcon Team <team@phalcon.io>
     * @since  2019-12-22
     */
    public function securityJWTBuilderGetSetIssuer(UnitTester $I)
    {
        $I->wantToTest('Security\JWT\Builder - getIssuer()/setIssuer()');

        $signer  = new Hmac();
        $builder = new Builder($signer);

        $I->assertNull($builder->getIssuer());

        $return = $builder->setIssuer('issuer');
        $I->assertInstanceOf(Builder::class, $return);

        $I->assertEquals('issuer', $builder->getIssuer());
    }
}
