<?php

namespace App\Repository;

use App\Domain\Entity\User\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Репозиторий для работы с сущностью Article.
 *
 * @extends ServiceEntityRepository<Article>
 */
class ArticleRepository extends ServiceEntityRepository
{
    /**
     * Конструктор репозитория.
     *
     * @param ManagerRegistry $registry Менеджер реестра для доступа к EntityManager.
     */
    public function __construct(ManagerRegistry $registry)
    {
        // Вызываем конструктор родительского класса для инициализации репозитория для сущности Article.
        parent::__construct($registry, Article::class);
    }

    /**
     * Метод для получения всех статей.
     *
     * @return Article[] Возвращает массив объектов Article, отсортированных по дате создания в убывающем порядке.
     */
    public function findAllArticles(): array
    {
        // Получаем все статьи, отсортированные по дате создания.
        return $this->findBy([], ['created_at' => 'DESC']);
    }

    /**
     * Метод для получения статьи по slug.
     *
     * @param string $slug ЧПУ (slug) статьи.
     * @return Article|null Возвращает статью по заданному slug или null, если статья не найдена.
     */
    public function findOneBySlug(string $slug): ?Article
    {
        // Ищем статью по значению поля slug.
        return $this->findOneBy(['slug' => $slug]);
    }
}
