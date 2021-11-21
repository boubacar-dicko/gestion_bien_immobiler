<?php

namespace App\Entity;

use App\Repository\TypeTransactionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeTransactionRepository::class)
 */
class TypeTransaction
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
    private $nomTransaction;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTransaction(): ?string
    {
        return $this->nomTransaction;
    }

    public function setNomTransaction(string $nomTransaction): self
    {
        $this->nomTransaction = $nomTransaction;

        return $this;
    }
}
