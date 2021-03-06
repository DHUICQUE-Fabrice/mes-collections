<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use function unserialize;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"nickname"}, message="Ce pseudo est déjà utilisé par un autre utilisateur !")
 * @Vich\Uploadable()
 */
class User extends ImageFile implements UserInterface, PasswordAuthenticatedUserInterface, Serializable
{

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @var string
     */
    private string $nickname;

    /**
     * @ORM\Column(type="json")
     * @var ArrayCollection
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @var string
     */
    private string $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private string $email;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    private string $about;

    /**
     * @ORM\OneToMany(targetEntity=Petshop::class, mappedBy="user")
     * @var ArrayCollection
     */
    private ArrayCollection $petshops;

    /**
     * @ORM\OneToMany(targetEntity=HorseSchleich::class, mappedBy="user")
     * @var ArrayCollection
     */
    private ArrayCollection $horseSchleiches;

    /**
     * @Vich\UploadableField(mapping="uploaded_images", fileNameProperty="imageName")
     * @var File|null
     */
    protected ?File $imageFile;

    public function __construct()
    {
        $this->petshops = new ArrayCollection();
        $this->horseSchleiches = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @param $nickname
     * @return $this
     */
    public function setNickname($nickname): User
    {
        $this->nickname = $nickname;
        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return $this->nickname;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
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
    public function setRoles($roles): User
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
    public function setPassword($password): User
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
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param $email
     * @return $this
     */
    public function setEmail($email): User
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getAbout(): string
    {
        return $this->about;
    }

    /**
     * @param $about
     * @return $this
     */
    public function setAbout($about): User
    {
        $this->about = $about;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getPetshops(): ArrayCollection
    {
        return $this->petshops;
    }

    /**
     * @param Petshop $petshop
     * @return $this
     */
    public function addPetshop(Petshop $petshop): User
    {
        if (!$this->petshops->contains($petshop)) {
            $this->petshops[] = $petshop;
            $petshop->setUser($this);
        }
        return $this;
    }

    /**
     * @param Petshop $petshop
     * @return $this
     */
    public function removePetshop(Petshop $petshop): User
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
     * @return ArrayCollection
     */
    public function getHorseSchleiches(): ArrayCollection
    {
        return $this->horseSchleiches;
    }

    /**
     * @param HorseSchleich $horseSchleich
     * @return $this
     */
    public function addHorseSchleich(HorseSchleich $horseSchleich): User
    {
        if (!$this->horseSchleiches->contains($horseSchleich)) {
            $this->horseSchleiches[] = $horseSchleich;
            $horseSchleich->setUser($this);
        }
        return $this;
    }

    /**
     * @param HorseSchleich $horseSchleich
     * @return $this
     */
    public function removeHorseSchleich(HorseSchleich $horseSchleich): User
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
     * @return string|null
     */
    public function serialize(): ?string
    {
        return serialize([
            $this->id,
            $this->nickname,
            $this->email,
            $this->password,
            $this->about,
            $this->roles,
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
            $this->petshops,
            $this->horseSchleiches
        ] = unserialize($data, [self::class]);
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
