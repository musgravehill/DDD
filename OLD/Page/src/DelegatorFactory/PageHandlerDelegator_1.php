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
    /**
     * @var array<array-key, scalar>
     */
    private array $behaviors = [];

    public function __construct(private RequestHandlerInterface $PageHandler)
    {
    }

    public function addBehavior(string $behavior): void
    {
        array_push($this->behaviors, $behavior);
    }

    /**
     * @return array<array-key, scalar>
     */
    public function getBehaviors()
    {
        return $this->behaviors;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $originalResp = $this->PageHandler->handle($request);

        $behaviors = $this->getBehaviors();

        $res = new HtmlResponse(
            $originalResp->getBody()->getContents()
                . ' ' . implode('  ', $behaviors)
                . ' ' . static::class
        );

        return $res;
    }
}
