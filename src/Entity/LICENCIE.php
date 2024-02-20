<?php

namespace App\Entity;

use App\Repository\LICENCIERepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LICENCIERepository::class)]
class LICENCIE
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $NUMLICENCE = null;

    #[ORM\Column(length: 70)]
    private ?string $nom = null;

    #[ORM\Column(length: 70)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $ADRESSE1 = null;

    #[ORM\Column(length: 255)]
    private ?string $ADRESSE2 = null;

    #[ORM\Column (length:5,options:["fixed"=>true])]
    private ?string $cp = null;

    #[ORM\Column(length: 70)]
    private ?string $ville = null;

    #[ORM\Column (length:14,options:["fixed"=>true])]
    private ?string $tel = null;

    #[ORM\Column(length: 100)]
    private ?string $mail = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateadhesion = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 38, scale: '0')]
    private ?string $idclub = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 38, scale: '0')]
    private ?string $idqualite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNUMLICENCE(): ?string
    {
        return $this->NUMLICENCE;
    }

    public function setNUMLICENCE(string $NUMLICENCE): static
    {
        $this->NUMLICENCE = $NUMLICENCE;

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

    public function getADRESSE1(): ?string
    {
        return $this->ADRESSE1;
    }

    public function setADRESSE1(string $ADRESSE1): static
    {
        $this->ADRESSE1 = $ADRESSE1;

        return $this;
    }

    public function getADRESSE2(): ?string
    {
        return $this->ADRESSE2;
    }

    public function setADRESSE2(string $ADRESSE2): static
    {
        $this->ADRESSE2 = $ADRESSE2;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): static
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

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

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getDateadhesion(): ?\DateTimeInterface
    {
        return $this->dateadhesion;
    }

    
    public function setDateadhesion(\DateTimeInterface $dateadhesion): static
    {
        $this->dateadhesion = $dateadhesion;

        return $this;
    }

    public function getIdclub(): ?string
    {
        return $this->idclub;
    }

    public function setIdclub(string $idclub): static
    {
        $this->idclub = $idclub;

        return $this;
    }

    public function getIdqualite(): ?string
    {
        return $this->idqualite;
    }

    public function setIdqualite(string $idqualite): static
    {
        $this->idqualite = $idqualite;

        return $this;
    }
}
