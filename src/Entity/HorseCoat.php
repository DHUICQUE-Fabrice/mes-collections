<?php

namespace App\Entity;

use App\Repository\HorseCoatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;

/**
 * @ORM\Entity(repositoryClass=HorseCoatRepository::class)
 */
class HorseCoat
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
     * @ORM\OneToMany(targetEntity=HorseSchleich::class, mappedBy="coat")
     * @var ArrayCollection
     */
    private $horseSchleiches;

    public function __construct()
    {
        $this->horseSchleiches = new ArrayCollection();
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
    public function getHorseSchleiches()
    {
        return $this->horseSchleiches;
    }

    /**
     * @param $horseSchleich
     * @return $this
     */
    public function addHorseSchleich($horseSchleich)
    {
        if (!$this->horseSchleiches->contains($horseSchleich)) {
            $this->horseSchleiches[] = $horseSchleich;
            $horseSchleich->setCoat($this);
        }
        return $this;
    }

    /**
     * @param $horseSchleich
     * @return $this
     */
    public function removeHorseSchleich($horseSchleich)
    {
        if ($this->horseSchleiches->removeElement($horseSchleich)) {
            if ($horseSchleich->getCoat() === $this) {
                $horseSchleich->setCoat(null);
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
