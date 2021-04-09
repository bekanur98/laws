<?php

namespace App\Entity;

use App\Repository\QuestionLikeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionLikeRepository::class)
 */
class QuestionLike
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isLiked;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="questionLikes")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Question::class, inversedBy="questionLikes")
     */
    private $question;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isUpvote;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->question = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsLiked(): ?bool
    {
        return $this->isLiked;
    }

    public function setIsLiked(?bool $isLiked): self
    {
        $this->isLiked = $isLiked;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        $this->user->removeElement($user);

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestion(): Collection
    {
        return $this->question;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->question->contains($question)) {
            $this->question[] = $question;
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        $this->question->removeElement($question);

        return $this;
    }

    public function getIsUpvote(): ?bool
    {
        return $this->isUpvote;
    }

    public function setIsUpvote(?bool $isUpvote): self
    {
        $this->isUpvote = $isUpvote;

        return $this;
    }
}
