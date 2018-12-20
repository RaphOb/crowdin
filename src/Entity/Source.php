<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @ORM\JoinColumn(name="source_id", referencedColumnName="id")
     * @ORM\JoinColumn(nullable=true)
     */
    private $source;

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
}
