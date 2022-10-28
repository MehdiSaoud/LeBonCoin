<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Annonce $id_annonce = null;

    #[ORM\ManyToOne(inversedBy: 'comments')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $id_user = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $creation_date = null;

    #[ORM\Column(length: 255)]
    private ?string $question = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $response = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $response_date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAnnonce(): ?Annonce
    {
        return $this->id_annonce;
    }

    public function setIdAnnonce(?Annonce $id_annonce): self
    {
        $this->id_annonce = $id_annonce;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->id_user;
    }

    public function setIdUser(?User $id_user): self
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getCreationDate(): ?\DateTimeImmutable
    {
        return $this->creation_date;
    }

    public function setCreationDate(\DateTimeImmutable $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }

    public function setResponse(?string $response): self
    {
        $this->response = $response;

        return $this;
    }

    public function getResponseDate(): ?\DateTimeImmutable
    {
        return $this->response_date;
    }

    public function setResponseDate(?\DateTimeImmutable $response_date): self
    {
        $this->response_date = $response_date;

        return $this;
    }

}
