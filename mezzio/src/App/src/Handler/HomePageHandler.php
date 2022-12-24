<?php

declare(strict_types=1);

namespace App\Handler;

use Chubbyphp\Container\MinimalContainer;
use DI\Container as PHPDIContainer;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\ServiceManager\ServiceManager;
use Mezzio\LaminasView\LaminasViewRenderer;
use Mezzio\Plates\PlatesRenderer;
use Mezzio\Router\FastRouteRouter;
use Mezzio\Router\LaminasRouter;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use Mezzio\Twig\TwigRenderer;
use Pimple\Psr11\Container as PimpleContainer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Psr\Container\ContainerInterface;

class HomePageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ContainerInterface $container,
        private RouterInterface $router,
        private ?TemplateRendererInterface $renderer = null
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = [];

        /*
        $ph = $this->container->get('Page\Handler\PageHandler');
        $ph->addBehavior('b111');
        $ph->addBehavior('b112');
        $ph->addBehavior('b113');
        $ph = $this->container->get('Page\Handler\PageHandler'); //return existed object! Singleton.
        echo implode('  ', $ph->getBehaviors()); die;*/



        switch ($this->container::class) {
            case PimpleContainer::class:
                $data['containerName'] = 'Pimple';
                $data['containerDocs'] = 'https://pimple.symfony.com/';
                break;
            case ServiceManager::class:
                $data['containerName'] = 'Laminas Servicemanager';
                $data['containerDocs'] = 'https://docs.laminas.dev/laminas-servicemanager/';
                break;
            case ContainerBuilder::class:
                $data['containerName'] = 'Symfony DI Container';
                $data['containerDocs'] = 'https://symfony.com/doc/current/service_container.html';
                break;
            case 'Elie\PHPDI\Config\ContainerWrapper':
            case PHPDIContainer::class:
                $data['containerName'] = 'PHP-DI';
                $data['containerDocs'] = 'https://php-di.org';
                break;
            case MinimalContainer::class:
                $data['containerName'] = 'Chubbyphp Container';
                $data['containerDocs'] = 'https://github.com/chubbyphp/chubbyphp-container';
                break;
        }

        if ($this->router instanceof FastRouteRouter) {
            $data['routerName'] = 'FastRoute';
            $data['routerDocs'] = 'https://github.com/nikic/FastRoute';
        } elseif ($this->router instanceof LaminasRouter) {
            $data['routerName'] = 'Laminas Router';
            $data['routerDocs'] = 'https://docs.laminas.dev/laminas-router/';
        }

        if ($this->renderer === null) {
            return new JsonResponse([
                'welcome' => 'Congratulations! You have installed the mezzio skeleton application.',
                'docsUrl' => 'https://docs.mezzio.dev/mezzio/',
            ] + $data);
        }

        if ($this->renderer instanceof PlatesRenderer) {
            $data['rendererName'] = 'Plates';
            $data['rendererDocs'] = 'https://platesphp.com/';
        } elseif ($this->renderer instanceof TwigRenderer) {
            $data['rendererName'] = 'Twig';
            $data['rendererDocs'] = 'https://twig.symfony.com';
        } elseif ($this->renderer instanceof LaminasViewRenderer) {
            $data['rendererName'] = 'Laminas View';
            $data['rendererDocs'] = 'https://docs.laminas.dev/laminas-view/';
        }

        return new HtmlResponse(
            $this->renderer->render(
                'app_common::home',
                array_merge(
                    $data,
                    ['layout' => 'app_layout::common',]  // ['layout' => 'page_layout::special',]  see /Page/src/ConfigProvider.php
                )
            )
        );

        //return new HtmlResponse($this->renderer->render('app_common::home', $data)); try to layout::default   .phtml
    }
}
