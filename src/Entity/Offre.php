<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
/**
 * @ORM\Entity(repositoryClass=OffreRepository::class)
 */
class Offre
{

     /**
     * @ORM\ManyToMany(targetEntity="Competances")
     * @ORM\JoinTable(name="offre_competances",
     *      joinColumns={@ORM\JoinColumn(name="offre_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="competance_id", referencedColumnName="id")}
     *      )
     */
    private $competances;

    public function __construct()
    {
        $this->competances = new ArrayCollection();
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
    private $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="offres")
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $intitule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url_condidateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getUrlCondidateur(): ?string
    {
        return $this->url_condidateur;
    }

    public function setUrlCondidateur(string $url_condidateur): self
    {
        $this->url_condidateur = $url_condidateur;

        return $this;
    }

    public function getCompetances(): Collection
    {
        return $this->competances;
    }
    
    public function addCompetance(Competances $competance): self
    {
        if (!$this->competances->contains($competance)) {
            $this->competances[] = $competance;
        }

        return $this;
    }

    public function removeCompetance(Competances $competance): self
    {
        if ($this->competances->contains($competance)) {
            $this->competances->removeElement($competance);
        }

        return $this;
    }
}
