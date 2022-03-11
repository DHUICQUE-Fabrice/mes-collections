<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\PersistentCollection;
use Exception;
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;
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
class User implements UserInterface, PasswordAuthenticatedUserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private string $nickname;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $email;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private string $about;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTime $registeredAt;

    /**
     * @ORM\OneToMany(targetEntity=Petshop::class, mappedBy="user")
     */
    private PersistentCollection $petshops;

    /**
     * @ORM\OneToMany(targetEntity=HorseSchleich::class, mappedBy="user")
     */
    private PersistentCollection $horseSchleiches;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string|null
     */
    private string $imageName = "placeholder_avatar.png";

    /**
     * @Vich\UploadableField(mapping="uploaded_images", fileNameProperty="imageName")
     * @var File|null
     * @Ignore
     */
    private File $imageFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private DateTimeInterface $updatedAt;

    public function __construct()
    {
        $this->petshops = new PersistentCollection();
        $this->horseSchleiches = new PersistentCollection();
        $this->setRegisteredAt(new DateTime());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname): self
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
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
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
    public function getSalt(): ?string
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAbout(): ?string
    {
        return $this->about;
    }

    public function setAbout(?string $about): self
    {
        $this->about = $about;

        return $this;
    }

    public function getRegisteredAt(): ?DateTime
    {
        return $this->registeredAt;
    }

    public function setRegisteredAt(DateTime $registeredAt): self
    {
        $this->registeredAt = $registeredAt;

        return $this;
    }

    /**
     * @return Collection|Petshop[]
     */
    public function getPetshops(): Collection
    {
        return $this->petshops;
    }

    public function addPetshop(Petshop $petshop): self
    {
        if (!$this->petshops->contains($petshop)) {
            $this->petshops[] = $petshop;
            $petshop->setUser($this);
        }
        return $this;
    }

    public function removePetshop(Petshop $petshop): self
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
    public function getHorseSchleiches(): Collection
    {
        return $this->horseSchleiches;
    }

    public function addHorseSchleich(HorseSchleich $horseSchleich): self
    {
        if (!$this->horseSchleiches->contains($horseSchleich)) {
            $this->horseSchleiches[] = $horseSchleich;
            $horseSchleich->setUser($this);
        }
        return $this;
    }

    public function removeHorseSchleich(HorseSchleich $horseSchleich): self
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

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function setImageFile(?File $file = null){
        $this->imageFile = $file;
        if($file){
            $this->updatedAt = new DateTime();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function serialize(): ?string
    {
        return serialize(array(
            $this->getId(),
            $this->getNickname(),
            $this->getRoles(),
            $this->getPassword(),
            $this->getEmail(),
            $this->getRegisteredAt(),
            $this->getPetshops(),
            $this->getHorseSchleiches(),
            $this->getImageName(),
            $this->getUpdatedAt()
        ));
    }

    public function unserialize($data)
    {
        list(
            $this->id,
            $this->nickname,
            $this->roles,
            $this->password,
            $this->email,
            $this->registeredAt,
            $this->petshops,
            $this->horseSchleiches,
            $this->imageName,
            $this->updatedAt
            ) = unserialize($data);
    }
}
