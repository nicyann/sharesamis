<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="messagesFrom")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userFrom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="messagesTo")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userTo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUserFrom(): ?User
    {
        return $this->userFrom;
    }

    public function setUserFrom(?User $userFrom): self
    {
        $this->userFrom = $userFrom;

        return $this;
    }

    public function getUserTo(): ?User
    {
        return $this->userTo;
    }

    public function setUserTo(?User $userTo): self
    {
        $this->userTo = $userTo;

        return $this;
    }
}
