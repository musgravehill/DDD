<?php

declare(strict_types=1);

namespace Domain\Model\VO;

use InvalidArgumentException;

final class Phone extends ValueObjectAbstract implements ValueObjectInterface
{
    public readonly string $phone; //country code + area code + number + additional digits 

    public function toString(): string
    {
        return (string) $this->phone;
    }

    //self-validation
    public function __construct(string $phone)
    {
        if (!filter_var($phone, FILTER_VALIDATE_REGEXP, ["options" => array("regexp" => "/\d{6,15}/")])) {
            throw new InvalidArgumentException('Phone should be an string of digits');
        }
        $this->phone = $phone;
    }

    //structural equality, compare
    public function isEqualsTo(ValueObjectInterface $vo): bool
    {
        parent::isEqualsTo($vo);
        if ($this->phone !== $vo->phone) {
            return false;
        }

        return true;
    }
}
