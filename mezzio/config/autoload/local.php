<?php

/**
 * Local configuration.
 *
 * Copy this file to `local.php` and change its settings as required.
 * `local.php` is ignored by git and safe to use for local and sensitive data like usernames and passwords.
 */

declare(strict_types=1);

return [];


//goto in /mezzio/config/autoload/development.local.php.dist
return [
    'dependencies' => [
        'factories' => [
            'Mezzio\Whoops' => Mezzio\Container\WhoopsFactory::class,
            'Mezzio\WhoopsPageHandler' => Mezzio\Container\WhoopsPageHandlerFactory::class,
            Mezzio\Middleware\ErrorResponseGenerator::class => Mezzio\Container\WhoopsErrorResponseGeneratorFactory::class,
            //Mezzio\Middleware\ErrorResponseGenerator::class => Mezzio\Container\WhoopsErrorResponseGeneratorFactory::class,
        ],
    ],
];
