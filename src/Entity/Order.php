<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="guid")
     */
    private $book_id;

    /**
     * @ORM\Column(type="guid")
     */
    private $buyer_id;

    /**
     * @ORM\Column(type="guid")
     */
    private $admin_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $created_time;

    /**
     * @ORM\Column(type="integer")
     */
    private $moderated_time;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookId(): ?string
    {
        return $this->book_id;
    }

    public function setBookId(string $book_id): self
    {
        $this->book_id = $book_id;

        return $this;
    }

    public function getBuyerId(): ?string
    {
        return $this->buyer_id;
    }

    public function setBuyerId(string $buyer_id): self
    {
        $this->buyer_id = $buyer_id;

        return $this;
    }

    public function getAdminId(): ?string
    {
        return $this->admin_id;
    }

    public function setAdminId(string $admin_id): self
    {
        $this->admin_id = $admin_id;

        return $this;
    }

    public function getCreatedTime(): ?int
    {
        return $this->created_time;
    }

    public function setCreatedTime(int $created_time): self
    {
        $this->created_time = $created_time;

        return $this;
    }

    public function getModeratedTime(): ?int
    {
        return $this->moderated_time;
    }

    public function setModeratedTime(int $moderated_time): self
    {
        $this->moderated_time = $moderated_time;

        return $this;
    }
}
