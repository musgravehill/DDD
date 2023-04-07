<?php

declare(strict_types=1);

namespace Infrastructure\DoctrineORM;

require_once dirname(__DIR__, 3) . '/vendor/autoload.php'; //up * level

use Infrastructure\DoctrineORM\EntityManagerFactory;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

$entityManager = (new EntityManagerFactory)(null);

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);
