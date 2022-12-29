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

        //return new HtmlResponse((string)'');

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
