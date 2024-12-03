<?php

namespace App\Controller;

use App\Service\ArticleService;
use App\Application\Service\ArticleServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleDetailController extends AbstractController
{
    // Внедрение зависимости ArticleServiceInterface для работы с сервисом статей
    private ArticleServiceInterface $articleService;

    // Конструктор, который принимает ArticleServiceInterface
    public function __construct(ArticleServiceInterface $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Обработчик маршрута для отображения подробной информации о статье.
     *
     * @Route("/article/{slug}", name="article_detail")
     * 
     * @param string $slug ЧПУ (slug) статьи, который используется для поиска
     * @return Response Ответ с рендером шаблона для отображения подробностей статьи
     */
    #[Route('/article/{slug}', name: 'article_detail')]
    public function detail(string $slug): Response
    {
        // Получаем статью по slug через сервис
        $article = $this->articleService->getArticleBySlug($slug);

        // Если статья не найдена, выбрасываем исключение 404
        if (!$article) {
            throw $this->createNotFoundException('Статья не найдена');
        }

        // Рендерим шаблон с деталями статьи
        return $this->render('article/detail.html.twig', [
            'article' => $article, // Передаем статью в шаблон
        ]);
    }
}
