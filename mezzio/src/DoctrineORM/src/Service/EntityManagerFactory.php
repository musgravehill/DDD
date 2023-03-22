<?php

declare(strict_types=1);

namespace DoctrineORM\Service;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

use Psr\Container\ContainerInterface;

class EntityManagerFactory
{
    public function __invoke(?ContainerInterface $container): EntityManager
    {

        /**
         *  user (string): Username to use when connecting to the database.
         *  password (string): Password to use when connecting to the database.
         *  host (string): Hostname of the database to connect to.
         *  port (integer): Port of the database to connect to.
         *  dbname (string): Name of the database/schema to connect to.
         *  unix_socket (string): Name of the socket used to connect to the database.
         *  charset (string): The charset used when connecting to the database.
         *
         * 
         * If $isDevMode is true caching is done in memory with the ArrayAdapter. Proxy objects are recreated on every request. 
         *  If $isDevMode is false, check for Caches in the order APCu, Redis (127.0.0.1:6379), Memcache (127.0.0.1:11211) unless `$cache` is passed as fourth argument.
         *  If $isDevMode is false, set then proxy classes have to be explicitly created through the command line.
         *  If third argument `$proxyDir` is not set, use the systems temporary directory.
         */

        $dbParams = [
            'dbname' => 'mydb',
            'user' => 'user',
            'password' => 'secret',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        ];

        $paths = [dirname(__DIR__, 1) . '/Entity'];
        $isDevMode = false;
        $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);

        $connection = DriverManager::getConnection($dbParams, $config);

        $entityManager = new EntityManager($connection, $config);

        return $entityManager;
    }
}
