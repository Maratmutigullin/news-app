<?php

namespace App\Entity;

use App\Repository\NewsRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Table;

#[ORM\Entity(repositoryClass: NewsRepository::class)]
#[Table(name: 'news', options: ['comment' => 'Новости'])]
class News
{
    #[ORM\Id]
    #[GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, options: ['comment' => 'Дата создания новости'])]
    private ?DateTimeImmutable $dateCreate = null;

    #[ORM\Column(length: 1000, options: ['comment' => 'Заголовок новости'])]
    private ?string $title = null;

    #[ORM\Column(length: 1000, nullable: true, options: ['comment' => 'Автор новости'])]
    private ?string $author = null;

    #[ORM\Column(length: 1000, nullable: true, options: ['comment' => 'Сылка на новость'])]
    private ?string $url = null;

    #[ORM\Column(length: 1000, options: ['comment' => 'Ссылка на изображение'])]
    private ?string $urlToImage = null;

    #[ORM\ManyToOne(targetEntity: NewsCategory::class, inversedBy: 'news_category')]
    private ?NewsCategory $newsCategory = null;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCreate(): ?DateTimeImmutable
    {
        return $this->dateCreate;
    }

    public function setDateCreate(DateTimeImmutable $dateCreate): self
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getUrlToImage(): ?string
    {
        return $this->urlToImage;
    }

    public function setUrlToImage(string $urlToImage): static
    {
        $this->urlToImage = $urlToImage;

        return $this;
    }
    public function getNewsCategory(): Collection
    {
        return $this->newsCategory;
    }

    public function setNewsCategory(?NewsCategory $newsCategory): self
    {
        $this->newsCategory = $newsCategory;

        return $this;
    }
}
