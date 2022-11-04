<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ArticleRepository $articleRepository, CategoryRepository $categoryRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'articles' => $articleRepository->findAll(),
            'categories' => $categoryRepository->findAll()
        ]);
    }

    #[Route('/article/{id}', name: 'user_article_show', methods: ['GET'])]
    public function show(Article $article): Response
    {
        return $this->render('home/show.html.twig', [
            'article' => $article,
        ]);
    }


    #[Route('/categorie/{id}', name: 'user_articles_filtre', methods: ['GET'])]
    public function filtreArticle($id, CategoryRepository $categoryRepository, ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findBy(['category' => $id]); //comparaison d'un objet avec un entier que symfony va gérer uniquement sur l'id
        return $this->render('home/filtre.html.twig', [
            'articles' => $articles,
            'categories' => $categoryRepository->findAll()

        ]);
    }
}
