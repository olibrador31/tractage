<?php

namespace App\Entity;

use App\Repository\ListeRpRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ListeRpRepository::class)]
class ListeRp
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $nom = null;

    #[ORM\Column(length: 10)]
    private ?string $prenom = null;

    #[ORM\Column(length: 10)]
    private ?string $entitee = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEntitee(): ?string
    {
        return $this->entitee;
    }

    public function setEntitee(string $entitee): static
    {
        $this->entitee = $entitee;

        return $this;
    }
}
