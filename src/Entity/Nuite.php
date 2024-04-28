<?php

namespace App\Entity;

use App\Repository\NuiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NuiteRepository::class)]
class Nuite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNuite = null;

    #[ORM\ManyToOne(inversedBy: 'nuites')]
    private ?Hotel $hotel = null;

    #[ORM\ManyToMany(targetEntity: Inscription::class, mappedBy: 'nuites')]
    private Collection $inscriptions;

    #[ORM\ManyToOne(inversedBy: 'nuites')]
    private ?CategorieChambre $categorie = null;

    public function __construct()
    {
        $this->inscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateNuite(): ?\DateTimeInterface
    {
        return $this->dateNuite;
    }

    public function setDateNuite(\DateTimeInterface $dateNuite): static
    {
        $this->dateNuite = $dateNuite;

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): static
    {
        $this->hotel = $hotel;

        return $this;
    }

    /**
     * @return Collection<int, Inscription>
     */
    public function getInscriptions(): Collection
    {
        return $this->inscriptions;
    }

    public function addInscription(Inscription $inscription): static
    {
        if (!$this->inscriptions->contains($inscription)) {
            $this->inscriptions->add($inscription);
            $inscription->addNuite($this);
        }

        return $this;
    }

    public function removeInscription(Inscription $inscription): static
    {
        if ($this->inscriptions->removeElement($inscription)) {
            $inscription->removeNuite($this);
        }

        return $this;
    }

    public function getCategorie(): ?CategorieChambre
    {
        return $this->categorie;
    }

    public function setCategorie(?CategorieChambre $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }
}
