<?php

namespace App\Entity;

use App\Repository\ObjectFamilyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ObjectFamilyRepository::class)
 */
class ObjectFamily
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
     * @ORM\OneToMany(targetEntity=Petshop::class, mappedBy="objectFamily")
     */
    private $petshop;

    /**
     * @ORM\OneToMany(targetEntity=HorseSchleich::class, mappedBy="objectFamily")
     */
    private $horseSchleich;

    public function __construct()
    {
        $this->petshop = new ArrayCollection();
        $this->horseSchleich = new ArrayCollection();
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
    public function getPetshop(): Collection
    {
        return $this->petshop;
    }

    public function addPetshop(Petshop $petshop): self
    {
        if (!$this->petshop->contains($petshop)) {
            $this->petshop[] = $petshop;
            $petshop->setObjectFamily($this);
        }

        return $this;
    }

    public function removePetshop(Petshop $petshop): self
    {
        if ($this->petshop->removeElement($petshop)) {
            // set the owning side to null (unless already changed)
            if ($petshop->getObjectFamily() === $this) {
                $petshop->setObjectFamily(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|HorseSchleich[]
     */
    public function getHorseSchleich(): Collection
    {
        return $this->horseSchleich;
    }

    public function addHorseSchleich(HorseSchleich $horseSchleich): self
    {
        if (!$this->horseSchleich->contains($horseSchleich)) {
            $this->horseSchleich[] = $horseSchleich;
            $horseSchleich->setObjectFamily($this);
        }

        return $this;
    }

    public function removeHorseSchleich(HorseSchleich $horseSchleich): self
    {
        if ($this->horseSchleich->removeElement($horseSchleich)) {
            // set the owning side to null (unless already changed)
            if ($horseSchleich->getObjectFamily() === $this) {
                $horseSchleich->setObjectFamily(null);
            }
        }

        return $this;
    }
}
