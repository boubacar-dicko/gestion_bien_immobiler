<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocationRepository::class)
 */
class Location
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
    private $prixLocation;

    /**
     * @ORM\OneToOne(targetEntity=Locataire::class, cascade={"persist", "remove"})
     */
    private $locataire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixLocation(): ?int
    {
        return $this->prixLocation;
    }

    public function setPrixLocation(int $prixLocation): self
    {
        $this->prixLocation = $prixLocation;

        return $this;
    }

    public function getLocataire(): ?Locataire
    {
        return $this->locataire;
    }

    public function setLocataire(?Locataire $locataire): self
    {
        $this->locataire = $locataire;

        return $this;
    }
}
