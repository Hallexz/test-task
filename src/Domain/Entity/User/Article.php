<?php

namespace App\Domain\Entity\User;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)] // Аннотация Doctrine для сущности Article, с указанием репозитория
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null; // Идентификатор статьи

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title; // Название статьи

    #[ORM\Column(type: "string", length: 255, unique: true)]
    private string $slug; // ЧПУ (slug) для статьи, уникальный

    #[ORM\Column(type: "boolean")]
    private bool $is_active; // Статус активности статьи

    #[ORM\Column(type: "integer")]
    private int $views; // Количество просмотров статьи

    #[ORM\Column(type: "text")]
    private string $description; // Описание статьи

    #[ORM\Column(type: "datetime_immutable")]
    private \DateTimeImmutable $created_at; // Дата и время создания статьи

    /**
     * Получает идентификатор статьи.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Получает название статьи.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Устанавливает название статьи.
     *
     * @param string $title
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Получает slug (ЧПУ) статьи.
     *
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * Устанавливает slug для статьи.
     *
     * @param string $slug
     * @return self
     */
    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Проверяет, активна ли статья.
     *
     * @return bool
     */
    public function isIsActive(): bool
    {
        return $this->is_active;
    }

    /**
     * Устанавливает статус активности статьи.
     *
     * @param bool $is_active
     * @return self
     */
    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;
        return $this;
    }

    /**
     * Получает количество просмотров статьи.
     *
     * @return int
     */
    public function getViews(): int
    {
        return $this->views;
    }

    /**
     * Устанавливает количество просмотров статьи.
     *
     * @param int $views
     * @return self
     */
    public function setViews(int $views): self
    {
        $this->views = $views;
        return $this;
    }

    /**
     * Получает описание статьи.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Устанавливает описание статьи.
     *
     * @param string $description
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Получает дату и время создания статьи.
     *
     * @return \DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->created_at;
    }

    /**
     * Устанавливает дату и время создания статьи.
     *
     * @param \DateTimeImmutable $created_at
     * @return self
     */
    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;
        return $this;
    }
}
