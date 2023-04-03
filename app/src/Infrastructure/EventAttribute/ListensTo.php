<?php

declare(strict_types=1);

namespace Infrastructure\EventAttribute;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]  //only for methods: public function onCreate(...) and others
final class ListensTo
{

    public function __construct(
        public string $event
    ) {
    }
}
