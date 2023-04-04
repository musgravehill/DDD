<?php

declare(strict_types=1);

namespace Domain\VO;

//use Doctrine\ORM\Mapping\Embeddable; //? Domain depends on /vendor!  Is it OK? 
use InvalidArgumentException;

//#[Embeddable]
final class Phone extends AbstractValueObject implements InterfaceValueObject
{
    public readonly string $phone; //country code + area code + number + additional digits 

    public function __toString(): string
    {
        return $this->phone;
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
    public function isEqualsTo(InterfaceValueObject $vo): bool
    {
        parent::isEqualsTo($vo);
        if ($this->phone !== $vo->phone) {
            return false;
        }

        return true;
    }
}
