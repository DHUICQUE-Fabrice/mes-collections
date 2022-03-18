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
     * @ORM\OneToOne(targetEntity=ImageFile::class, cascade={"persist", "remove"}, orphanRemoval="true")
     */
    private $imageFile;



    public function __construct()
    {
        $this->imageFile = new ImageFile();
        $this->imageFile->setImageName('placeholder_horseschleich.png');
        $this->setCreatedAt(new DateTime());
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param $picture
     * @return $this
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * @param $biography
     * @return $this
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCoat()
    {
        return $this->coat;
    }

    /**
     * @param $coat
     * @return $this
     */
    public function setCoat($coat)
    {
        $this->coat = $coat;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSpecies()
    {
        return $this->species;
    }

    /**
     * @param $species
     * @return $this
     */
    public function setSpecies($species)
    {
        $this->species = $species;

        return $this;
    }


    /**
     * @return string
     */
    public function getSlug()
    {
        return (new Slugify())->slugify($this->name);
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param $user
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getObjectFamily()
    {
        return $this->objectFamily;
    }

    /**
     * @param $objectFamily
     * @return $this
     */
    public function setObjectFamily($objectFamily)
    {
        $this->objectFamily = $objectFamily;

        return $this;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->getName();
    }


    /**
     * @return ImageFile|null
     */
    public function getImageFile(): ?ImageFile
    {
        return $this->imageFile;
    }

    /**
     * @param ImageFile|null $imageFile
     * @return $this
     */
    public function setImageFile(?ImageFile $imageFile): self
    {
        $this->imageFile = $imageFile;

        return $this;
    }

}
