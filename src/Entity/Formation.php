<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $intitule = null;

    #[ORM\OneToMany(mappedBy: 'formation', targetEntity: Session::class, orphanRemoval: true)]
    private Collection $nommer;

    public function __construct()
    {
        $this->nommer = new ArrayCollection();
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

    /**
     * @return Collection<int, Session>
     */
    public function getNommer(): Collection
    {
        return $this->nommer;
    }

    public function addNommer(Session $nommer): static
    {
        if (!$this->nommer->contains($nommer)) {
            $this->nommer->add($nommer);
            $nommer->setFormation($this);
        }

        return $this;
    }

    public function removeNommer(Session $nommer): static
    {
        if ($this->nommer->removeElement($nommer)) {
            // set the owning side to null (unless already changed)
            if ($nommer->getFormation() === $this) {
                $nommer->setFormation(null);
            }
        }

        return $this;
    }
}
