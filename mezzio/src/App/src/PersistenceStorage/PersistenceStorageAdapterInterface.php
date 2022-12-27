<?php

declare(strict_types=1);

namespace App\PersistenceStorage;

use Psr\Http\Message\ServerRequestInterface;

interface PersistenceStorageAdapterInterface
{
    /**
     * Retrieves the PersistenceStorage from request
     *
     * @param ServerRequestInterface $request
     *
     * @return object|null
     */
    public function __invoke(ServerRequestInterface $request);
}
