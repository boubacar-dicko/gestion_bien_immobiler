<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContratRepository::class)
 */
class Contrat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $numeroContrat;

    /**
     * @ORM\Column(type="date")
     */
    private $dateContrat;

    /**
     * @ORM\ManyToOne(targetEntity=BienImmobilier::class, inversedBy="contrats")
     */
    private $bienImmobilier;

    /**
     * @ORM\OneToOne(targetEntity=Transaction::class, cascade={"persist", "remove"})
     */
    private $tansaction;

    /**
     * @ORM\ManyToOne(targetEntity=AgentImmo::class, inversedBy="contrats")
     */
    private $agentImmo;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="contrats")
     */
    private $client;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroContrat(): ?string
    {
        return $this->numeroContrat;
    }

    public function setNumeroContrat(string $numeroContrat): self
    {
        $this->numeroContrat = $numeroContrat;

        return $this;
    }

    public function getDateContrat(): ?\DateTimeInterface
    {
        return $this->dateContrat;
    }

    public function setDateContrat(\DateTimeInterface $dateContrat): self
    {
        $this->dateContrat = $dateContrat;

        return $this;
    }

    public function getBienImmobilier(): ?BienImmobilier
    {
        return $this->bienImmobilier;
    }

    public function setBienImmobilier(?BienImmobilier $bienImmobilier): self
    {
        $this->bienImmobilier = $bienImmobilier;

        return $this;
    }

    public function getTansaction(): ?Transaction
    {
        return $this->tansaction;
    }

    public function setTansaction(?Transaction $tansaction): self
    {
        $this->tansaction = $tansaction;

        return $this;
    }

    public function getAgentImmo(): ?AgentImmo
    {
        return $this->agentImmo;
    }

    public function setAgentImmo(?AgentImmo $agentImmo): self
    {
        $this->agentImmo = $agentImmo;

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


}
