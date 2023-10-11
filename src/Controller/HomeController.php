<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(ArticleRepository $articleRepository): Response
    {
        $articles=$articleRepository->findAll();
        // dd($articles);
        return $this->render('home/home.html.twig', [
            'controller_name' => 'Hello World!',
            'articles' => $articles,
        ]);
    }


    #[Route('/show {id}', name: 'show')]
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

    
}
