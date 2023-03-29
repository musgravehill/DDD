<?php

declare(strict_types=1);

namespace Presentation\Web\Middleware\Session;

use Psr\Http\Message\ServerRequestInterface;
use Presentation\Web\Middleware\Session\SessionInterface;

interface SessionProviderInterface
{
    /**
     * Retrieves the Session from request
     *
     * @param ServerRequestInterface $request
     *
     * @return SessionInterface
     */
    public function getSession(ServerRequestInterface $request): SessionInterface;
}
