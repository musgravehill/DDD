<?php

declare(strict_types=1);

namespace App\Session;

use Psr\Http\Message\ServerRequestInterface;
use App\Session\SessionInterface;

interface SessionProviderInterface
{
    /**
     * Retrieves the Session from request
     *
     * @param ServerRequestInterface $request
     *
     * @return object|null
     */
    public function getSession(ServerRequestInterface $request): SessionInterface;
}
