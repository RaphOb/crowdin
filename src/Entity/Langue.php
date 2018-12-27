<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LangueRepository")
 */
class Langue
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=38)
     */
    private $langue;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Source", inversedBy="source")
     */
    private $drap;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="langues")
     */
    private $usLangue;

    public function __construct()
    {
        $this->drap = new ArrayCollection();
        $this->usLangue = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLangue(): ?string
    {
        return $this->langue;
    }

    public function setLangue(string $langue): self
    {
        $this->langue = $langue;

        return $this;
    }

    /**
     * @return Collection|Source[]
     */
    public function getDrap(): Collection
    {
        return $this->drap;
    }

    public function addDrap(Source $drap): self
    {
        if (!$this->drap->contains($drap)) {
            $this->drap[] = $drap;
        }

        return $this;
    }

    public function removeDrap(Source $drap): self
    {
        if ($this->drap->contains($drap)) {
            $this->drap->removeElement($drap);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsLangue(): Collection
    {
        return $this->usLangue;
    }

    public function addUsLangue(User $usLangue): self
    {
        if (!$this->usLangue->contains($usLangue)) {
            $this->usLangue[] = $usLangue;
        }

        return $this;
    }

    public function removeUsLangue(User $usLangue): self
    {
        if ($this->usLangue->contains($usLangue)) {
            $this->usLangue->removeElement($usLangue);
        }

        return $this;
    }
}
