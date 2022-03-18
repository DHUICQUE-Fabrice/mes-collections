<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Ignore;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"nickname"}, message="Ce pseudo est déjà utilisé par un autre utilisateur !")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface, \Serializable
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
     * @ORM\OneToOne(targetEntity=ImageFile::class, cascade={"persist", "remove"}, orphanRemoval="true")
     */
    private $imageFile;

    public function __construct()
    {
        $this->imageFile = new ImageFile();
        $this->imageFile->setImageName('placeholder_avatar.png');
        $this->petshops = new ArrayCollection();
        $this->horseSchleiches = new ArrayCollection();
        $this->setRegisteredAt(new DateTime());
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @param $nickname
     * @return $this
     */
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

    /**
     * @param $roles
     * @return $this
     */
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

    /**
     * @param $password
     * @return $this
     */
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

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * @param $about
     * @return $this
     */
    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRegisteredAt()
    {
        return $this->registeredAt;
    }

    /**
     * @param $registeredAt
     * @return $this
     */
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

    /**
     * @param $petshop
     * @return $this
     */
    public function addPetshop($petshop)
    {
        if (!$this->petshops->contains($petshop)) {
            $this->petshops[] = $petshop;
            $petshop->setUser($this);
        }
        return $this;
    }

    /**
     * @param $petshop
     * @return $this
     */
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

    /**
     * @param $horseSchleich
     * @return $this
     */
    public function addHorseSchleich($horseSchleich)
    {
        if (!$this->horseSchleiches->contains($horseSchleich)) {
            $this->horseSchleiches[] = $horseSchleich;
            $horseSchleich->setUser($this);
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
            // set the owning side to null (unless already changed)
            if ($horseSchleich->getUser() === $this) {
                $horseSchleich->setUser(null);
            }
        }
        return $this;
    }


    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->getNickname();
    }


    /**
     * @return ImageFile|null
     */
    public function getImageFile(): ?ImageFile
    {
        return $this->imageFile;
    }

    /**
     * @param ImageFile|null $imageFile
     * @return $this
     */
    public function setImageFile(?ImageFile $imageFile): self
    {
        $this->imageFile = $imageFile;

        return $this;
    }

    /**
     * @return string|null
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->nickname,
            $this->email,
            $this->password,
            $this->about,
            $this->roles,
            $this->registeredAt,
            $this->petshops,
            $this->horseSchleiches
        ]);    }

    /**
     * @param $data
     * @return void
     */
    public function unserialize($data)
    {
        [
            $this->id,
            $this->nickname,
            $this->email,
            $this->password,
            $this->about,
            $this->roles,
            $this->registeredAt,
            $this->petshops,
            $this->horseSchleiches
        ] = \unserialize($data, [self::class]);    }
}
