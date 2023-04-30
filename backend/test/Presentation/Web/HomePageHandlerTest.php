<?php

declare(strict_types=1);

namespace Test\Presentation\Web;

use Presentation\Web\Handler\Home\Handler\HomePageHandler;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Presentation\Web\Middleware\Session\SessionProviderInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\ServerRequest;

class HomePageHandlerTest extends AbstractWebTest
{
    /*    
    protected $container;    
    protected $router;
    protected SessionProviderInterface $sessionProvider;
    protected function setUp(): void
    {
        $this->container = $this->createMock(ContainerInterface::class);
        $this->router    = $this->createMock(RouterInterface::class);
        $this->sessionProvider = $this->createMock(SessionProviderInterface::class);
    }    
    public function testResponse(): void
    {
        $homePage = new HomePageHandler(
            $this->container,
            $this->router,
            null,
            $this->sessionProvider
        );
        $CsrfMiddleware = 
        $response = $homePage->handle(
            $this->createMock(ServerRequestInterface::class)
        );
        self::assertInstanceOf(HtmlResponse::class, $response);
        self::assertEquals('Hello', $response->getBody()->__toString());
    }
    */

    public function testResponse(): void
    {
        $request = new ServerRequest(
            uri: '/',
            method: 'GET'
        );

        $response = $this->app->handle($request);
        self::assertInstanceOf(HtmlResponse::class, $response);
        self::assertEquals('Hello', $response->getBody()->__toString());
    }
}
