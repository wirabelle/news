<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\NewsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NewsRepository::class)
 */
#[ApiResource]
class News
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    protected $id;

    /**
     * News title.
     *
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    protected $title;

    /**
     * News description.
     *
     * @ORM\Column(type="text")
     *
     * @var string
     */
    protected $description;

    /**
     * News image.
     *
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    protected $image;

    /**
     * News description.
     *
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    protected $publishedAt;

    /**
     * Get the value of id.
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get news title.
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set news title.
     */
    public function setTitle(string $title): ?self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get news description.
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set news description.
     */
    public function setDescription(string $description): ?self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get news image.
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * Set news image.
     */
    public function setImage(string $image): ?self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get news description.
     */
    public function getPublishedAt(): ?\DateTime
    {
        return $this->publishedAt;
    }

    /**
     * Set news description.
     */
    public function setPublishedAt(\DateTime $publishedAt): ?self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }
}
