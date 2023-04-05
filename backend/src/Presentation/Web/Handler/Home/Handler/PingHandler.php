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

        /*$money_0 = new \Domain\VO\Money(fractionalCount: 100, currency: \Domain\VO\MoneyСurrency::RUB);
        $money_1 = new \Domain\VO\Money(fractionalCount: 100, currency: \Domain\VO\MoneyСurrency::RUB);
        $money_2 = new \Domain\VO\Money(fractionalCount: 100, currency: \Domain\VO\MoneyСurrency::USD);
        $email_0 = new \Domain\VO\Email('0@gg.com');
        $email_1 = new \Domain\VO\Email('1@gg.com');
        $new = $money_0->getSumWith($money_2);
        $new = $money_0->getSumWith($money_1);
        return new JsonResponse(
            $new. ' _' .
                ($money_0->isEqualsTo($money_2) ? 1 : 0).' _'.
                $email_0.' _'. 
                ($email_0->isEqualsTo($email_1)? 1 : 0).' _'
        );*/       

        return new JsonResponse(['ack' => time()]);
    }
}
