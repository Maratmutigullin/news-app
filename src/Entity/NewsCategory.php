<?php

namespace App\Entity;

use App\Repository\NewsCategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Table;

#[ORM\Entity(repositoryClass: NewsCategoryRepository::class)]
#[Table(name: 'news_category', options: ['comment' => 'Категории новостей'])]
class NewsCategory
{
    #[ORM\Id]
    #[GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true, options: ['comment' => 'Название категории'])]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true, options: ['comment' => 'Код категории'])]
    private ?string $code = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): static
    {
        $this->code = $code;

        return $this;
    }
}
