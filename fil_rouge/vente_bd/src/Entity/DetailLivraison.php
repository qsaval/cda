<?php

namespace App\Entity;

use App\Repository\DetailLivraisonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailLivraisonRepository::class)]
class DetailLivraison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbLivrer = null;

    #[ORM\ManyToOne(inversedBy: 'detailLivraisons')]
    private ?Bd $bd = null;

    #[ORM\ManyToOne(inversedBy: 'detailLivraisons')]
    private ?Livraison $livraison = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbLivrer(): ?int
    {
        return $this->nbLivrer;
    }

    public function setNbLivrer(int $nbLivrer): static
    {
        $this->nbLivrer = $nbLivrer;

        return $this;
    }

    public function getBd(): ?Bd
    {
        return $this->bd;
    }

    public function setBd(?Bd $bd): static
    {
        $this->bd = $bd;

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
}
