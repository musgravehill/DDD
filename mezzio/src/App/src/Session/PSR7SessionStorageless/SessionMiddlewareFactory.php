<?php

declare(strict_types=1);

namespace App\Session\PSR7SessionStorageless;

use Dflydev\FigCookies\Modifier\SameSite;
use Dflydev\FigCookies\SetCookie;
use Lcobucci\Clock\SystemClock;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer;
use Lcobucci\JWT\Signer\Key\InMemory;
use PSR7Sessions\Storageless\Http\SessionMiddleware;
//
use Psr\Container\ContainerInterface;

class SessionMiddlewareFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $key = 'mBC5v1sOKVvbdEitdSBenu59nfNfhwkedkJVNabosTw='; //TODO change key

        //return SessionMiddleware::fromSymmetricKeyDefaults(\Lcobucci\JWT\Signer\Key\InMemory::plainText($key),  60);

        return new SessionMiddleware(
            Configuration::forSymmetricSigner(
                new Signer\Hmac\Sha256(),
                InMemory::plainText($key)
            ),
            // Override the default `__Secure-slsession` which only works on HTTPS
            SetCookie::create('slsession')
                // Disable mandatory HTTPS
                ->withSecure(false)
                ->withHttpOnly(true)
                ->withSameSite(SameSite::strict())
                ->withPath('/'),
            60, // session idle timeout, in seconds
            SystemClock::fromUTC(),
        );
    }
}
