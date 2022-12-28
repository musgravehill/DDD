<?php

declare(strict_types=1);

namespace App;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                \App\Handler\PingHandler::class => \App\Handler\PingHandler::class,
            ],
            'factories'  => [
                'SessionMiddleware' => \App\Session\PSR7SessionStorageless\SessionMiddlewareFactory::class, //TODO prod-dev factories
                \App\Session\SessionProviderInterface::class => \App\Session\PSR7SessionStorageless\SessionProviderFactory::class,
                //
                \App\Csrf\CsrfGuard::class => \App\Csrf\CsrfGuardFactory::class,
                \App\Csrf\CsrfMiddleware::class => \App\Csrf\CsrfMiddlewareFactory::class,
                //
                \App\Handler\HomePageHandler::class => \App\Handler\HomePageHandlerFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app_common'  => [__DIR__ . '/../templates/common'],
                'app_layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
