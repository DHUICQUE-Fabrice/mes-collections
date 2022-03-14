<?php

namespace App\Entity;

use App\Repository\PetshopRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=PetshopRepository::class)
 */
class Petshop
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $biography;

    /**
     * @ORM\ManyToOne(targetEntity=PetshopSize::class, inversedBy="petshops")
     * @ORM\JoinColumn(nullable=false)
     */
    private $size;

    /**
     * @ORM\ManyToOne(targetEntity=PetshopSpecies::class, inversedBy="petshops")
     * @ORM\JoinColumn(nullable=false)
     */
    private $species;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="petshops")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=ObjectFamily::class, inversedBy="petshop")
     * @ORM\JoinColumn(nullable=false)
     */
    private $objectFamily;

    /**
     * @ORM\OneToOne(targetEntity=Avatar::class, mappedBy="petshop", cascade={"persist", "remove"})
     */
    private $avatar;


    public function __construct()
    {
        $avatar = new Avatar();
        $avatar->setAvatarName("placeholder_petshop.png");
        $avatar->setUpdatedAt(new DateTime());
        $this->setAvatar($avatar);
        $this->setCreatedAt(new DateTime());
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getBiography()
    {
        return $this->biography;
    }

    public function setBiography($biography)
    {
        $this->biography = $biography;

        return $this;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    public function getSpecies()
    {
        return $this->species;
    }

    public function setSpecies($species)
    {
        $this->species = $species;

        return $this;
    }

    public function getSlug()
    {
        return (new Slugify())->slugify($this->name);
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    public function getObjectFamily()
    {
        return $this->objectFamily;
    }

    public function setObjectFamily($objectFamily): self
    {
        $this->objectFamily = $objectFamily;

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function getAvatar(): ?Avatar
    {
        return $this->avatar;
    }

    public function setAvatar(?Avatar $avatar): self
    {
        // unset the owning side of the relation if necessary
        if ($avatar === null && $this->avatar !== null) {
            $this->avatar->setPetshop(null);
        }

        // set the owning side of the relation if necessary
        if ($avatar !== null && $avatar->getPetshop() !== $this) {
            $avatar->setPetshop($this);
        }

        $this->avatar = $avatar;

        return $this;
    }

}
