<?php

namespace App\Entity;

use App\Repository\HorseTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HorseTypeRepository::class)
 */
class HorseType
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
     * @ORM\OneToMany(targetEntity=HorseSchleich::class, mappedBy="type")
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
    public function setName($name): HorseType
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
    public function addHorseSchleich($horseSchleich): HorseType
    {
        if (!$this->horseSchleiches->contains($horseSchleich)) {
            $this->horseSchleiches[] = $horseSchleich;
            $horseSchleich->setType($this);
        }

        return $this;
    }

    /**
     * @param $horseSchleich
     * @return $this
     */
    public function removeHorseSchleich($horseSchleich): HorseType
    {
        if ($this->horseSchleiches->removeElement($horseSchleich)) {
            if ($horseSchleich->getType() === $this) {
                $horseSchleich->setType(null);
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
