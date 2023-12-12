<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
#[Vich\Uploadable]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomCategorie = null;

    #[ORM\Column(length: 255)]
    private ?string $imageCategorie = null;

    #[Vich\UploadableField(mapping: 'categorie', fileNameProperty: 'imageCategorie')]
    private ?File $imageFile = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'categorieMere')]
    private ?self $categorie = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Bd::class)]
    private Collection $bd;

    public function __construct()
    {
        $this->bd = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nomCategorie;
    }

    public function setNomCategorie(string $nomCategorie): static
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }

    public function getImageCategorie(): ?string
    {
        return $this->imageCategorie;
    }

    public function setImageCategorie(string $imageCategorie): static
    {
        $this->imageCategorie = $imageCategorie;

        return $this;
    }

    public function getCategorie(): ?self
    {
        return $this->categorie;
    }



    public function setCategorie(?self $categorie): static
    {
        $this->categorie = $categorie;

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
            $bd->setCategorie($this);
        }

        return $this;
    }

    public function removeBd(Bd $bd): static
    {
        if ($this->bd->removeElement($bd)) {
            // set the owning side to null (unless already changed)
            if ($bd->getCategorie() === $this) {
                $bd->setCategorie(null);
            }
        }

        return $this;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;

        return $this;
    }
}
