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
     * @ORM\Column(type="string", length=68)
     */
    private $Langue;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Source", mappedBy="source", cascade="all", orphanRemoval=true)
     * @ORM\JoinColumn(name="source_id", referencedColumnName="id")
     */
    private $source;

    public function __construct()
    {
        $this->source = new ArrayCollection();
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

    public function getLangue(): ?string
    {
        return $this->Langue;
    }

    public function setLangue(string $Langue): self
    {
        $this->Langue = $Langue;

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
        return $this;
    }

    public function removeSource(Source $source): self
    {
        if ($this->source->contains($source)) {
            $this->source->removeElement($source);
            // set the owning side to null (unless already changed)
            if ($source->getSource() === $this) {
                $source->setSource(null);
            }
        }

        return $this;
    }
}
