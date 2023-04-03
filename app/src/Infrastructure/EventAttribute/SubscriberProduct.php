<?php

declare(strict_types=1);

namespace Infrastructure\EventAttribute;

class SubscriberProduct
{
    #[ListensTo(EventProductCreate::class)]
    public function onCreate(EventProductCreate $event)
    {
        // When I create a product, then I send event "Infrastructure\EventAttribute\EventProductCreate::class" to EventDispatcher.
        // EventDispatcher find at his own list, that on event "EventProductCreate" it should
        // call the SubscriberProduct->onCreate(EventProductCreate $event);

        /*
        $EventServiceProvider = new EventServiceProvider();
        $EventServiceProvider->register();
        So, the EventDispatcher get data: 
        Array
            (
                [0] => Infrastructure\EventAttribute\EventProductCreate     - on this event EventDispatcher should call:
                [1] => Array
                    (
                        [0] => Infrastructure\EventAttribute\SubscriberProduct  - call this class
                        [1] => onCreate                                         - call this method                    
                    )
            )
        Array
            (
                [0] => Infrastructure\EventAttribute\EventProductDelete
                [1] => Array
                    (
                        [0] => Infrastructure\EventAttribute\SubscriberProduct
                        [1] => onDelete
                    )
            )           
        */
    }

    #[ListensTo(EventProductDelete::class)]
    public function onDelete(EventProductDelete $event)
    {
    }
}
