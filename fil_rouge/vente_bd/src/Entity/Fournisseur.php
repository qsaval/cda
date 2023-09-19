<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FournisseurRepository::class)]
class Fournisseur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomFourniseur = null;

    #[ORM\Column(length: 255)]
    private ?string $nomContact = null;

    #[ORM\Column(length: 255)]
    private ?string $telephoneContact = null;

    #[ORM\Column(length: 255)]
    private ?string $adresseFournisseur = null;

    #[ORM\Column(length: 255)]
    private ?string $villeFournisseur = null;

    #[ORM\Column(length: 10)]
    private ?string $cpFournisseur = null;

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

    public function getNomContact(): ?string
    {
        return $this->nomContact;
    }

    public function setNomContact(string $nomContact): static
    {
        $this->nomContact = $nomContact;

        return $this;
    }

    public function getTelephoneContact(): ?string
    {
        return $this->telephoneContact;
    }

    public function setTelephoneContact(string $telephoneContact): static
    {
        $this->telephoneContact = $telephoneContact;

        return $this;
    }

    public function getAdresseFournisseur(): ?string
    {
        return $this->adresseFournisseur;
    }

    public function setAdresseFournisseur(string $adresseFournisseur): static
    {
        $this->adresseFournisseur = $adresseFournisseur;

        return $this;
    }

    public function getVilleFournisseur(): ?string
    {
        return $this->villeFournisseur;
    }

    public function setVilleFournisseur(string $villeFournisseur): static
    {
        $this->villeFournisseur = $villeFournisseur;

        return $this;
    }

    public function getCpFournisseur(): ?string
    {
        return $this->cpFournisseur;
    }

    public function setCpFournisseur(string $cpFournisseur): static
    {
        $this->cpFournisseur = $cpFournisseur;

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

    public function removeIdBd(Bd $bd): static
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
