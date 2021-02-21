<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 */
class Question
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title_question;

    /**
     * @ORM\Column(type="text")
     */
    private $body_question;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $views;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rating;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $is_answered;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    public function __construct()
    {
        $this->is_answered = false;
        $this->created_at = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleQuestion(): ?string
    {
        return $this->title_question;
    }

    public function setTitleQuestion(string $title_question): self
    {
        $this->title_question = $title_question;

        return $this;
    }

    public function getBodyQuestion(): ?string
    {
        return $this->body_question;
    }

    public function setBodyQuestion(string $body_question): self
    {
        $this->body_question = $body_question;

        return $this;
    }

    public function getViews(): ?int
    {
        return $this->views;
    }

    public function setViews(?int $views): self
    {
        $this->views = $views;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(?int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function getIsAnswered(): ?bool
    {
        return $this->is_answered;
    }

    public function setIsAnswered(?bool $is_answered): self
    {
        $this->is_answered = $is_answered;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
