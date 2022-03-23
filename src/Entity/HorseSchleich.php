<?php

namespace App\Entity;

use App\Repository\SchleichRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=SchleichRepository::class)
 * @Vich\Uploadable()
 */
class HorseSchleich extends ImageFile
{

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private string $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    private string $biography;

    /**
     * @ORM\ManyToOne(targetEntity=HorseType::class, inversedBy="horseSchleiches")
     * @ORM\JoinColumn(nullable=false)
     * @var HorseType
     */
    private HorseType $type;

    /**
     * @ORM\ManyToOne(targetEntity=HorseCoat::class, inversedBy="horseSchleiches")
     * @ORM\JoinColumn(nullable=false)
     * @var HorseCoat
     */
    private HorseCoat $coat;

    /**
     * @ORM\ManyToOne(targetEntity=HorseSpecies::class, inversedBy="horseSchleiches")
     * @ORM\JoinColumn(nullable=false)
     * @var HorseSpecies
     */
    private HorseSpecies $species;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="horseSchleiches")
     * @ORM\JoinColumn(nullable=false)
     * @var User
     */
    private User $user;

    /**
     * @ORM\ManyToOne(targetEntity=ObjectFamily::class, inversedBy="horseSchleich")
     * @ORM\JoinColumn(nullable=false)
     * @var ObjectFamily
     */
    private ObjectFamily $objectFamily;

    /**
     * @Vich\UploadableField(mapping="uploaded_images", fileNameProperty="imageName")
     * @var File|null
     */
    protected ?File $imageFile;

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
    public function setName($name): HorseSchleich
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getBiography(): string
    {
        return $this->biography;
    }

    /**
     * @param $biography
     * @return $this
     */
    public function setBiography($biography): HorseSchleich
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * @return HorseType
     */
    public function getType(): HorseType
    {
        return $this->type;
    }

    /**
     * @param $type
     * @return $this
     */
    public function setType($type): HorseSchleich
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return HorseCoat
     */
    public function getCoat(): HorseCoat
    {
        return $this->coat;
    }

    /**
     * @param $coat
     * @return $this
     */
    public function setCoat($coat): HorseSchleich
    {
        $this->coat = $coat;

        return $this;
    }

    /**
     * @return HorseSpecies
     */
    public function getSpecies(): HorseSpecies
    {
        return $this->species;
    }

    /**
     * @param $species
     * @return $this
     */
    public function setSpecies($species): HorseSchleich
    {
        $this->species = $species;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->name);
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param $user
     * @return $this
     */
    public function setUser($user): HorseSchleich
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return ObjectFamily
     */
    public function getObjectFamily(): ObjectFamily
    {
        return $this->objectFamily;
    }

    /**
     * @param $objectFamily
     * @return $this
     */
    public function setObjectFamily($objectFamily): HorseSchleich
    {
        $this->objectFamily = $objectFamily;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     */
    public function setImageFile(?File $imageFile): void
    {
        $this->imageFile = $imageFile;
        if ($imageFile !== null)
            $this->updatedAt = new DateTime();
    }

}
