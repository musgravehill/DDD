<?php

declare(strict_types=1);

namespace Presentation\Web\Handler\Home\Handler;


use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

//use Infrastructure\EventAttribute\EventServiceProvider;

use function time;

class PingHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        //$EventServiceProvider = new EventServiceProvider();
        //$EventServiceProvider->register();

        $money_0 = new \Domain\VO\Money(fractionalCount: 100, currency: \Domain\VO\MoneyСurrency::RUB);
        $money_1 = new \Domain\VO\Money(fractionalCount: 100, currency: \Domain\VO\MoneyСurrency::RUB);
        $money_2 = new \Domain\VO\Money(fractionalCount: 100, currency: \Domain\VO\MoneyСurrency::USD);
        $email = new \Domain\VO\Email('ff@gg.com');

        //$new = $money_0->getSumWith($money_2);
        $new = $money_0->getSumWith($money_1);
        return new JsonResponse(
            $new->__toString() . ' _' .
                ($money_0->isEqualsTo($money_2) ? 1 : 0)
        );

        //return new JsonResponse(['ack' => time()]);
    }
}
