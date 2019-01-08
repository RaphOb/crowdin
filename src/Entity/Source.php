<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SourceRepository")
 */
class Source
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=65)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $sourcefield;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Projet", inversedBy="source")
     * @ORM\JoinColumn(nullable=false)
     * 
     */
    protected $projet;

 
    private $source;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Traduct", mappedBy="source")
     */
    private $traduct;

    public function __construct()
    {
        $this->source = new ArrayCollection();
        $this->traduct = new ArrayCollection();
    }



    /**
     * @param Projet $projet
     * 
     * @return Source
     */
    public function setProjet(Projet $projet)
    {
        $this->projet = $projet;
        return $this;
    }
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSourcefield(): ?string
    {
        return $this->sourcefield;
    }

    public function setSourcefield(string $sourcefield): self
    {
        $this->sourcefield = $sourcefield;

        return $this;
    }

    public function getSource(): ?Projet
    {
        return $this->source;
    }

    public function setSource(?Projet $source): self
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return Collection|Traduct[]
     */
    public function getTraduct(): Collection
    {
        return $this->traduct;
    }

    public function addTraduct(Traduct $traduct): self
    {
        if (!$this->traduct->contains($traduct)) {
            $this->traduct[] = $traduct;
            $traduct->setSource($this);
        }

        return $this;
    }

    public function removeTraduct(Traduct $traduct): self
    {
        if ($this->traduct->contains($traduct)) {
            $this->traduct->removeElement($traduct);
            // set the owning side to null (unless already changed)
            if ($traduct->getSource() === $this) {
                $traduct->setSource(null);
            }
        }

        return $this;
    }

}
