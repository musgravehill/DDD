<?php

declare(strict_types=1);

namespace Presentation\Home\Handler;

use App\Session\SessionProviderInterface;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function assert;

class HomePageHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $router = $container->get(RouterInterface::class);
        assert($router instanceof RouterInterface);

        //var_dump(func_get_args()[1]);
        //print_r($router);
        //print_r($container->get(TemplateRendererInterface::class));

        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;
        assert($template instanceof TemplateRendererInterface || null === $template);

        $sessionProvider = $container->has(SessionProviderInterface::class)
            ? $container->get(SessionProviderInterface::class)
            : null;
        assert($sessionProvider instanceof SessionProviderInterface);

        return new HomePageHandler($container, $router, $template, $sessionProvider);
    }
}
