<?php

namespace App\Entity;

use App\Repository\PetshopSizeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity(repositoryClass=PetshopSizeRepository::class)
 */
class PetshopSize
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
     * @ORM\OneToMany(targetEntity=Petshop::class, mappedBy="size")
     */
    private $petshops;

    public function __construct()
    {
        $this->petshops = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
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

    /**
     * @return Collection|Petshop[]
     */
    public function getPetshops()
    {
        return $this->petshops;
    }

    public function addPetshop($petshop)
    {
        if (!$this->petshops->contains($petshop)) {
            $this->petshops[] = $petshop;
            $petshop->setSize($this);
        }

        return $this;
    }

    public function removePetshop(Petshop $petshop)
    {
        if ($this->petshops->removeElement($petshop)) {
            if ($petshop->getSize() === $this) {
                $petshop->setSize(null);
            }
        }
        return $this;
    }


    public function __toString()
    {
        return $this->getName();
    }
}
