<?php

namespace App\Entity;

use App\Repository\PetshopSpeciesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PetshopSpeciesRepository::class)
 */
class PetshopSpecies
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Petshop::class, mappedBy="species")
     */
    private $petshops;

    public function __construct()
    {
        $this->petshops = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Petshop[]
     */
    public function getPetshops(): Collection
    {
        return $this->petshops;
    }

    public function addPetshop(Petshop $petshop): self
    {
        if (!$this->petshops->contains($petshop)) {
            $this->petshops[] = $petshop;
            $petshop->setSpecies($this);
        }

        return $this;
    }

    public function removePetshop(Petshop $petshop): self
    {
        if ($this->petshops->removeElement($petshop)) {
            // set the owning side to null (unless already changed)
            if ($petshop->getSpecies() === $this) {
                $petshop->setSpecies(null);
            }
        }

        return $this;
    }
}
