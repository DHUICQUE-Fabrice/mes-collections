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
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Petshop::class, mappedBy="size")
     * @var ArrayCollection
     */
    private $petshops;

    public function __construct()
    {
        $this->petshops = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
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
     * @return ArrayCollection
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
            $petshop->setSize($this);
        }
        return $this;
    }

    /**
     * @param Petshop $petshop
     * @return $this
     */
    public function removePetshop(Petshop $petshop)
    {
        if ($this->petshops->removeElement($petshop)) {
            if ($petshop->getSize() === $this) {
                $petshop->setSize(null);
            }
        }
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
