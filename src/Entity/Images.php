<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImagesRepository::class)
 */
class Images
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
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=BienImmobilier::class, inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bienImmobilier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
}
