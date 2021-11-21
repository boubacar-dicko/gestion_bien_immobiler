<?php

namespace App\Entity;

use App\Repository\VenteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VenteRepository::class)
 */
class Vente
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
    private $prix_de_vente;

    /**
     * @ORM\ManyToOne(targetEntity=Acheteur::class, inversedBy="ventes")
     */
    private $acheteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixDeVente(): ?int
    {
        return $this->prix_de_vente;
    }

    public function setPrixDeVente(int $prix_de_vente): self
    {
        $this->prix_de_vente = $prix_de_vente;

        return $this;
    }

    public function getAcheteur(): ?Acheteur
    {
        return $this->acheteur;
    }

    public function setAcheteur(?Acheteur $acheteur): self
    {
        $this->acheteur = $acheteur;

        return $this;
    }
}
