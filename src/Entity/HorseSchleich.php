<?php

namespace App\Entity;

use App\Repository\SchleichRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SchleichRepository::class)
 */
class HorseSchleich extends CollectibleItem
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $biography;

    /**
     * @ORM\ManyToOne(targetEntity=HorseType::class, inversedBy="horseSchleiches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=HorseCoat::class, inversedBy="horseSchleiches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $coat;

    /**
     * @ORM\ManyToOne(targetEntity=HorseSpecies::class, inversedBy="horseSchleiches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $species;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }

    public function getType(): ?HorseType
    {
        return $this->type;
    }

    public function setType(?HorseType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCoat(): ?HorseCoat
    {
        return $this->coat;
    }

    public function setCoat(?HorseCoat $coat): self
    {
        $this->coat = $coat;

        return $this;
    }

    public function getSpecies(): ?HorseSpecies
    {
        return $this->species;
    }

    public function setSpecies(?HorseSpecies $species): self
    {
        $this->species = $species;

        return $this;
    }


}
