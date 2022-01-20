<?php

namespace App\Entity;

use App\Repository\PetshopRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PetshopRepository::class)
 */
class Petshop extends CollectibleItem
{
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

}
