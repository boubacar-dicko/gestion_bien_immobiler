<?php

namespace App\Entity;

use App\Repository\BienImmobilierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BienImmobilierRepository::class)
 */
class BienImmobilier
{
    const BIEN =[
        0 => 'Immeuble',
        1 => 'Appartement',
        3 => 'Maison',
        4 => 'Magasin'
    ];

    const STATUS = [
        0 => 'A VENDRE',
        1 => 'A LOUER'
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $numeroBi;

    
    /**
     * @ORM\OneToMany(targetEntity=Contrat::class, mappedBy="bienImmobilier")
     */
    private $contrats;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="bienImmobilier")
     */
    private $client;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min=30000)
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min=1, max=5)
     */
    private $nombrePieces;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sold;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomBien;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min=10, max=400)
     */
    private $surface;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min=0, max=10)
     */
    private $nombreEtage;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $ville;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(min=0, max=1)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="bienImmobilier")
     */
    private $user;

    public function __construct()
    {
        $this->created_at = new \DateTimeImmutable();
        $this->contrats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroBi(): ?string
    {
        return $this->numeroBi;
    }

    public function setNumeroBi(string $numeroBi): self
    {
        $this->numeroBi = $numeroBi;

        return $this;
    }

    /**
     * @return Collection|Contrat[]
     */
    public function getContrats(): Collection
    {
        return $this->contrats;
    }

    public function addContrat(Contrat $contrat): self
    {
        if (!$this->contrats->contains($contrat)) {
            $this->contrats[] = $contrat;
            $contrat->setBienImmobilier($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): self
    {
        if ($this->contrats->removeElement($contrat)) {
            // set the owning side to null (unless already changed)
            if ($contrat->getBienImmobilier() === $this) {
                $contrat->setBienImmobilier(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getNombrePieces(): ?int
    {
        return $this->nombrePieces;
    }

    public function setNombrePieces(int $nombrePieces): self
    {
        $this->nombrePieces = $nombrePieces;

        return $this;
    }

    public function getSold(): ?bool
    {
        return $this->sold;
    }

    public function setSold(bool $sold): self
    {
        $this->sold = $sold;

        return $this;
    }

    public function getNomBien(): ?string
    {
        return $this->nomBien;
    }

    public function setNomBien(string $nomBien): self
    {
        $this->nomBien = $nomBien;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getNombreEtage(): ?int
    {
        return $this->nombreEtage;
    }

    public function setNombreEtage(int $nombreEtage): self
    {
        $this->nombreEtage = $nombreEtage;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

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

}
