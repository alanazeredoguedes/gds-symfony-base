<?php

namespace App\Bundle\SecurityBundle\Entity\base;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\HasLifecycleCallbacks]
#[UniqueEntity('email', 'The defined email is already being used!')]
class BaseUser implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[Assert\Email(
        message: 'The email {{ value }} is not a valid email.',
    )]
    #[ORM\Column(length: 180, unique: true, nullable: false)]
    protected string $email;

    #[ORM\Column(name: 'password', nullable: false)]
    protected string $password;

    #[ORM\Column(name: 'roles', unique: false)]
    protected array $roles = [];

    #[ORM\Column(name: 'created_at', type: "datetime", nullable: true, options: ["default" => "CURRENT_TIMESTAMP"])]
    protected ?DateTime $createdAt;

    #[ORM\Column(name: 'updated_at', type: "datetime", nullable: true, options: ["default" => "CURRENT_TIMESTAMP"])]
    protected ?DateTime $updatedAt;

    #[ORM\PrePersist]
    public function onPrePersist(): void
    {
        $this->setCreatedAt(new DateTime("now"));
        $this->setUpdatedAt(new DateTime("now"));
    }
    #[ORM\PreUpdate]
    public function onPreUpdate(): void
    {
        $this->setUpdatedAt(new DateTime("now"));
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /** @see PasswordAuthenticatedUserInterface */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword($password): self
    {
        if($password)
            $this->password = $password;

        return $this;
    }

    /** @see UserInterface */
    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime|null $createdAt
     */
    public function setCreatedAt(?DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime|null $updatedAt
     */
    public function setUpdatedAt(?DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

}