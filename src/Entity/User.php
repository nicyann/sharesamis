<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 * @Vich\Uploadable()
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;
    
    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];
    
    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(max=4096)
     */
    private $plainPassword;
    

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $filename;
    
    /**
     * @Vich\UploadableField(mapping="user_image", fileNameProperty="filename")
     * @var File
     * @Assert\Image(mimeTypes={ "image/jpeg", "image/jpg", "image/png"  }, mimeTypesMessage = "Extension valide : .jpeg .png .jpg", groups = {"create"})
     */
    private $imageFile;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;
    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="user", orphanRemoval=true)
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Borrow", mappedBy="user", orphanRemoval=true)
     */
    private $borrows;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GroupShare", mappedBy="user")
     */
    private $groupShares;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Member", mappedBy="user", orphanRemoval=true)
     */
    private $members;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="userFrom")
     */
    private $messagesFrom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Message", mappedBy="userTo")
     */
    private $messagesTo;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->borrows = new ArrayCollection();
        $this->groupShares = new ArrayCollection();
        $this->members = new ArrayCollection();
        $this->messagesFrom = new ArrayCollection();
        $this->messagesTo = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
    


    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }


    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setUser($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains($article)) {
            $this->articles->removeElement($article);
            // set the owning side to null (unless already changed)
            if ($article->getUser() === $this) {
                $article->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Borrow[]
     */
    public function getBorrows(): Collection
    {
        return $this->borrows;
    }

    public function addBorrow(Borrow $borrow): self
    {
        if (!$this->borrows->contains($borrow)) {
            $this->borrows[] = $borrow;
            $borrow->setUser($this);
        }

        return $this;
    }

    public function removeBorrow(Borrow $borrow): self
    {
        if ($this->borrows->contains($borrow)) {
            $this->borrows->removeElement($borrow);
            // set the owning side to null (unless already changed)
            if ($borrow->getUser() === $this) {
                $borrow->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GroupShare[]
     */
    public function getGroupShares(): Collection
    {
        return $this->groupShares;
    }

    public function addGroupShare(GroupShare $groupShare): self
    {
        if (!$this->groupShares->contains($groupShare)) {
            $this->groupShares[] = $groupShare;
            $groupShare->setUser($this);
        }

        return $this;
    }

    public function removeGroupShare(GroupShare $groupShare): self
    {
        if ($this->groupShares->contains($groupShare)) {
            $this->groupShares->removeElement($groupShare);
            // set the owning side to null (unless already changed)
            if ($groupShare->getUser() === $this) {
                $groupShare->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Member[]
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(Member $member): self
    {
        if (!$this->members->contains($member)) {
            $this->members[] = $member;
            $member->setUser($this);
        }

        return $this;
    }

    public function removeMember(Member $member): self
    {
        if ($this->members->contains($member)) {
            $this->members->removeElement($member);
            // set the owning side to null (unless already changed)
            if ($member->getUser() === $this) {
                $member->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessagesFrom(): Collection
    {
        return $this->messagesFrom;
    }

    public function addMessagesFrom(Message $messagesFrom): self
    {
        if (!$this->messagesFrom->contains($messagesFrom)) {
            $this->messagesFrom[] = $messagesFrom;
            $messagesFrom->setUserFrom($this);
        }

        return $this;
    }

    public function removeMessagesFrom(Message $messagesFrom): self
    {
        if ($this->messagesFrom->contains($messagesFrom)) {
            $this->messagesFrom->removeElement($messagesFrom);
            // set the owning side to null (unless already changed)
            if ($messagesFrom->getUserFrom() === $this) {
                $messagesFrom->setUserFrom(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessagesTo(): Collection
    {
        return $this->messagesTo;
    }

    public function addMessagesTo(Message $messagesTo): self
    {
        if (!$this->messagesTo->contains($messagesTo)) {
            $this->messagesTo[] = $messagesTo;
            $messagesTo->setUserTo($this);
        }

        return $this;
    }

    public function removeMessagesTo(Message $messagesTo): self
    {
        if ($this->messagesTo->contains($messagesTo)) {
            $this->messagesTo->removeElement($messagesTo);
            // set the owning side to null (unless already changed)
            if ($messagesTo->getUserTo() === $this) {
                $messagesTo->setUserTo(null);
            }
        }

        return $this;
    }
    
    /**
     * @return string
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }
    
    /**
     * @param string $plainPassword
     */
    public function setPlainPassword(string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }
    
    /**
     * @return null|string
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }
    
    /**
     * @param null|string $filename
     * @return User
     */
    public function setFilename(?string $filename): User
    {
        $this->filename = $filename;
        return $this;
    }
    
    /**
     * @return null|File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
    
    /**
     * @param null|File $imageFile
     *
     * @return User
     */
    public function setImageFile(?File $imageFile): User
    {
        $this->imageFile = $imageFile;
    
        // Only change the updated af if the file is really uploaded to avoid database updates.
        // This is needed when the file should be set when loading the entity.
        if ($this->imageFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }
    
    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }
    
    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
    
}

