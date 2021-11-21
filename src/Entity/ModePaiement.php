<?php

namespace App\Entity;

use App\Repository\ModePaiementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModePaiementRepository::class)
 */
class ModePaiement
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
    private $numeroPaiement;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nomPaiement;

    /**
     * @ORM\OneToMany(targetEntity=Transaction::class, mappedBy="modePaiement")
     */
    private $transaction;

    public function __construct()
    {
        $this->transaction = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroPaiement(): ?int
    {
        return $this->numeroPaiement;
    }

    public function setNumeroPaiement(int $numeroPaiement): self
    {
        $this->numeroPaiement = $numeroPaiement;

        return $this;
    }

    public function getNomPaiement(): ?string
    {
        return $this->nomPaiement;
    }

    public function setNomPaiement(string $nomPaiement): self
    {
        $this->nomPaiement = $nomPaiement;

        return $this;
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getTransaction(): Collection
    {
        return $this->transaction;
    }

    public function addTransaction(Transaction $transaction): self
    {
        if (!$this->transaction->contains($transaction)) {
            $this->transaction[] = $transaction;
            $transaction->setModePaiement($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): self
    {
        if ($this->transaction->removeElement($transaction)) {
            // set the owning side to null (unless already changed)
            if ($transaction->getModePaiement() === $this) {
                $transaction->setModePaiement(null);
            }
        }

        return $this;
    }
}
