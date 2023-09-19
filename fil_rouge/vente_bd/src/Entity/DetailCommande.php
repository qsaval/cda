<?php

namespace App\Entity;

use App\Repository\DetailCommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailCommandeRepository::class)]
class DetailCommande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbCommander = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    private ?string $prixCommander = null;

    #[ORM\ManyToOne(inversedBy: 'detailCommandes')]
    private ?Bd $bd = null;

    #[ORM\ManyToOne(inversedBy: 'detailCommandes')]
    private ?Commande $commande = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbCommander(): ?int
    {
        return $this->nbCommander;
    }

    public function setNbCommander(int $nbCommander): static
    {
        $this->nbCommander = $nbCommander;

        return $this;
    }

    public function getPrixCommander(): ?string
    {
        return $this->prixCommander;
    }

    public function setPrixCommander(string $prixCommander): static
    {
        $this->prixCommander = $prixCommander;

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

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): static
    {
        $this->commande = $commande;

        return $this;
    }
}
