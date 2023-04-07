<?php

declare(strict_types=1);

namespace Presentation\Web\Handler\Home\Handler;


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

use Presentation\Web\Middleware\Session\SessionProviderInterface;
use Presentation\Web\Middleware\Csrf\CsrfMiddleware;

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
            'id' => '133',
            'roles' => [1, 20, 30],
        ];
        $session->set('IdentityPersistence', $ui);
        $session->set('counter', intval($session->get('counter', 0)) + 1);

        /** @var CsrfGuardInterface */
        $guard = $request->getAttribute(CsrfMiddleware::GUARD_ATTRIBUTE);
        $_token = $guard->generateToken();

        //return new HtmlResponse((string)$session->get('counter') . '__' . $session::class);


        $UserRepository = new \Infrastructure\Persistence\DoctrineORM\Repository\UserRepository();
        $u_0 = $UserRepository->nextId();
        $u_1 = $UserRepository->nextId();
        $u_3 = new \Infrastructure\Persistence\DoctrineORM\Repository\IdEntityUuid7('01875aec-39b4-7011-a4eb-342dcafb369b');
        $u_4 = new \Infrastructure\Persistence\DoctrineORM\Repository\IdEntityUuid7('01875aec-39b4-7011-a4eb-342dcafb369b');

        return new HtmlResponse(
            (string) $u_0->toString() . '__' .
                ($u_0->isEqualsTo($u_1) ? 'eq' : 'noteq') . '__' .
                (string) $u_1->toString() . '<br>' .

                (string) $u_3->toString() . '__' .
                ($u_3->isEqualsTo($u_4) ? 'eq' : 'noteq') . '__' .
                (string) $u_4->toString() . '<br>'

        );


        /** @var \Doctrine\ORM\EntityManager $entityManager */
        $entityManager = $this->container->get(\Doctrine\ORM\EntityManager::class);

        /*$userA = new \Infrastructure\DoctrineORM\Entity\User();
        $userA->setAuthEmail(rand(1, 99999999) . '@mail.ru');
        $userA->setAuthPhone('79158887647');
        $userA->setPassHash('=22222222=');
        $userA->setAmount(10000);        
        $entityManager->persist($userA);
        $entityManager->flush(); 
        */

        /** @var \Infrastructure\DoctrineORM\Entity\User */
        $me = $entityManager->find("Infrastructure\DoctrineORM\Entity\User", 3);
        return new HtmlResponse(
            (string) $me->getAuthEmail() . '___' .
                print_r($me->getGender(), true) . '___' .
                print_r($me->getAmount(), true) . '___'
        );

        /*
        $myF = $entityManager->find("DoctrineORM\Entity\User", 2);
        $me->addFriend($myF);
        $myF->addFriend($me);
        $entityManager->persist($me);  
        $entityManager->persist($myF);               
        $entityManager->flush();
        
        $myF = $entityManager->find("DoctrineORM\Entity\User", 2);
        $me->removeFriend($myF);
        $myF->removeFriend($me);
        $entityManager->persist($me);
        $entityManager->flush();     
   
        $res = [];
        $data = $me->friendsWithMe();
        foreach ($data as $u) {
            $res[] = 'fwm_' . $u->getId();
        }
        $data = $me->myFriends();
        foreach ($data as $u) {
            $res[] = 'mf_' . $u->getId();
        }
        return new HtmlResponse((string)print_r($res, true));
        */

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
                'home_view::index', // registered 'folderName/fileName.phtml'   see Handler/Sys or Handler/*** */
                array_merge(
                    $data,
                    ['layout' => 'sys_layout::common',]  // registered 'folderName/fileName.phtml'   see Handler/Sys or Handler/***
                )
            )
        );

        //return new HtmlResponse($this->renderer->render('app_common::home', $data)); try to layout::default   .phtml
    }
}
