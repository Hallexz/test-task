<?php

namespace App\Application\Service;

use App\Domain\Entity\User\Article; // Импортируем класс Article, который будет использоваться в интерфейсе

/**
 * Интерфейс для сервиса статей.
 *
 * Описание всех методов, которые должен реализовать сервис работы со статьями.
 */
interface ArticleServiceInterface
{
    /**
     * Добавляет несколько статей в систему.
     *
     * @param array $article Массив данных о статьях для добавления
     * @return array Массив сообщений об успехе или ошибке для каждой статьи
     */
    public function addArticles(array $article): array;

    /**
     * Получает статью по ее slug.
     *
     * @param string $slug Уникальный идентификатор (slug) статьи
     * @return Article|null Возвращает статью, если найдена, или null, если статья не найдена
     */
    public function getArticleBySlug(string $slug): ?Article;
}
