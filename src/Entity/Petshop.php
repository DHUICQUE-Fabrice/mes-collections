<?php

namespace App\Entity;

use App\Repository\PetshopRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=PetshopRepository::class)
 * @Vich\Uploadable()

 */
class Petshop
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private ?DateTime $createdAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $picture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $biography;

    /**
     * @ORM\ManyToOne(targetEntity=PetshopSize::class, inversedBy="petshops")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?PetshopSize $size;

    /**
     * @ORM\ManyToOne(targetEntity=PetshopSpecies::class, inversedBy="petshops")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?PetshopSpecies $species;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="petshops")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?User $user;

    /**
     * @ORM\ManyToOne(targetEntity=ObjectFamily::class, inversedBy="petshop")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?ObjectFamily $objectFamily;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string|null
     */
    private ?string $imageName = "placeholder_petshop.png";


    /**
     * @Vich\UploadableField(mapping="uploaded_images", fileNameProperty="imageName")
     * @var File|null
     */
    private ?File $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $updatedAt;


    public function __construct()
    {
        $this->setCreatedAt(new DateTime());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): self
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

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function setImageFile(?File $file = null){
        $this->imageFile = $file;
        if($file){
            $this->updatedAt = new DateTime();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

}
