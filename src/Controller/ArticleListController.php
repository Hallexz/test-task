<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    private $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @Route("/articles", name="articles_list")
     */
    public function index(): Response
    {
        // Получаем список всех статей
        $articles = $this->articleRepository->findAllArticles();

        // Отправляем данные в шаблон
        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
