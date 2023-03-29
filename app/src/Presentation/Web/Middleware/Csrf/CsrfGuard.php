<?php

declare(strict_types=1);

namespace Presentation\Web\Middleware\Csrf;

use Presentation\Web\Middleware\Session\SessionProviderInterface;
use Presentation\Web\Middleware\Session\SessionInterface;
use Psr\Http\Message\ServerRequestInterface;

use function bin2hex;
use function random_bytes;

class CsrfGuard implements CsrfGuardInterface
{
    private ?SessionInterface $session = null;

    public function __construct(private SessionProviderInterface $sessionProvider,)
    {
    }
    
    public function start(ServerRequestInterface $request): void
    {
        $this->session = $this->sessionProvider->getSession($request);
        if (!$this->session instanceof SessionInterface) {
            throw new \LogicException('Error '.static::class);
        }
    }

    public function generateToken(string $keyName = '__csrf'): string
    {
        $token = bin2hex(random_bytes(16));
        $this->session?->set($keyName, $token);
        return $token;
    }

    public function validateToken(string $token, string $csrfKey = '__csrf'): bool
    {
        /** @var null|string $storedToken */
        $storedToken = $this->session?->get($csrfKey, '');
        $this->session?->unset($csrfKey);
        return $token === $storedToken;
    }
}
