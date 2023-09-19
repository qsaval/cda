<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LivraisonRepository::class)]
class Livraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateLivraison = null;

    #[ORM\Column(length: 255)]
    private ?string $nomTransporteur = null;

    #[ORM\Column]
    private ?bool $retardEventuel = null;

    #[ORM\Column(length: 50)]
    private ?string $telephoneTransporteur = null;

    #[ORM\OneToMany(mappedBy: 'livraison', targetEntity: Commande::class)]
    private Collection $commande;

    #[ORM\OneToMany(mappedBy: 'idLivraison', targetEntity: DetailLivraison::class)]
    private Collection $detailLivraisons;

    public function __construct()
    {
        $this->commande = new ArrayCollection();
        $this->detailLivraisons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->dateLivraison;
    }

    public function setDateLivraison(\DateTimeInterface $dateLivraison): static
    {
        $this->dateLivraison = $dateLivraison;

        return $this;
    }

    public function getNomTransporteur(): ?string
    {
        return $this->nomTransporteur;
    }

    public function setNomTransporteur(string $nomTransporteur): static
    {
        $this->nomTransporteur = $nomTransporteur;

        return $this;
    }

    public function isRetardEventuel(): ?bool
    {
        return $this->retardEventuel;
    }

    public function setRetardEventuel(bool $retardEventuel): static
    {
        $this->retardEventuel = $retardEventuel;

        return $this;
    }

    public function getTelephoneTransporteur(): ?string
    {
        return $this->telephoneTransporteur;
    }

    public function setTelephoneTransporteur(string $telephoneTransporteur): static
    {
        $this->telephoneTransporteur = $telephoneTransporteur;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommande(): Collection
    {
        return $this->commande;
    }

    public function addCommande(Commande $commande): static
    {
        if (!$this->commande->contains($commande)) {
            $this->commande->add($commande);
            $commande->setLivraison($this);
        }

        return $this;
    }

    public function removeIdCommande(Commande $commande): static
    {
        if ($this->commande->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getLivraison() === $this) {
                $commande->setLivraison(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, DetailLivraison>
     */
    public function getDetailLivraisons(): Collection
    {
        return $this->detailLivraisons;
    }

    public function addDetailLivraison(DetailLivraison $detailLivraison): static
    {
        if (!$this->detailLivraisons->contains($detailLivraison)) {
            $this->detailLivraisons->add($detailLivraison);
            $detailLivraison->setLivraison($this);
        }

        return $this;
    }

    public function removeDetailLivraison(DetailLivraison $detailLivraison): static
    {
        if ($this->detailLivraisons->removeElement($detailLivraison)) {
            // set the owning side to null (unless already changed)
            if ($detailLivraison->getLivraison() === $this) {
                $detailLivraison->setLivraison(null);
            }
        }

        return $this;
    }
}
