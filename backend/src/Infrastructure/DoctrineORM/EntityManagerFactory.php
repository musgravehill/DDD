<?php

declare(strict_types=1);

namespace Infrastructure\DoctrineORM;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AttributeDriver;
use Doctrine\ORM\ORMSetup;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\PhpFilesAdapter;

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
         * $paths = [dirname(__DIR__, 1) . '/Entity'];
         * $isDevMode = false;
         * $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
         *
         * If $isDevMode is true caching is done in memory with the ArrayAdapter. Proxy objects are recreated on every request. 
         *  If $isDevMode is false, check for Caches in the order APCu, Redis (127.0.0.1:6379), Memcache (127.0.0.1:11211) unless `$cache` is passed as fourth argument.
         *  If $isDevMode is false, set then proxy classes have to be explicitly created through the command line.
         *  If third argument `$proxyDir` is not set, use the systems temporary directory.
         */

        /*
         Обратите внимание, что кэш запросов не влияет на результаты запросов. 
         Вы не получаете устаревшие данные. Это чистый кеш оптимизации без каких-либо негативных побочных эффектов
         */

        /*
         Прокси-классы могут быть созданы либо вручную через консоль Doctrine, либо автоматически во время выполнения с помощью Doctrine. 
         Никогда не создавайте прокси автоматически. 
         Вам нужно будет сгенерировать прокси вручную, для этого используйте консоль Doctrine следующим образом:
          myCLI.php  orm:generate-proxies
         Когда вы делаете это в среде разработки, имейте в виду, что вы можете получить ошибки class/file not found, 
         если определенные прокси еще не сгенерированы. Вы также можете столкнуться со сбоем отложенной загрузки, 
         если в класс сущностей были добавлены новые методы, которых еще нет в прокси-классе. 
         В таком случае просто используйте консоль Doctrine для (повторного) создания прокси-классов.
         */

        $dbParams = [
            'dbname' => 'ddd',
            'user' => 'uddd',
            'password' => 'pddd',
            'host' => 'ddd-backend-mariadb',
            'driver' => 'pdo_mysql',
        ];

        $applicationMode = 'development';

        if ($applicationMode == "development") {
            $queryCache = new ArrayAdapter();
            $metadataCache = new ArrayAdapter();
        } else {
            $queryCache = new PhpFilesAdapter('doctrine_queries');
            $metadataCache = new PhpFilesAdapter('doctrine_metadata');
        }

        $config = new Configuration;

        $config->setMetadataCache($metadataCache);
        $driverImpl = new AttributeDriver([dirname(__DIR__, 2) . '/Domain/Entity']);
        $config->setMetadataDriverImpl($driverImpl);
        $config->setQueryCache($queryCache);
        $config->setProxyDir(__DIR__ . '/Proxy');
        $config->setProxyNamespace('Infrastructure\DoctrineORM\Proxy');

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
