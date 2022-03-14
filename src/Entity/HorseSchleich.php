<?php

namespace App\Entity;

use App\Repository\SchleichRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass=SchleichRepository::class)
 */
class HorseSchleich
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
     * @ORM\ManyToOne(targetEntity=HorseType::class, inversedBy="horseSchleiches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=HorseCoat::class, inversedBy="horseSchleiches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $coat;

    /**
     * @ORM\ManyToOne(targetEntity=HorseSpecies::class, inversedBy="horseSchleiches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $species;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="horseSchleiches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=ObjectFamily::class, inversedBy="horseSchleich")
     * @ORM\JoinColumn(nullable=false)
     */
    private $objectFamily;

    /**
     * @ORM\OneToOne(targetEntity=Avatar::class, mappedBy="horseSchleich", cascade={"persist", "remove"})
     */
    private $avatar;

    public function __construct()
    {
        $avatar = new Avatar();
        $avatar->setAvatarName("placeholder_horseschleich.png");
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

    public function setCreatedAt($createdAt)
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

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function getCoat()
    {
        return $this->coat;
    }

    public function setCoat($coat)
    {
        $this->coat = $coat;

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

    public function setObjectFamily($objectFamily)
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
            $this->avatar->setHorseSchleich(null);
        }

        // set the owning side of the relation if necessary
        if ($avatar !== null && $avatar->getHorseSchleich() !== $this) {
            $avatar->setHorseSchleich($this);
        }

        $this->avatar = $avatar;

        return $this;
    }
}
