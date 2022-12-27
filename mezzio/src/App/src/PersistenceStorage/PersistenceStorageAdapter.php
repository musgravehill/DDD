<?php

declare(strict_types=1);

namespace App\PersistenceStorage;

use PSR7Sessions\Storageless\Http\SessionMiddleware;
use Psr\Http\Message\ServerRequestInterface;
use PSR7Sessions\Storageless\Session\SessionInterface;

class PersistenceStorageAdapter implements PersistenceStorageAdapterInterface
{
    /**
     * Retrieves the PersistenceStorage from request
     *
     * @param ServerRequestInterface $request
     *
     * @return object|null
     */
    public function __invoke(ServerRequestInterface $request): SessionInterface
    {
        $attributeKey = (string) SessionMiddleware::SESSION_ATTRIBUTE;
        return $request->getAttribute($attributeKey);
    }
}
