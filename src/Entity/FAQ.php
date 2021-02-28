<?php

namespace App\Entity;

use App\Repository\FAQRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FAQRepository::class)
 */
class FAQ
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
    private $question_faq;

    /**
     * @ORM\Column(type="text")
     */
    private $answer_faq;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $views;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->views = 0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionFaq(): ?string
    {
        return $this->question_faq;
    }

    public function setQuestionFaq(string $question_faq): self
    {
        $this->question_faq = $question_faq;

        return $this;
    }

    public function getAnswerFaq(): ?string
    {
        return $this->answer_faq;
    }

    public function setAnswerFaq(string $answer_faq): self
    {
        $this->answer_faq = $answer_faq;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreateAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

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

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
