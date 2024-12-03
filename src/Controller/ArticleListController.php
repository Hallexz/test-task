<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleListController extends AbstractController
{
    // Внедрение зависимости ArticleRepository для получения данных о статьях
    private $articleRepository;

    // Конструктор, который принимает ArticleRepository
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Обработчик маршрута для отображения списка всех статей.
     *
     * @Route("/article", name="articles_list")
     * 
     * @return Response Ответ с рендером шаблона для отображения списка статей
     */
    #[Route('/article', name: 'articles_list')]
    public function index(): Response
    {
        // Получаем список всех статей через репозиторий
        $articles = $this->articleRepository->findAllArticles();

        // Отправляем данные о статьях в шаблон для отображения
        return $this->render('article/list.html.twig', [
            'articles' => $articles, // Передаем статьи в шаблон
        ]);
    }
}
