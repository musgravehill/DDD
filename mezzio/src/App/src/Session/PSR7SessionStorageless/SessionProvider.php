<?php

declare(strict_types=1);

namespace App\Session\PSR7SessionStorageless;

use PSR7Sessions\Storageless\Http\SessionMiddleware;
use Psr\Http\Message\ServerRequestInterface;
use App\Session\SessionProviderInterface;
use App\Session\SessionInterface;

class SessionProvider implements SessionProviderInterface
{
    /**
     * Retrieves the Session from request
     *
     * @param ServerRequestInterface $request
     *
     * @return object|null
     */
    public function getSession(ServerRequestInterface $request): SessionInterface
    {
        $attributeKey = (string) SessionMiddleware::SESSION_ATTRIBUTE;
        $session = $request->getAttribute($attributeKey);        

        return new SessionAdapter($session);
    }
}
