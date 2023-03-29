<?php

declare(strict_types=1);

namespace Page;

/**
 * The configuration provider for the Pages module
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
            'invokables' => [],
            'factories'  => [
                Handler\PageHandler::class => Handler\PageHandlerFactory::class,
            ],
            'delegators' => [
                Handler\PageHandler::class => [
                    DelegatorFactory\PageDelegatorFactory_1::class,
                    DelegatorFactory\PageDelegatorFactory_2::class,
                    DelegatorFactory\PageDelegatorFactory_3::class,
                ],
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
                'page'    => [__DIR__ . '/../templates/page'],
                'page_layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
