<?php

namespace App\Entity;

use App\Repository\TransactionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TransactionRepository::class)
 */
class Transaction
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
    private $numeroTransaction;

    /**
     * @ORM\Column(type="date")
     */
    private $dateTransaction;

    /**
     * @ORM\ManyToOne(targetEntity=ModePaiement::class, inversedBy="transaction")
     */
    private $modePaiement;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroTransaction(): ?int
    {
        return $this->numeroTransaction;
    }

    public function setNumeroTransaction(int $numeroTransaction): self
    {
        $this->numeroTransaction = $numeroTransaction;

        return $this;
    }

    public function getDateTransaction(): ?\DateTimeInterface
    {
        return $this->dateTransaction;
    }

    public function setDateTransaction(\DateTimeInterface $dateTransaction): self
    {
        $this->dateTransaction = $dateTransaction;

        return $this;
    }

    public function getModePaiement(): ?ModePaiement
    {
        return $this->modePaiement;
    }

    public function setModePaiement(?ModePaiement $modePaiement): self
    {
        $this->modePaiement = $modePaiement;

        return $this;
    }


}
