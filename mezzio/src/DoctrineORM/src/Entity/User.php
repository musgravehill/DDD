<?php

declare(strict_types=1);

namespace DoctrineORM\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'user')]
class User
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private ?int $id=null;

    #[ORM\Column(type: 'string')]
    private string $email;
 
    #[ORM\Column(type: 'text', name: 'about_me', length: 65000)]
    private string $aboutMe;

}
