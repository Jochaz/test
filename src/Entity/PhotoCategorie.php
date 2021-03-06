<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotoCategorieRepository")
 */
class PhotoCategorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $DescriptionPhotoCategorie;

    /**
     * @ORM\Column(type="blob")
     */
    private $PhotoCategorie;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CategorieArticle", mappedBy="PhotoCategorie")
     */
    private $categorieArticles;

    public function __construct()
    {
        $this->categorieArticles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescriptionPhotoCategorie(): ?string
    {
        return $this->DescriptionPhotoCategorie;
    }

    public function setDescriptionPhotoCategorie(?string $DescriptionPhotoCategorie): self
    {
        $this->DescriptionPhotoCategorie = $DescriptionPhotoCategorie;

        return $this;
    }

    public function getPhotoCategorie()
    {
        return  base64_encode(stream_get_contents($this->PhotoCategorie));
    }

    public function setPhotoCategorie($PhotoCategorie): self
    {
        $this->PhotoCategorie = $PhotoCategorie;

        return $this;
    }

    /**
     * @return Collection|CategorieArticle[]
     */
    public function getCategorieArticles(): Collection
    {
        return $this->categorieArticles;
    }

    public function addCategorieArticle(CategorieArticle $categorieArticle): self
    {
        if (!$this->categorieArticles->contains($categorieArticle)) {
            $this->categorieArticles[] = $categorieArticle;
            $categorieArticle->addPhotoCategorie($this);
        }

        return $this;
    }

    public function removeCategorieArticle(CategorieArticle $categorieArticle): self
    {
        if ($this->categorieArticles->contains($categorieArticle)) {
            $this->categorieArticles->removeElement($categorieArticle);
            $categorieArticle->removePhotoCategorie($this);
        }

        return $this;
    }
}
