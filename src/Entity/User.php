<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
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
    private $email;



    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $prenom;

    /**
     * @ORM\OneToMany(targetEntity=Roles::class, mappedBy="users")
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity=BienImmobilier::class, mappedBy="user")
     */
    private $bienImmobilier;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $phone;

    /**
     * @ORM\OneToOne(targetEntity=AgenceImmobilier::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $agenceImmobilier;

    public function __toString()
    {
        return  $this->id;
    }

    public function __construct()
    {
        $this->role = new ArrayCollection();
        $this->bienImmobilier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        //$roles = $this->roles;
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection|Roles[]
     */
    public function getRole(): Collection
    {
        return $this->role;
    }

    public function addRole(Roles $role): self
    {
        if (!$this->role->contains($role)) {
            $this->role[] = $role;
            $role->setUsers($this);
        }

        return $this;
    }

    public function removeRole(Roles $role): self
    {
        if ($this->role->removeElement($role)) {
            // set the owning side to null (unless already changed)
            if ($role->getUsers() === $this) {
                $role->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BienImmobilier[]
     */
    public function getBienImmobilier(): Collection
    {
        return $this->bienImmobilier;
    }

    public function addBienImmobilier(BienImmobilier $bienImmobilier): self
    {
        if (!$this->bienImmobilier->contains($bienImmobilier)) {
            $this->bienImmobilier[] = $bienImmobilier;
            $bienImmobilier->setUser($this);
        }

        return $this;
    }

    public function removeBienImmobilier(BienImmobilier $bienImmobilier): self
    {
        if ($this->bienImmobilier->removeElement($bienImmobilier)) {
            // set the owning side to null (unless already changed)
            if ($bienImmobilier->getUser() === $this) {
                $bienImmobilier->setUser(null);
            }
        }

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAgenceImmobilier(): ?AgenceImmobilier
    {
        return $this->agenceImmobilier;
    }

    public function setAgenceImmobilier(AgenceImmobilier $agenceImmobilier): self
    {
        $this->agenceImmobilier = $agenceImmobilier;

        return $this;
    }
}
