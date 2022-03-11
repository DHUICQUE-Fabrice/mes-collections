<?php

namespace App\Entity;

use App\Repository\HorseTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity(repositoryClass=HorseTypeRepository::class)
 */
class HorseType
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
    private  $name;

    /**
     * @ORM\OneToMany(targetEntity=HorseSchleich::class, mappedBy="type")
     */
    private $horseSchleiches;

    public function __construct()
    {
        $this->horseSchleiches = new ArrayCollection();
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
     * @return Collection|HorseSchleich[]
     */
    public function getHorseSchleiches()
    {
        return $this->horseSchleiches;
    }

    public function addHorseSchleich($horseSchleich)
    {
        if (!$this->horseSchleiches->contains($horseSchleich)) {
            $this->horseSchleiches[] = $horseSchleich;
            $horseSchleich->setType($this);
        }

        return $this;
    }

    public function removeHorseSchleich($horseSchleich)
    {
        if ($this->horseSchleiches->removeElement($horseSchleich)) {
            if ($horseSchleich->getType() === $this) {
                $horseSchleich->setType(null);
            }
        }
        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
