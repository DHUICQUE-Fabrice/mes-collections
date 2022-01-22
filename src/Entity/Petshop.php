<?php

namespace App\Entity;

use App\Repository\ObjectFamilyRepository;
use App\Repository\PetshopRepository;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=PetshopRepository::class)
 * @Vich\Uploadable
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
     * @Vich\UploadableField(mapping="uploaded_images", fileNameProperty="picture")
     * @var File
     */
    private $imageFile;

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


    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function setImageFile(File $file = null)
    {
        $this->imageFile = $file;
        $newDate = $this->createdAt->modify('-1 second');
        if($file){
            $this->createdAt = $newDate;
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }

    public function getSize(): ?PetshopSize
    {
        return $this->size;
    }

    public function setSize(?PetshopSize $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getSpecies(): ?PetshopSpecies
    {
        return $this->species;
    }

    public function setSpecies(?PetshopSpecies $species): self
    {
        $this->species = $species;

        return $this;
    }

    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->name);
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

    public function getObjectFamily(): ?ObjectFamily
    {
        return $this->objectFamily;
    }

    public function setObjectFamily(?ObjectFamily $objectFamily): self
    {
        $this->objectFamily = $objectFamily;

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }



}
