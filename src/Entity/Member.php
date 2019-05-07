<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MemberRepository")
 */
class Member
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isValid;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="members")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GroupShare", inversedBy="members")
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupShare;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsValid(): ?bool
    {
        return $this->isValid;
    }

    public function setIsValid(bool $isValid): self
    {
        $this->isValid = $isValid;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getGroupShare(): ?GroupShare
    {
        return $this->groupShare;
    }

    public function setGroupShare(?GroupShare $groupShare): self
    {
        $this->groupShare = $groupShare;

        return $this;
    }
    public function __toString()
    {
        return $this->id;
    }
}
