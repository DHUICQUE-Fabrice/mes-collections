<?php

namespace App\Entity;

use App\Repository\HorseCoatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private string $name;

    /**
     * @ORM\OneToMany(targetEntity=HorseSchleich::class, mappedBy="coat")
     * @var ArrayCollection
     */
    private ArrayCollection $horseSchleiches;

    public function __construct()
    {
        $this->horseSchleiches = new ArrayCollection();
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
    public function setName($name): HorseCoat
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getHorseSchleiches(): ArrayCollection
    {
        return $this->horseSchleiches;
    }

    /**
     * @param $horseSchleich
     * @return $this
     */
    public function addHorseSchleich($horseSchleich): HorseCoat
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
    public function removeHorseSchleich($horseSchleich): HorseCoat
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
