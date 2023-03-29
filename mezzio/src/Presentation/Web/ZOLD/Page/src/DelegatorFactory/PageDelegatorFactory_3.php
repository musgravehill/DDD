<?php

declare(strict_types=1);

namespace Page\DelegatorFactory;

use Laminas\ServiceManager\Factory\DelegatorFactoryInterface;
use Psr\Container\ContainerInterface;

/**
 * Add functionality or behavior?
 * 
 * Суть: объекту добавить дополнительный функционал. Паттерны для этой задачи - вторичны. Можно по-разному, но добавить.
 * 
 * Laminas\ServiceManager can instantiate delegators of requested services, 
 * decorating them as specified in a delegate factory implementing the delegator factory interface.

 * The delegate pattern is useful in cases when you want to wrap a real service in a decorator, 
 *  or generally intercept actions being performed on the delegate in an AOP (http://en.wikipedia.org/wiki/Aspect-oriented_programming) fashioned way.
 * 
 * Mezzio supports the concept of delegator factories, 
 *   which allow decoration of services created by your dependency injection container, 
 *   across all dependency injection containers supported by Mezzio.
 *
 * Delegator factories allow you to add dynamically functionality to existing services.
 * 
 * The primary use case for delegators: decorating the instantiation logic for a service.
 * 
 * «Decorator» («Wrapper») — это структурный паттерн, который позволяет добавлять объектам новые поведения на лету, помещая их в объекты-обёртки.
 * 
 * Паттерн «Decorator» («Wrapper») динамически добавляет объекту новые обязанности.
 *   Является гибкой альтернативой подклассам, расширяющим базовый класс.
 *   Схема следующая:
 *       Поместить целевой объект в другой объект, называемый декоратором, который большинство обращений переводит к переданному объекту, 
 *           а часть (особенности) реализует самостоятельно.
 *       Могут вкладываться друг в друга по цепочке.
 *       Интерфейс декоратора и декорируемого объекта должны совпадать.

 *   Отличается от паттерна 
 *   «Strategy» тем, что в последнем всё наоборот — главным является целевой объект, который распределяет обращения «расширениям».
 * 
 *   
 */

class PageDelegatorFactory_3 implements DelegatorFactoryInterface
{
    public function __invoke(ContainerInterface $container, $name, callable $callback, ?array $options = null)
    {

        /**
         * @var PageHandlerDelegator_1
         */
        $item = $callback();

        // no object modification, no object wrapping, no object decoration
        // $logger = $container->get('EventManager')->some...;
        // $logger->log($item::class);

        return $item;
    }
}
