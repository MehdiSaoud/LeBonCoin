<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToOne(mappedBy: 'TagLinkToTag', cascade: ['persist', 'remove'])]
    private ?TagLink $TagToTagLink = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTagToTagLink(): ?TagLink
    {
        return $this->TagToTagLink;
    }

    public function setTagToTagLink(TagLink $TagToTagLink): self
    {
        // set the owning side of the relation if necessary
        if ($TagToTagLink->getTagLinkToTag() !== $this) {
            $TagToTagLink->setTagLinkToTag($this);
        }

        $this->TagToTagLink = $TagToTagLink;

        return $this;
    }
}
