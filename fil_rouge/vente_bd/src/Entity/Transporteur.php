<?php

namespace App\Entity;

use App\Repository\TranporteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TranporteurRepository::class)]
class Transporteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomTransporteur = null;

    #[ORM\Column(length: 50)]
    private ?string $telephoneTransporteur = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2)]
    private ?string $fraisLivraison = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2)]
    private ?string $fraisLivraisonRapide = null;

    #[ORM\OneToMany(mappedBy: 'tranporteur', targetEntity: Livraison::class)]
    private Collection $livraison;

    public function __construct()
    {
        $this->livraison = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getTelephoneTransporteur(): ?string
    {
        return $this->telephoneTransporteur;
    }

    public function setTelephoneTransporteur(string $telephoneTransporteur): static
    {
        $this->telephoneTransporteur = $telephoneTransporteur;

        return $this;
    }

    public function getFraisLivraison(): ?string
    {
        return $this->fraisLivraison;
    }

    public function setFraisLivraison(string $fraisLivraison): static
    {
        $this->fraisLivraison = $fraisLivraison;

        return $this;
    }

    public function getFraisLivraisonRapide(): ?string
    {
        return $this->fraisLivraisonRapide;
    }

    public function setFraisLivraisonRapide(string $fraisLivraisonRapide): static
    {
        $this->fraisLivraisonRapide = $fraisLivraisonRapide;

        return $this;
    }

    /**
     * @return Collection<int, Livraison>
     */
    public function getLivraison(): Collection
    {
        return $this->livraison;
    }

    public function addLivraison(Livraison $livraison): static
    {
        if (!$this->livraison->contains($livraison)) {
            $this->livraison->add($livraison);
            $livraison->setTranporteur($this);
        }

        return $this;
    }

    public function removeLivraison(Livraison $livraison): static
    {
        if ($this->livraison->removeElement($livraison)) {
            // set the owning side to null (unless already changed)
            if ($livraison->getTranporteur() === $this) {
                $livraison->setTranporteur(null);
            }
        }

        return $this;
    }

}
