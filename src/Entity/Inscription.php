<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InscriptionRepository::class)]
class Inscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateinscription = null;

    #[ORM\OneToMany(targetEntity: Restauration::class, mappedBy: 'inscription')]
    private Collection $restaurations;

    #[ORM\ManyToMany(targetEntity: Atelier::class, mappedBy: 'inscriptions')]
    private Collection $ateliers;

    public function __construct()
    {
        $this->restaurations = new ArrayCollection();
        $this->ateliers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateinscription(): ?\DateTimeInterface
    {
        return $this->dateinscription;
    }

    public function setDateinscription(\DateTimeInterface $dateinscription): static
    {
        $this->dateinscription = $dateinscription;

        return $this;
    }

    /**
     * @return Collection<int, Restauration>
     */
    public function getRestaurations(): Collection
    {
        return $this->restaurations;
    }

    public function addRestauration(Restauration $restauration): static
    {
        if (!$this->restaurations->contains($restauration)) {
            $this->restaurations->add($restauration);
            $restauration->setInscription($this);
        }

        return $this;
    }

    public function removeRestauration(Restauration $restauration): static
    {
        if ($this->restaurations->removeElement($restauration)) {
            // set the owning side to null (unless already changed)
            if ($restauration->getInscription() === $this) {
                $restauration->setInscription(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Atelier>
     */
    public function getAteliers(): Collection
    {
        return $this->ateliers;
    }

    public function addAtelier(Atelier $atelier): static
    {
        if (!$this->ateliers->contains($atelier)) {
            $this->ateliers->add($atelier);
            $atelier->addInscription($this);
        }

        return $this;
    }

    public function removeAtelier(Atelier $atelier): static
    {
        if ($this->ateliers->removeElement($atelier)) {
            $atelier->removeInscription($this);
        }

        return $this;
    }
}
