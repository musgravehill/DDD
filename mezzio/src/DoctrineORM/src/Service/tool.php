<?php

declare(strict_types=1);

namespace DoctrineORM\Service;

require_once dirname(__DIR__, 4) . '/vendor/autoload.php'; //up * level

use DoctrineORM\Service\EntityManagerFactory;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

$entityManager = (new EntityManagerFactory)();

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);
