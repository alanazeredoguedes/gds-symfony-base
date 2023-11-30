<?php

namespace App\Bundle\SecurityBundle\Entity;

use App\Bundle\SecurityBundle\Entity\base\BaseUser;
use App\Bundle\SecurityBundle\Repository\AdministratorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'securityBundle_administrator')]
#[ORM\Entity(repositoryClass: AdministratorRepository::class)]
class Administrator extends BaseUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: false, nullable: false)]
    private string $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

}
