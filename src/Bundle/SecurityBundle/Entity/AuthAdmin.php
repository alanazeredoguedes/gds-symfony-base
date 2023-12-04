<?php

namespace App\Bundle\SettingBundle\Entity;

use App\Bundle\SecurityBundle\Repository\AdministratorRepository;
use App\Bundle\SettingBundle\Entity\Base\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'settingBundle_setting')]
#[ORM\Entity(repositoryClass: AdministratorRepository::class)]
class Setting extends BaseEntity
{
    #[ORm\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }



}