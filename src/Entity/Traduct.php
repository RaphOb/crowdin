<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TraductRepository")
 */
class Traduct
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $traductfield;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Source", inversedBy="traduct")
     */
    private $source;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Langues", inversedBy="traduct",  cascade={"persist"})
     * @ORM\JoinTable(name="langues_traduct")
     */
    private $langues;

    public function __construct()
    {
        $this->langues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTraductfield(): ?string
    {
        return $this->traductfield;
    }

    public function setTraductfield(?string $traductfield): self
    {
        $this->traductfield = $traductfield;

        return $this;
    }

    public function getSource(): ?Source
    {
        return $this->source;
    }

    public function setSource(?Source $source): self
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return Collection|Langues[]
     */
    public function getLangues(): Collection
    {
        return $this->langues;
    }

    public function addLangue(Langues $langue): self
    {
        if (!$this->langues->contains($langue)) {
            $this->langues[] = $langue;
            $langue->addTraduct($this);
        }

        return $this;
    }

    public function removeLangue(Langues $langue): self
    {
        if ($this->langues->contains($langue)) {
            $this->langues->removeElement($langue);
            $langue->removeTraduct($this);
        }

        return $this;
    }
}
