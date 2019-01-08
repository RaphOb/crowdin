<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LanguesRepository")
 */
class Langues extends AbstractType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $langue;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Projet", mappedBy="langue", cascade={"persist"})
     */
    private $LangueProjet;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Traduct", mappedBy="langues", cascade={"persist"})
     */
    private $traduct;

    public function __construct()
    {
        $this->LangueProjet = new ArrayCollection();
        $this->traduct = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    /**
     * toString
     * @return string
     */
    public function __toString()
    {
        return $this->langue;
    }

    public function setLangue(string $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    /**
     * @return Collection|Projet[]
     */
    public function getLangueProjet(): Collection
    {
        return $this->LangueProjet;
    }

    public function addLangueProjet(Projet $langueProjet): self
    {
        if (!$this->LangueProjet->contains($langueProjet)) {
            $this->LangueProjet[] = $langueProjet;
        }

        return $this;
    }

    public function removeLangueProjet(Projet $langueProjet): self
    {
        if ($this->LangueProjet->contains($langueProjet)) {
            $this->LangueProjet->removeElement($langueProjet);
        }

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
        }

        return $this;
    }

    public function removeTraduct(Traduct $traduct): self
    {
        if ($this->traduct->contains($traduct)) {
            $this->traduct->removeElement($traduct);
        }

        return $this;
    }
}
