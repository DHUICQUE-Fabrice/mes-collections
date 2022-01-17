<?php

namespace App\Entity;

use App\Repository\HorseCoatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=HorseSchleich::class, mappedBy="coat")
     */
    private $horseSchleiches;

    public function __construct()
    {
        $this->horseSchleiches = new ArrayCollection();
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
     * @return Collection|HorseSchleich[]
     */
    public function getHorseSchleiches(): Collection
    {
        return $this->horseSchleiches;
    }

    public function addHorseSchleich(HorseSchleich $horseSchleich): self
    {
        if (!$this->horseSchleiches->contains($horseSchleich)) {
            $this->horseSchleiches[] = $horseSchleich;
            $horseSchleich->setCoat($this);
        }

        return $this;
    }

    public function removeHorseSchleich(HorseSchleich $horseSchleich): self
    {
        if ($this->horseSchleiches->removeElement($horseSchleich)) {
            // set the owning side to null (unless already changed)
            if ($horseSchleich->getCoat() === $this) {
                $horseSchleich->setCoat(null);
            }
        }

        return $this;
    }
}
