<?php

declare(strict_types=1);

namespace Domain\Persistence\Repository;

use Domain\Model\VO\IdEntityInterface;

interface RepositoryInterface
{
    /*
        1. Easier testing; injecting the ID as a dependency allows you to create the entity in a known state
        2. Injecting the ID allows the repository to recreate an entity from storage
        3. Injecting the ID allows for easy switching between generators. v4 UUID v5 
        4. Identifier re-use: The ID might be shared between processes.
        5. Domain code is about business logic; Id generation is a technical detail. Generating the Id outside the domain keeps the domain clean. 
    */
    /*
        INTEGER => Make a table with a single auto-incremental id field and use that to get nextId.
        ? or Insert dummy-record, get Id. Then Update dummy-record to real data.
    */
    public function nextId(): IdEntityInterface;
}
