<?php

declare(strict_types=1);

namespace Page\DelegatorFactory;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;

class PageHandlerDelegator_1 implements RequestHandlerInterface
{
    private array $behaviors = [];

    public function __construct(private RequestHandlerInterface $PageHandler)
    {
    }

    public function addBehavior($behavior): void
    {
        array_push($this->behaviors, $behavior);
    }

    public function getBehaviors(): array
    {
        return $this->behaviors;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $originalResp = $this->PageHandler->handle($request);

        $res = new HtmlResponse(
            $originalResp->getBody()->getContents()
                . ' ' . implode('  ', $this->getBehaviors())
                . ' ' . static::class
        );

        return $res;
    }
}
