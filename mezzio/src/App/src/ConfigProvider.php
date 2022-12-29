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
                Handler\PingHandler::class => \App\Handler\PingHandler::class,
            ],
            'factories'  => [
                'SessionMiddleware' => Session\PSR7SessionStorageless\SessionMiddlewareFactory::class, //TODO prod-dev factories
                Session\SessionProviderInterface::class => Session\PSR7SessionStorageless\SessionProviderFactory::class,
                //
                Csrf\CsrfGuardInterface::class => Csrf\CsrfGuardFactory::class,
                Csrf\CsrfMiddleware::class => Csrf\CsrfMiddlewareFactory::class,
                //
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
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
