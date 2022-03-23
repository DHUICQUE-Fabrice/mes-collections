<?php

namespace App\Entity;

use App\Repository\ObjectFamilyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity(repositoryClass=ObjectFamilyRepository::class)
 */
class ObjectFamily
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @var int
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private string $name;

    /**
     * @ORM\OneToMany(targetEntity=Petshop::class, mappedBy="objectFamily")
     * @var ArrayCollection
     */
    private ArrayCollection $petshop;

    /**
     * @ORM\OneToMany(targetEntity=HorseSchleich::class, mappedBy="objectFamily")
     * @var ArrayCollection
     */
    private ArrayCollection $horseSchleich;

    public function __construct()
    {
        $this->petshop = new ArrayCollection();
        $this->horseSchleich = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

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
    public function setName($name): ObjectFamily
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getPetshop(): ArrayCollection
    {
        return $this->petshop;
    }

    /**
     * @param $petshop
     * @return $this
     */
    public function addPetshop($petshop): ObjectFamily
    {
        if (!$this->petshop->contains($petshop)) {
            $this->petshop[] = $petshop;
            $petshop->setObjectFamily($this);
        }
        return $this;
    }

    /**
     * @param $petshop
     * @return $this
     */
    public function removePetshop($petshop): ObjectFamily
    {
        if ($this->petshop->removeElement($petshop)) {
            if ($petshop->getObjectFamily() === $this) {
                $petshop->setObjectFamily(null);
            }
        }
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getHorseSchleich(): ArrayCollection
    {
        return $this->horseSchleich;
    }

    /**
     * @param $horseSchleich
     * @return $this
     */
    public function addHorseSchleich($horseSchleich): ObjectFamily
    {
        if (!$this->horseSchleich->contains($horseSchleich)) {
            $this->horseSchleich[] = $horseSchleich;
            $horseSchleich->setObjectFamily($this);
        }

        return $this;
    }

    /**
     * @param $horseSchleich
     * @return $this
     */
    public function removeHorseSchleich($horseSchleich): ObjectFamily
    {
        if ($this->horseSchleich->removeElement($horseSchleich)) {
            if ($horseSchleich->getObjectFamily() === $this) {
                $horseSchleich->setObjectFamily(null);
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
