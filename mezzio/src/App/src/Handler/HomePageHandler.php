<?php

declare(strict_types=1);

namespace App\Handler;

use App\Csrf\CsrfGuardInterface;
use App\Csrf\CsrfMiddleware;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\ServiceManager\ServiceManager;
use Mezzio\LaminasView\LaminasViewRenderer;
use Mezzio\Router\LaminasRouter;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Psr\Container\ContainerInterface;
use App\Session\SessionProviderInterface;
use App\Session\SessionInterface;


class HomePageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ContainerInterface $container,
        private RouterInterface $router,
        private ?TemplateRendererInterface $renderer,
        private SessionProviderInterface $sessionProvider,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = [];

        $session = $this->sessionProvider->getSession($request);
        $ui = [
            'id' => 'e1d0939e89ca43f19548c8868c68c48c',
            'roles' => [1, 20, 30],
        ];
        $session->set('IdentityPersistence', $ui);
        $session->set('counter', intval($session->get('counter', 0)) + 1);

        /** @var CsrfGuardInterface */
        $guard = $request->getAttribute(CsrfMiddleware::GUARD_ATTRIBUTE);
        $_token = $guard->generateToken();


        /** @var \Doctrine\ORM\EntityManager $entityManager */
        //$entityManager = $this->container->get(\Doctrine\ORM\EntityManager::class);
        //$entityManager1 = $this->container->get(\Doctrine\ORM\EntityManager::class);
        //return new HtmlResponse((string)spl_object_hash($entityManager) . '_' . spl_object_hash($entityManager1));
        //return new HtmlResponse((string)print_r($entityManager, true));


        //return new HtmlResponse((string)$session->get('counter') . '__' . $session::class);

        /*
        $ph = $this->container->get('Page\Handler\PageHandler');
        $ph->addBehavior('b111');
        $ph->addBehavior('b112');
        $ph->addBehavior('b113');
        $ph = $this->container->get('Page\Handler\PageHandler'); //return existed object! Singleton.
        $this->container->BUILD return NEW

        echo implode('  ', $ph->getBehaviors()); die;*/



        switch ($this->container::class) {
            case ServiceManager::class:
                $data['containerName'] = 'Laminas Servicemanager';
                $data['containerDocs'] = 'https://docs.laminas.dev/laminas-servicemanager/';
                break;
        }

        if ($this->router instanceof LaminasRouter) {
            $data['routerName'] = 'Laminas Router';
            $data['routerDocs'] = 'https://docs.laminas.dev/laminas-router/';
        }

        if ($this->renderer === null) {
            return new JsonResponse([
                'welcome' => 'Congratulations! You have installed the mezzio skeleton application.',
                'docsUrl' => 'https://docs.mezzio.dev/mezzio/',
            ] + $data);
        }

        if ($this->renderer instanceof LaminasViewRenderer) {
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
