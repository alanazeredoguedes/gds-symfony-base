<?php

namespace App\Bundle\SettingBundle\Entity\Base;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\HasLifecycleCallbacks]
class BaseEntity
{
    #[ORM\Column(name: 'createdAt', type: "datetime", nullable: true, options: ["default" => "CURRENT_TIMESTAMP"])]
    protected ?DateTime $createdAt = null;

    #[ORM\Column(name: 'updatedAt', type: "datetime", nullable: true, options: ["default" => "CURRENT_TIMESTAMP"])]
    protected ?DateTime$updatedAt = null;

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