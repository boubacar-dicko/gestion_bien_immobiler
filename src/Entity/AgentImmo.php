<?php

namespace App\Entity;

use App\Repository\AgentImmoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AgentImmoRepository::class)
 */
class AgentImmo
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
    private $poste;

    /**
     * @ORM\OneToMany(targetEntity=Contrat::class, mappedBy="agentImmo")
     */
    private $contrats;

    /**
     * @ORM\OneToOne(targetEntity=AgenceImmobilier::class, cascade={"persist", "remove"})
     */
    private $agenceImmobilier;

    /**
     * @ORM\ManyToOne(targetEntity=Versement::class, inversedBy="agentImmos")
     */
    private $versement;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $user;

    public function __construct()
    {
        $this->contrats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

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
            $contrat->setAgentImmo($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): self
    {
        if ($this->contrats->removeElement($contrat)) {
            // set the owning side to null (unless already changed)
            if ($contrat->getAgentImmo() === $this) {
                $contrat->setAgentImmo(null);
            }
        }

        return $this;
    }

    public function getAgenceImmobilier(): ?AgenceImmobilier
    {
        return $this->agenceImmobilier;
    }

    public function setAgenceImmobilier(?AgenceImmobilier $agenceImmobilier): self
    {
        $this->agenceImmobilier = $agenceImmobilier;

        return $this;
    }

    public function getVersement(): ?Versement
    {
        return $this->versement;
    }

    public function setVersement(?Versement $versement): self
    {
        $this->versement = $versement;

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
