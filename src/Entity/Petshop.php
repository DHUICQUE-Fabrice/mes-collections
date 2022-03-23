<?php

namespace App\Entity;

use App\Repository\PetshopRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=PetshopRepository::class)
 * @Vich\Uploadable()
 */
class Petshop extends ImageFile
{

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private string $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    private string $biography;

    /**
     * @ORM\ManyToOne(targetEntity=PetshopSize::class, inversedBy="petshops")
     * @ORM\JoinColumn(nullable=false)
     * @var PetshopSize
     */
    private PetshopSize $size;

    /**
     * @ORM\ManyToOne(targetEntity=PetshopSpecies::class, inversedBy="petshops")
     * @ORM\JoinColumn(nullable=false)
     * @var PetshopSpecies
     */
    private PetshopSpecies $species;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="petshops")
     * @ORM\JoinColumn(nullable=false)
     * @var User
     */
    private User $user;

    /**
     * @ORM\ManyToOne(targetEntity=ObjectFamily::class, inversedBy="petshop")
     * @ORM\JoinColumn(nullable=false)
     * @var ObjectFamily
     */
    private ObjectFamily $objectFamily;

    /**
     * @Vich\UploadableField(mapping="uploaded_images", fileNameProperty="imageName")
     * @var File|null
     */
    protected ?File $imageFile;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name): Petshop
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getBiography(): string
    {
        return $this->biography;
    }

    /**
     * @param $biography
     * @return $this
     */
    public function setBiography($biography): Petshop
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * @return PetshopSize
     */
    public function getSize(): PetshopSize
    {
        return $this->size;
    }

    /**
     * @param $size
     * @return $this
     */
    public function setSize($size): Petshop
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return PetshopSpecies
     */
    public function getSpecies(): PetshopSpecies
    {
        return $this->species;
    }

    /**
     * @param $species
     * @return $this
     */
    public function setSpecies($species): Petshop
    {
        $this->species = $species;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->name);
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param $user
     * @return $this
     */
    public function setUser($user): Petshop
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return ObjectFamily
     */
    public function getObjectFamily(): ObjectFamily
    {
        return $this->objectFamily;
    }

    /**
     * @param $objectFamily
     * @return $this
     */
    public function setObjectFamily($objectFamily): self
    {
        $this->objectFamily = $objectFamily;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     */
    public function setImageFile(?File $imageFile): void
    {
        $this->imageFile = $imageFile;
        if ($imageFile !== null)
            $this->updatedAt = new DateTime();
    }

}
