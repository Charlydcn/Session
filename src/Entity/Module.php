<?php

namespace App\Entity;

use App\Repository\ModuleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModuleRepository::class)]
class Module
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 75)]
    private ?string $intitule = null;

    #[ORM\ManyToOne(inversedBy: 'categoriser')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    #[ORM\ManyToMany(targetEntity: Session::class, inversedBy: 'modules')]
    private Collection $programme;

    public function __construct()
    {
        $this->programme = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): static
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Session>
     */
    public function getProgramme(): Collection
    {
        return $this->programme;
    }

    public function addProgramme(Session $programme): static
    {
        if (!$this->programme->contains($programme)) {
            $this->programme->add($programme);
        }

        return $this;
    }

    public function removeProgramme(Session $programme): static
    {
        $this->programme->removeElement($programme);

        return $this;
    }
}
