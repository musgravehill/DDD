<?php

declare(strict_types=1);

namespace Infrastructure\EventAttribute;

use ReflectionClass;

class EventServiceProvider
{
    private array $subscribers = [
        SubscriberProduct::class,
    ];

    private function resolveListeners($subscriberClass): array
    {
        $listeners = [];
        $reflectionClass = new ReflectionClass($subscriberClass);
        foreach ($reflectionClass->getMethods() as $method) {
            //$attributes = $method->getAttributes(ListensTo::class);
            $attributes = $method->getAttributes(ListensTo::class, \ReflectionAttribute::IS_INSTANCEOF);
            foreach ($attributes as $attribute) {
                $listener = $attribute->newInstance(); //Creates a new instance of the attribute with! passed arguments!

                //print_r([$attribute->getName() , $attribute->getArguments()]);                

                $listeners[] = [
                    $listener->event, //ListensTo ____construct(public string $event) => getter of event                  
                    [$subscriberClass, $method->getName()],
                ];
            }
        }
        return $listeners;
    }

    public function register(): void
    {
        foreach ($this->subscribers as $subscriber) {
            foreach ($this->resolveListeners($subscriber) as [$event, $listener]) {
                // $eventDispatcher->listen($event, $listener);
                print_r([$event, $listener]);
            }
        }
        die;
    }
}
