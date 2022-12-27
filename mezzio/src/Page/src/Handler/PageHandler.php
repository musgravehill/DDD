<?php

declare(strict_types=1);

namespace Page\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;

class PageHandler implements RequestHandlerInterface
{
    /**
     * @var TemplateRendererInterface
     */
    private $renderer;

    public function __construct(TemplateRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $session = (new \App\PersistenceStorage\PersistenceStorageAdapter)($request);

        $ui = [
            'id' => 'e1d0939e89ca43f19548c8868c68c48c',
            'roles' => [1, 20, 30],
        ];
        $session->set('IdentityPersistence', $ui);

        $session->set('counter', $session->get('counter', 0) + 1);
        return new HtmlResponse((string)$session->get('counter') . '__' . $session::class);

        $data = [
            'info' => '',
        ];

        return new HtmlResponse(
            $this->renderer->render(
                'page::page',
                array_merge(
                    $data,
                    ['layout' => 'app_layout::common',]  // ['layout' => 'page_layout::special',]  see /Page/src/ConfigProvider.php
                )
            )
        );

        //default layout see at /config/autoload/mezzio.global.php  templates' => ['layout'

        //return new HtmlResponse($this->renderer->render('page::page', $data));
    }
}
