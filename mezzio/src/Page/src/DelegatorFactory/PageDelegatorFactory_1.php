<?php

declare(strict_types=1);

namespace Page\DelegatorFactory;

use Laminas\ServiceManager\Factory\DelegatorFactoryInterface;
use Psr\Container\ContainerInterface;
//
use Page\DelegatorFactory\PageHandlerDelegator_1;

/*

Delegator factories are called in the order they appear in configuration. 
For the first delegator factory, the $callback argument will be essentially the return value of $container->get() 
for the given service if there were no delegator factories attached to it;
 in other words, it would be the invokable or service returned by a factory, after alias resolution.

 Each delegator then returns a value, and that value will be what $callback returns for the next delegator. 
 If the delegator is the last in the list, then what it returns becomes the final value for the service in the container; 
 subsequent calls to $container->get() for that service will return that value. Delegators MUST return a value!

For container implementors, delegators MUST only be called when initially creating the service, and not each time a service is retrieved.

Common use cases for delegators include:

Decorating an instance so that it may be used in another context (e.g., decorating a PHP callable to be used as PSR-15 middleware).
Injecting collaborators (e.g., adding listeners to the ErrorHandler).
Conditionally replacing an instance based on configuration (e.g., swapping debug-enabled middleware for production middleware).
*/

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

class PageDelegatorFactory_1 implements DelegatorFactoryInterface
{
    public function __invoke(ContainerInterface $container, $name, callable $callback, ?array $options = null)
    {
        /*          
        Decorator wrapp original object to new object  new class (more powerfull class) and return. 
        */

        $item = new PageHandlerDelegator_1($callback());
        $behavior = 'behavior-PageDelegatorFactory_1'; // $behavior = $container->get('EventManager')->some...;   

        $item->addBehavior($behavior);

        return $item;
    }
}
