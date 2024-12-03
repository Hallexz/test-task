<?php

namespace App\Controller;

use App\Service\ArticleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Application\Service\ArticleServiceInterface;

class ArticleAddController extends AbstractController
{
    // Внедрение зависимости ArticleServiceInterface для работы с сервисом статей
    private ArticleServiceInterface $articleService;

    // Конструктор, который принимает ArticleServiceInterface
    public function __construct(ArticleServiceInterface $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Обработчик маршрута для добавления статьи.
     *
     * @Route("/article/add", name="article_add")
     * 
     * @param Request $request HTTP-запрос
     * @return Response Ответ с отображением страницы
     */
    #[Route('/article/add', name: 'article_add')]
    public function add(Request $request): Response
    {
        // Если получен POST-запрос, то выполняем добавление статьи
        if ($request->isMethod('POST')) {
            // Пример данных статьи, которые будут добавлены
            $articles = [
                ['title' => 'Статья 14', 'slug' => 'statya-14', 'isActive' => true, 'views' => 450000000, 'description' => 'ОВАВАВАВАЫВА'],
            ];

            // Добавляем статьи через ArticleService и получаем сообщения о результате
            $messages = $this->articleService->addArticles($articles);

            // Рендерим шаблон и передаем сообщения об успешном или неуспешном добавлении
            return $this->render('article/add.html.twig', [
                'messages' => $messages, // Переменная с результатами добавления
            ]);
        }

        // Если запрос не POST, просто отображаем страницу без добавления статей
        return $this->render('article/add.html.twig', [
            'messages' => [], // Пустое сообщение, так как статьи не добавляются
        ]);
    }
}
