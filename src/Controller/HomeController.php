<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\Mapping\Id;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(ArticleRepository $articleRepository, CategoryRepository $categoryRepository): Response
    {
        $articles=$articleRepository->findAll();
        $categories = $categoryRepository->findAll();
        

        // dd($articles);
        return $this->render('home/home.html.twig', [
            'controller_name' => 'Hello World!',
            'titre'=>'Categories',
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }


    #[Route('/show/{id}', name: 'show')]
    public function show( ArticleRepository $articleRepository ,$id): Response
    {
        // $articles = $articleRepository1->find();
        // // dd($articles);
        // return $this->render('home/home.html.twig', [
        //     'controller_name' => 'Hello World!',
        //     'articles' => $articles,
        // ]);


        $article = $articleRepository->find($id);
       
        // dd($articles);
        return $this->render('home/show.html.twig', [
            
            'article' => $article,
         
        ]);
    
        
    }



    #[Route('/showArticleCategory/{id}', name: 'show_articles_category')]
    public function showArticlesCategorie(Category $category, CategoryRepository $categoryRepository): Response
    {

        $categories = $categoryRepository->findAll();

        if ($category) {

            $articles = $category->getArticles()->getValues();
        } else {

            return $this->redirectToRoute('app_home');
        }
        // $categorie = $categoryRepository->find($id);
        //dd($articles);

        return $this->render('home/home.html.twig', [
            'articles' => $articles,
            'categories' => $categories
        ]);
    }


    
}
