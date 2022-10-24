<?php

namespace App\Entity;

use App\Repository\TagLinkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagLinkRepository::class)]
class TagLink
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\OneToOne(inversedBy: 'TagToTagLink', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tag $TagLinkToTag = null;

    #[ORM\ManyToMany(targetEntity: annonce::class, inversedBy: 'tagLinks')]
    private Collection $id_annonce;

    public function __construct()
    {
        $this->id_annonce = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTagLinkToTag(): ?Tag
    {
        return $this->TagLinkToTag;
    }

    public function setTagLinkToTag(Tag $TagLinkToTag): self
    {
        $this->TagLinkToTag = $TagLinkToTag;

        return $this;
    }

    /**
     * @return Collection<int, annonce>
     */
    public function getIdAnnonce(): Collection
    {
        return $this->id_annonce;
    }

    public function addIdAnnonce(annonce $idAnnonce): self
    {
        if (!$this->id_annonce->contains($idAnnonce)) {
            $this->id_annonce->add($idAnnonce);
        }

        return $this;
    }

    public function removeIdAnnonce(annonce $idAnnonce): self
    {
        $this->id_annonce->removeElement($idAnnonce);

        return $this;
    }
}
