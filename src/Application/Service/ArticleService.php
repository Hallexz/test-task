<?php

namespace App\Application\Service;

use App\Domain\Entity\User\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Application\Service\ArticleServiceInterface; // Импортируем интерфейс для сервиса статей

class ArticleService implements ArticleServiceInterface // Реализуем интерфейс ArticleServiceInterface
{
    private ArticleRepository $articleRepository; // Репозиторий для работы со статьями
    private EntityManagerInterface $entityManager; // Менеджер сущностей для взаимодействия с базой данных

    // Конструктор класса, внедрение зависимостей
    public function __construct(ArticleRepository $articleRepository, EntityManagerInterface $entityManager)
    {
        $this->articleRepository = $articleRepository; // Инициализация репозитория
        $this->entityManager = $entityManager; // Инициализация менеджера сущностей
    }

    // Метод для добавления нескольких статей
    public function addArticles(array $articles): array
    {
        $messages = []; // Массив для хранения сообщений о добавленных статьях

        // Проходим по всем данным о статьях
        foreach ($articles as $data) {
            // Проверяем, существует ли статья с таким же slug
            $existingArticle = $this->articleRepository->findOneBy(['slug' => $data['slug']]);

            // Если статья с таким slug уже существует, добавляем сообщение
            if ($existingArticle) {
                $messages[] = "Статья с идентификатором '{$data['slug']}' уже существует: '{$existingArticle->getTitle()}'";
            } else {
                // Если статья не найдена, создаем новую статью
                $article = new Article();
                $article->setTitle($data['title']); // Устанавливаем заголовок статьи
                $article->setSlug($data['slug']); // Устанавливаем slug
                $article->setIsActive($data['isActive']); // Устанавливаем статус активности
                $article->setViews($data['views']); // Устанавливаем количество просмотров
                $article->setDescription($data['description']); // Устанавливаем описание статьи
                $article->setCreatedAt(new \DateTimeImmutable()); // Устанавливаем дату создания статьи

                // Добавляем статью в менеджер сущностей
                $this->entityManager->persist($article);
                $messages[] = "Статья '{$data['title']}' добавлена."; // Добавляем сообщение об успешном добавлении
            }
        }

        // Применяем все изменения в базе данных
        $this->entityManager->flush();

        // Возвращаем массив сообщений
        return $messages;
    }

    // Метод для получения статьи по slug
    public function getArticleBySlug(string $slug): ?Article
    {
        return $this->articleRepository->findOneBy(['slug' => $slug]); // Возвращаем статью по slug
    }
}