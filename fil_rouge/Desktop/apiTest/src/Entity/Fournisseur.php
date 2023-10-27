<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
#[ApiResource]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomFourniseur = null;

    #[ORM\OneToMany(mappedBy: 'fournisseur', targetEntity: Bd::class)]
    private Collection $bd;

    public function __construct()
    {
        $this->bd = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFourniseur(): ?string
    {
        return $this->nomFourniseur;
    }

    public function setNomFourniseur(string $nomFourniseur): static
    {
        $this->nomFourniseur = $nomFourniseur;

        return $this;
    }

    /**
     * @return Collection<int, Bd>
     */
    public function getBd(): Collection
    {
        return $this->bd;
    }

    public function addBd(Bd $bd): static
    {
        if (!$this->bd->contains($bd)) {
            $this->bd->add($bd);
            $bd->setFournisseur($this);
        }

        return $this;
    }

    public function removeBd(Bd $bd): static
    {
        if ($this->bd->removeElement($bd)) {
            // set the owning side to null (unless already changed)
            if ($bd->getFournisseur() === $this) {
                $bd->setFournisseur(null);
            }
        }

        return $this;
    }
}
