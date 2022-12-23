<?php

declare(strict_types=1);

namespace Page\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function assert;

class PageHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $renderer = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;
        assert($renderer instanceof TemplateRendererInterface || null === $renderer);

        $item = new PageHandler($renderer);

        return $item;
    }
}
