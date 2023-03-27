<?php

declare(strict_types=1);

namespace DoctrineORM\Service;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

use Psr\Container\ContainerInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\PhpFilesAdapter;

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
            'dbname' => 'mezzio',
            'user' => 'mezzio',
            'password' => 'qwerty',
            'host' => 'mariadb_mezzio',
            'driver' => 'pdo_mysql',
        ];

        $paths = [dirname(__DIR__, 1) . '/Entity'];
        $isDevMode = false;
        $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);


        $applicationMode = 'development';

        if ($applicationMode == "development") {
            $queryCache = new ArrayAdapter();
            $metadataCache = new ArrayAdapter();
        } else {
            $queryCache = new PhpFilesAdapter('doctrine_queries');
            $metadataCache = new PhpFilesAdapter('doctrine_metadata');
        }

        $config->setMetadataCache($metadataCache);
        $config->setQueryCache($queryCache);
        $config->setProxyDir(dirname(__DIR__, 1) . '/Proxy');
        $config->setProxyNamespace('DoctrineORM\Proxy');

        if ($applicationMode == "development") {
            $config->setAutoGenerateProxyClasses(true);
        } else {
            $config->setAutoGenerateProxyClasses(false);
        }

        $connection = DriverManager::getConnection($dbParams, $config);

        $entityManager = new EntityManager($connection, $config);

        return $entityManager;
    }
}
