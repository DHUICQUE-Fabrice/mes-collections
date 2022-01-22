<?php

namespace App\Entity;

use App\Repository\SchleichRepository;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass=SchleichRepository::class)
 */
class HorseSchleich
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private string $biography;

    /**
     * @ORM\ManyToOne(targetEntity=HorseType::class, inversedBy="horseSchleiches")
     * @ORM\JoinColumn(nullable=false)
     */
    private HorseType $type;

    /**
     * @ORM\ManyToOne(targetEntity=HorseCoat::class, inversedBy="horseSchleiches")
     * @ORM\JoinColumn(nullable=false)
     */
    private HorseCoat $coat;

    /**
     * @ORM\ManyToOne(targetEntity=HorseSpecies::class, inversedBy="horseSchleiches")
     * @ORM\JoinColumn(nullable=false)
     */
    private HorseSpecies $species;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="horseSchleiches")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=ObjectFamily::class, inversedBy="horseSchleich")
     * @ORM\JoinColumn(nullable=false)
     */
    private $objectFamily;


    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
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

    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->name);
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getObjectFamily(): ?ObjectFamily
    {
        return $this->objectFamily;
    }

    public function setObjectFamily(?ObjectFamily $objectFamily): self
    {
        $this->objectFamily = $objectFamily;

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }

}
