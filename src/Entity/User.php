<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Ignore;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"nickname"}, message="Ce pseudo est déjà utilisé par un autre utilisateur !")
 * @Vich\Uploadable()
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $nickname;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Ignore
     */
    private $about;

    /**
     * @ORM\Column(type="datetime")
     */
    private $registeredAt;

    /**
     * @ORM\OneToMany(targetEntity=Petshop::class, mappedBy="user")
     */
    private $petshops;

    /**
     * @ORM\OneToMany(targetEntity=HorseSchleich::class, mappedBy="user")
     */
    private $horseSchleiches;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string|null
     */
    private $imageName = "placeholder_avatar.png";

    /**
     * @Vich\UploadableField(mapping="uploaded_images", fileNameProperty="imageName")
     * @var File|null
     * @Ignore
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    public function __construct()
    {
        $this->petshops = new ArrayCollection();
        $this->horseSchleiches = new ArrayCollection();
        $this->setRegisteredAt(new DateTime());
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

    public function setNickname($nickname)
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier()
    {
        return $this->nickname;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername()
    {
        return $this->nickname;
    }

    /**
     * @see UserInterface
     */
    public function getRoles()
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     *
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getAbout()
    {
        return $this->about;
    }

    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }

    public function getRegisteredAt()
    {
        return $this->registeredAt;
    }

    public function setRegisteredAt($registeredAt)
    {
        $this->registeredAt = $registeredAt;

        return $this;
    }

    /**
     * @return Collection|Petshop[]
     */
    public function getPetshops()
    {
        return $this->petshops;
    }

    public function addPetshop($petshop)
    {
        if (!$this->petshops->contains($petshop)) {
            $this->petshops[] = $petshop;
            $petshop->setUser($this);
        }
        return $this;
    }

    public function removePetshop($petshop)
    {
        if ($this->petshops->removeElement($petshop)) {
            // set the owning side to null (unless already changed)
            if ($petshop->getUser() === $this) {
                $petshop->setUser(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection|HorseSchleich[]
     */
    public function getHorseSchleiches()
    {
        return $this->horseSchleiches;
    }

    public function addHorseSchleich($horseSchleich)
    {
        if (!$this->horseSchleiches->contains($horseSchleich)) {
            $this->horseSchleiches[] = $horseSchleich;
            $horseSchleich->setUser($this);
        }
        return $this;
    }

    public function removeHorseSchleich($horseSchleich)
    {
        if ($this->horseSchleiches->removeElement($horseSchleich)) {
            // set the owning side to null (unless already changed)
            if ($horseSchleich->getUser() === $this) {
                $horseSchleich->setUser(null);
            }
        }
        return $this;
    }


    public function __toString()
    {
        return $this->getNickname();
    }

    public function getImageName()
    {
        return $this->imageName;
    }

    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function setImageFile($file = null){
        $this->imageFile = $file;
        if($file){
            $this->updatedAt = new DateTime();
        }
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

}
