<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 75)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Module::class)]
    private Collection $categoriser;

    public function __construct()
    {
        $this->categoriser = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Module>
     */
    public function getCategoriser(): Collection
    {
        return $this->categoriser;
    }

    public function addCategoriser(Module $categoriser): static
    {
        if (!$this->categoriser->contains($categoriser)) {
            $this->categoriser->add($categoriser);
            $categoriser->setCategorie($this);
        }

        return $this;
    }

    public function removeCategoriser(Module $categoriser): static
    {
        if ($this->categoriser->removeElement($categoriser)) {
            // set the owning side to null (unless already changed)
            if ($categoriser->getCategorie() === $this) {
                $categoriser->setCategorie(null);
            }
        }

        return $this;
    }
}
