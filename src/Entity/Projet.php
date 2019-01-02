<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjetRepository")
 */
class Projet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=68)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=68)
     */
    private $User_name;

    

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Source", mappedBy="projet", cascade="all", orphanRemoval=true)
     * @ORM\JoinColumn(name="source_id", referencedColumnName="id")
     */
    protected $source;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Langues", mappedBy="LangueProjet")
     */
    private $langue;

    public function __construct()
    {
        $this->source = new ArrayCollection();
        $this->langue = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getUserName(): ?string
    {
        return $this->User_name;
    }

    public function setUserName(string $User_name): self
    {
        $this->User_name = $User_name;

        return $this;
    }

    /**
     * @return Collection|Source[]
     */
    public function getSource(): Collection
    {
        return $this->source;
    }



    public function addSource(Source $source): self
    {
       
        if (!$this->source->contains($source)) {
            $this->source[] = $source;
            $source->setProjet($this);
        }
        return $this;
    }

    public function removeSource(Source $source): self
    {
        if ($this->source->contains($source)) {
            $this->source->removeElement($source);
            // set the owning side to null (unless already changed)
            
                $source->setSource(null);
            
        }

        return $this;
    }

    /**
     * @return Collection|Langues[]
     */
    public function getLangue(): Collection
    {
        return $this->langue;
    }

    public function addLangue(Langues $langue): self
    {
        if (!$this->langue->contains($langue)) {
            $this->langue[] = $langue;
            $langue->addLangueProjet($this);
        }

        return $this;
    }

    public function removeLangue(Langues $langue): self
    {
        if ($this->langue->contains($langue)) {
            $this->langue->removeElement($langue);
            $langue->removeLangueProjet($this);
        }

        return $this;
    }
}
