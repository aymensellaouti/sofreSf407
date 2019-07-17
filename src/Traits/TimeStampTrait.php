<?php


namespace App\Traits;


use Doctrine\ORM\Mapping as ORM;

trait TimeStampTrait
{
    /**
     * @ORM\Column(type="date", name="created_at")
     */
    private $createdAt;

    /**
     * @var
     * @ORM\PrePersist()
     */
    public function updateCreatedAt() {
       $this->setCreatedAt(\DateTime("Now"));
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

}