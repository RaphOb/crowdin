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
     * @ORM\ManyToMany(targetEntity="App\Entity\Projet", inversedBy="langue", cascade={"persist"})
     */
    private $LangueProjet;

    public function __construct()
    {
        $this->LangueProjet = new ArrayCollection();
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
}
