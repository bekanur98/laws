<?php

namespace App\Entity;

use App\Repository\AnswerLikeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnswerLikeRepository::class)
 */
class AnswerLike
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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isUpvote;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="answerLikes")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Answer::class, inversedBy="answerLikes")
     */
    private $answer;

    public function __construct()
    {
        $this->user = new ArrayCollection();
        $this->answer = new ArrayCollection();
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

    public function getIsUpvote(): ?bool
    {
        return $this->isUpvote;
    }

    public function setIsUpvote(?bool $isUpvote): self
    {
        $this->isUpvote = $isUpvote;

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
     * @return Collection|Answer[]
     */
    public function getAnswer(): Collection
    {
        return $this->answer;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answer->contains($answer)) {
            $this->answer[] = $answer;
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        $this->answer->removeElement($answer);

        return $this;
    }
}
