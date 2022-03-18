<?php

namespace App\Entity;

use App\Repository\PetshopSpeciesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

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
     * @return Collection|Petshop[]
     */
    public function getPetshops()
    {
        return $this->petshops;
    }

    /**
     * @param $petshop
     * @return $this
     */
    public function addPetshop($petshop)
    {
        if (!$this->petshops->contains($petshop)) {
            $this->petshops[] = $petshop;
            $petshop->setSpecies($this);
        }

        return $this;
    }

    /**
     * @param $petshop
     * @return $this
     */
    public function removePetshop($petshop)
    {
        if ($this->petshops->removeElement($petshop)) {
            if ($petshop->getSpecies() === $this) {
                $petshop->setSpecies(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->getName();
    }
}
