<?php

namespace App\Entity;

use App\Repository\AvatarRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=AvatarRepository::class)
 * @Vich\Uploadable()
 */
class Avatar
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
    private $avatarName;

    /**
     * @Vich\UploadableField (mapping="uploaded_images", fileNameProperty="imageName")
     */
    private $avatarFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\OneToOne(targetEntity=User::class, inversedBy="avatar", cascade={"persist", "remove"})
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity=Petshop::class, inversedBy="avatar", cascade={"persist", "remove"})
     */
    private $petshop;

    /**
     * @ORM\OneToOne(targetEntity=HorseSchleich::class, inversedBy="avatar", cascade={"persist", "remove"})
     */
    private $horseSchleich;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvatarName(): ?string
    {
        return $this->avatarName;
    }

    public function setAvatarName(string $avatarName): self
    {
        $this->avatarName = $avatarName;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
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

    public function getPetshop(): ?Petshop
    {
        return $this->petshop;
    }

    public function setPetshop(?Petshop $petshop): self
    {
        $this->petshop = $petshop;

        return $this;
    }

    public function getHorseSchleich(): ?HorseSchleich
    {
        return $this->horseSchleich;
    }

    public function setHorseSchleich(?HorseSchleich $horseSchleich): self
    {
        $this->horseSchleich = $horseSchleich;

        return $this;
    }

    public function setAvatarFile($file = null){
        $this->avatarFile = $file;
        if($file){
            $this->updatedAt = new DateTime();
        }
    }

    public function getAvatarFile()
    {
        return $this->avatarFile;
    }
}
