<?php

declare(strict_types=1);

// Delegate static file requests back to the PHP built-in webserver
if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}

chdir(dirname(__DIR__, 4));

require 'vendor/autoload.php';

//echo getcwd();
//die;

/**
 * Self-called anonymous function that creates its own scope and keeps the global namespace clean.
 */
(function () {
    /** @var \Psr\Container\ContainerInterface $container */
    $container = require 'src/Presentation/Web/config/container.php';

    /** @var \Mezzio\Application $app */
    $app = $container->get(\Mezzio\Application::class);
    $factory = $container->get(\Mezzio\MiddlewareFactory::class);

    // Execute programmatic/declarative middleware pipeline and routing
    // configuration statements
    (require 'src/Presentation/Web/config/pipeline.php')($app, $factory, $container);
    (require 'src/Presentation/Web/config/routes.php')($app, $factory, $container);

    $app->run();
})();
