<?php

namespace App\Entity;

use App\Repository\VersementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VersementRepository::class)
 */
class Versement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numeroVersement;

    /**
     * @ORM\Column(type="date")
     */
    private $dateVersement;

    /**
     * @ORM\Column(type="integer")
     */
    private $SommeVerse;

    /**
     * @ORM\OneToMany(targetEntity=AgentImmo::class, mappedBy="versement")
     */
    private $agentImmos;

    /**
     * @ORM\OneToMany(targetEntity=Client::class, mappedBy="versement")
     */
    private $clients;

    public function __construct()
    {
        $this->agentImmos = new ArrayCollection();
        $this->clients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroVersement(): ?int
    {
        return $this->numeroVersement;
    }

    public function setNumeroVersement(int $numeroVersement): self
    {
        $this->numeroVersement = $numeroVersement;

        return $this;
    }

    public function getDateVersement(): ?\DateTimeInterface
    {
        return $this->dateVersement;
    }

    public function setDateVersement(\DateTimeInterface $dateVersement): self
    {
        $this->dateVersement = $dateVersement;

        return $this;
    }

    public function getSommeVerse(): ?int
    {
        return $this->SommeVerse;
    }

    public function setSommeVerse(int $SommeVerse): self
    {
        $this->SommeVerse = $SommeVerse;

        return $this;
    }

    /**
     * @return Collection|AgentImmo[]
     */
    public function getAgentImmos(): Collection
    {
        return $this->agentImmos;
    }

    public function addAgentImmo(AgentImmo $agentImmo): self
    {
        if (!$this->agentImmos->contains($agentImmo)) {
            $this->agentImmos[] = $agentImmo;
            $agentImmo->setVersement($this);
        }

        return $this;
    }

    public function removeAgentImmo(AgentImmo $agentImmo): self
    {
        if ($this->agentImmos->removeElement($agentImmo)) {
            // set the owning side to null (unless already changed)
            if ($agentImmo->getVersement() === $this) {
                $agentImmo->setVersement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
            $client->setVersement($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getVersement() === $this) {
                $client->setVersement(null);
            }
        }

        return $this;
    }
}
