<?php

namespace App\Bundle\SecurityBundle\Entity;

use App\Bundle\SecurityBundle\Repository\GroupAdministratorRepository;
use App\Bundle\SettingBundle\Entity\Base\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\HasLifecycleCallbacks]
#[ORM\Table(name: 'security_admin_group')]
#[ORM\Entity(repositoryClass: GroupAdministratorRepository::class)]
class GroupAdministrator extends BaseEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true, nullable: false)]
    private string $name;

    #[ORM\Column(length: 180, unique: false, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(name: 'roles', unique: false)]
    private array $roles = [];

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        return array_unique(array_values(array_filter($roles)));
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

}
