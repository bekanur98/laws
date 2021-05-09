<?php

namespace App\Entity;

use App\Repository\NewsRepository;
use Doctrine\ORM\Mapping as ORM;
use \DateTime;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;

/**
 * @ORM\Entity(repositoryClass=NewsRepository::class)
 * @Vich\Uploadable()
 */
class News
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
    private $title_news;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $body_news;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $views;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $thumbnail;

    /**
     * @Vich\UploadableField(mapping="thumbnails", fileNameProperty="thumbnail")
     */
    private $thumbnailFile;


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

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->views = 0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleNews(): ?string
    {
        return $this->title_news;
    }

    public function setTitleNews(string $title_news): self
    {
        $this->title_news = $title_news;

        return $this;
    }

    public function getBodyNews(): ?string
    {
        return $this->body_news;
    }

    public function setBodyNews(?string $body_news): self
    {
        $this->body_news = $body_news;

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

    public function getViews(): ?int
    {
        return $this->views;
    }

    public function setViews(int $views): self
    {
        $this->views = $views;

        return $this;
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
}
