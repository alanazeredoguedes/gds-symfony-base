<?php

namespace App\Bundle\MediaBundle\Entity;

use App\Bundle\MediaBundle\Repository\MediaRepository;
use App\Bundle\SettingBundle\Entity\Base\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'mediaBundle_media')]
#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media extends BaseEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true, nullable: true)]
    private ?string $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }




}
