<?php

namespace App\Entity;

use App\Repository\CLUBRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CLUBRepository::class)]
class CLUB
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 55)]
    private ?string $nom = null;

    #[ORM\Column(length: 60)]
    private ?string $Adresse1 = null;

    #[ORM\Column(length: 60)]
    private ?string $Adresse2 = null;

    #[ORM\Column (length:5,options:["fixed"=>true])]
    private ?string $CP = null;

    #[ORM\Column(length: 60)]
    private ?string $VILLE = null;

    #[ORM\Column (length:14,options:["fixed"=>true])]
    private ?string $tel = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAdresse1(): ?string
    {
        return $this->Adresse1;
    }

    public function setAdresse1(string $Adresse1): static
    {
        $this->Adresse1 = $Adresse1;

        return $this;
    }

    public function getAdresse2(): ?string
    {
        return $this->Adresse2;
    }

    public function setAdresse2(string $Adresse2): static
    {
        $this->Adresse2 = $Adresse2;

        return $this;
    }

    public function getCP(): ?string
    {
        return $this->CP;
    }

    public function setCP(string $CP): static
    {
        $this->CP = $CP;

        return $this;
    }

    public function getVILLE(): ?string
    {
        return $this->VILLE;
    }

    public function setVILLE(string $VILLE): static
    {
        $this->VILLE = $VILLE;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }
}
