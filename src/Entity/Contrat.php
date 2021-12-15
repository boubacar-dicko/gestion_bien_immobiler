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

    const TRANSACTION =[
        0 => 'OrangeMoney',
        1 => 'Wave',
        2 => 'Espece',
        3 => 'Cheque',
    ];

    public function __construct()
    {
        return $this->dateContrat = new \DateTime('now');
    }

    /**
     * @ORM\Column(type="string", length=20)
     */
    private  $transaction;

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

    /**
     * @return mixed
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * @param mixed $transaction
     * @return Contrat
     */
    public function setTransaction($transaction)
    {
        $this->transaction = $transaction;
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
