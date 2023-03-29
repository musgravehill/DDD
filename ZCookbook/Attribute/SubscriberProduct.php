<?php

declare(strict_types=1);

namespace App\Attribute;

class SubscriberProduct
{
    #[ListensTo(EventProductCreate::class)]
    public function onCreate(EventProductCreate $event){}

    #[ListensTo(EventProductDelete::class)]
    public function onDelete(EventProductDelete $event){}
}
