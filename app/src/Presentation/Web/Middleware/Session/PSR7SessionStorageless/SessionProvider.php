<?php

declare(strict_types=1);

namespace App\Session\PSR7SessionStorageless;

use PSR7Sessions\Storageless\Http\SessionMiddleware;
use Psr\Http\Message\ServerRequestInterface;
use App\Session\SessionProviderInterface;
use App\Session\SessionInterface;
use PSR7Sessions\Storageless\Session\SessionInterface as PSR7SessionsStoragelessSessionInterface;

class SessionProvider implements SessionProviderInterface
{
    /**
     * Retrieves the Session from request
     *
     * @param ServerRequestInterface $request
     * @return SessionInterface
     */
    public function getSession(ServerRequestInterface $request): SessionInterface
    {
        $attributeKey = SessionMiddleware::SESSION_ATTRIBUTE;
        $session = $request->getAttribute($attributeKey);

        assert($session instanceof PSR7SessionsStoragelessSessionInterface);

        if (!$session instanceof PSR7SessionsStoragelessSessionInterface) {
            throw new \LogicException('Error ' . static::class);
        }

        return new SessionAdapter($session);
    }
}
