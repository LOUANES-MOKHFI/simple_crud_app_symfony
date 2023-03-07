<?php

namespace App\Entity;

use App\Repository\CompetancesRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
/**
 * @ORM\Entity(repositoryClass=CompetancesRepository::class)
 */
class Competances
{
     /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Offre", mappedBy="Competances")
     */
    private $offres;

    public function __construct()
    {
        $this->offres = new ArrayCollection();
    }

    

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOffres(): Collection
    {
        return $this->offres;
    }
    public function addOffre(Offre $offre): self
    {
        if (!$this->offres->contains($offre)) {
            $this->offres[] = $offre;
            $offre->addOption($this);
        }

        return $this;
    }
    public function removeOffre(Offre $offre): self
    {
        if ($this->offres->contains($offre)) {
            $this->offres->removeElement($offre);
            $offre->removeOption($this);
        }

        return $this;
    }
    public function __toString(){
        return $this->name;
    }
}
