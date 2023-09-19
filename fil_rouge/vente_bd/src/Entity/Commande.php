<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 7, scale: 2)]
    private ?string $montantCommande = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateCommande = null;

    #[ORM\Column]
    private ?int $etatCommande = null;

    #[ORM\Column(length: 255)]
    private ?string $facture = null;

    #[ORM\Column(length: 255)]
    private ?string $adresseFacture = null;

    #[ORM\Column(length: 10)]
    private ?string $cpFacture = null;

    #[ORM\Column(length: 255)]
    private ?string $villeFacture = null;

    #[ORM\Column]
    private ?int $nbColis = null;

    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: DetailCommande::class)]
    private Collection $detailCommandes;

    #[ORM\ManyToOne(inversedBy: 'commande')]
    private ?Livraison $livraison = null;

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?User $user = null;

    public function __construct()
    {
        $this->detailCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantCommande(): ?string
    {
        return $this->montantCommande;
    }

    public function setMontantCommande(string $montantCommande): static
    {
        $this->montantCommande = $montantCommande;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): static
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }

    public function getEtatCommande(): ?int
    {
        return $this->etatCommande;
    }

    public function setEtatCommande(int $etatCommande): static
    {
        $this->etatCommande = $etatCommande;

        return $this;
    }

    public function getFacture(): ?string
    {
        return $this->facture;
    }

    public function setFacture(string $facture): static
    {
        $this->facture = $facture;

        return $this;
    }

    public function getAdresseFacture(): ?string
    {
        return $this->adresseFacture;
    }

    public function setAdresseFacture(string $adresseFacture): static
    {
        $this->adresseFacture = $adresseFacture;

        return $this;
    }

    public function getCpFacture(): ?string
    {
        return $this->cpFacture;
    }

    public function setCpFacture(string $cpFacture): static
    {
        $this->cpFacture = $cpFacture;

        return $this;
    }

    public function getVilleFacture(): ?string
    {
        return $this->villeFacture;
    }

    public function setVilleFacture(string $villeFacture): static
    {
        $this->villeFacture = $villeFacture;

        return $this;
    }

    public function getNbColis(): ?int
    {
        return $this->nbColis;
    }

    public function setNbColis(int $nbColis): static
    {
        $this->nbColis = $nbColis;

        return $this;
    }

    /**
     * @return Collection<int, DetailCommande>
     */
    public function getDetailCommandes(): Collection
    {
        return $this->detailCommandes;
    }

    public function addDetailCommande(DetailCommande $detailCommande): static
    {
        if (!$this->detailCommandes->contains($detailCommande)) {
            $this->detailCommandes->add($detailCommande);
            $detailCommande->setCommande($this);
        }

        return $this;
    }

    public function removeDetailCommande(DetailCommande $detailCommande): static
    {
        if ($this->detailCommandes->removeElement($detailCommande)) {
            // set the owning side to null (unless already changed)
            if ($detailCommande->getCommande() === $this) {
                $detailCommande->setCommande(null);
            }
        }

        return $this;
    }

    public function getLivraison(): ?Livraison
    {
        return $this->livraison;
    }

    public function setLivraison(?Livraison $livraison): static
    {
        $this->livraison = $livraison;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}