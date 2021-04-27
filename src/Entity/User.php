<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields={"email", "username"}, message="This one is already taken")
 * @Vich\Uploadable()
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=32, unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone_number;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_locked;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $confirmation_token;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $requested_at;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_lawyer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $law_licence_no;

    /**
     * @ORM\Column(type="boolean")
     */
    private $gender;

    /**
     * @ORM\Column(type="integer")
     */
    private $law_rating;

    /**
     * @ORM\OneToMany(targetEntity=Question::class, mappedBy="user")
     */
    private $questions;

    /**
     * @ORM\OneToMany(targetEntity=Answer::class, mappedBy="user")
     */
    private $answers;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $thumbnail;

    /**
     * @Vich\UploadableField(mapping="thumbnails", fileNameProperty="thumbnail")
     */

    private $thumbnailFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=QuestionLike::class, mappedBy="user")
     */
    private $questionLikes;

    /**
     * @ORM\ManyToMany(targetEntity=AnswerLike::class, mappedBy="user")
     */
    private $answerLikes;

    /**
     * @return mixed
     */
    public function getThumbnailFile()
    {
        return $this->thumbnailFile;
    }

    /**
     * @param mixed $thumbnailFile
     */
    public function setThumbnailFile($thumbnailFile): void
    {
        $this->thumbnailFile = $thumbnailFile;

        if($thumbnailFile) {
            $this->updatedAt = new \DateTime();
        }
    }

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->is_locked = true;
        $this->requested_at = new DateTime();
        $this->updatedAt = new \DateTime();
        if($this->getCreatedAt() == null) {
            $this->createdAt = new \DateTime();
        }
        $this->law_rating = 0;
        $this->questions = new ArrayCollection();
        $this->answers = new ArrayCollection();
        $this->questionLikes = new ArrayCollection();
        $this->answerLikes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return  $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function setPhoneNumber(?string $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function getIsLocked(): ?bool
    {
        return $this->is_locked;
    }

    public function setIsLocked(bool $is_locked): self
    {
        $this->is_locked = $is_locked;

        return $this;
    }

    public function getConfirmationToken(): ?string
    {
        return $this->confirmation_token;
    }

    public function setConfirmationToken(string $confirmation_token): self
    {
        $this->confirmation_token = $confirmation_token;

        return $this;
    }

    public function getRequestedAt(): ?\DateTimeInterface
    {
        return $this->requested_at;
    }

    public function setRequestedAt(\DateTimeInterface $requested_at): self
    {
        $this->requested_at = $requested_at;

        return $this;
    }

    public function getIsLawyer(): ?bool
    {
        return $this->is_lawyer;
    }

    public function setIsLawyer(bool $is_lawyer): self
    {
        $this->is_lawyer = $is_lawyer;

        return $this;
    }

    public function getLawLicenceNo(): ?string
    {
        return $this->law_licence_no;
    }

    public function setLawLicenceNo(?string $law_licence_no): self
    {
        $this->law_licence_no = $law_licence_no;

        return $this;
    }

    public function getGender(): ?bool
    {
        return $this->gender;
    }

    public function setGender(?bool $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getLawRating(): ?int
    {
        return $this->law_rating;
    }

    public function setLawRating(?int $law_rating): self
    {
        $this->law_rating = $law_rating;

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setUser($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): self
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getUser() === $this) {
                $question->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Answer[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setUser($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getUser() === $this) {
                $answer->setUser(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->username;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(?string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $this->createdAt;

        return $this;
    }

    /**
     * @return Collection|QuestionLike[]
     */
    public function getQuestionLikes(): Collection
    {
        return $this->questionLikes;
    }

    public function addQuestionLike(QuestionLike $questionLike): self
    {
        if (!$this->questionLikes->contains($questionLike)) {
            $this->questionLikes[] = $questionLike;
            $questionLike->addUser($this);
        }

        return $this;
    }

    public function removeQuestionLike(QuestionLike $questionLike): self
    {
        if ($this->questionLikes->removeElement($questionLike)) {
            $questionLike->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection|AnswerLike[]
     */
    public function getAnswerLikes(): Collection
    {
        return $this->answerLikes;
    }

    public function addAnswerLike(AnswerLike $answerLike): self
    {
        if (!$this->answerLikes->contains($answerLike)) {
            $this->answerLikes[] = $answerLike;
            $answerLike->addUser($this);
        }

        return $this;
    }

    public function removeAnswerLike(AnswerLike $answerLike): self
    {
        if ($this->answerLikes->removeElement($answerLike)) {
            $answerLike->removeUser($this);
        }

        return $this;
    }
}
