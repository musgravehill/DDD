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
        $data = [
            'info' =>  print_r($request, true),
        ];

        ///src\App\ConfigProvider.php 'templates'=>'paths'=> ['layout' => [__DIR__ . '/../templates/layout'],
        return new HtmlResponse(
            $this->renderer->render(
                'page::page',
                array_merge(
                    $data,
                    ['layout' => 'app_layout::default',]  // ['layout' => 'page_layout::special',]  see /Page/src/ConfigProvider.php
                )
            )
        );

        //return new HtmlResponse($this->renderer->render('page::page', $data));
    }
}
