<?php

namespace App\Entity;

use App\Repository\TagLinkRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagLinkRepository::class)]
class TagLink
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_tag = null;

    #[ORM\Column]
    private ?int $id_annonce = null;

    #[ORM\OneToOne(inversedBy: 'TagToTagLink', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tag $TagLinkToTag = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdTag(): ?int
    {
        return $this->id_tag;
    }

    public function setIdTag(int $id_tag): self
    {
        $this->id_tag = $id_tag;

        return $this;
    }

    public function getIdAnnonce(): ?int
    {
        return $this->id_annonce;
    }

    public function setIdAnnonce(int $id_annonce): self
    {
        $this->id_annonce = $id_annonce;

        return $this;
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
}
