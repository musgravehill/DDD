#!/usr/bin/env php
<?php

require __DIR__ . '/bootstrap.php';

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

ConsoleRunner::run(
    new SingleManagerProvider($entityManager)
);
