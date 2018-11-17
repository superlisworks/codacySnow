<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Figure;
use App\Repository\FigureRepository;

class SiteController extends AbstractController
{
    /**
     * @Route("/site", name="site")
     */
    public function index()
    {
        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }
    
    /**
     * @Route("/", name="home")
     */
    public function home(FigureRepository $repo) {
    
        $figures = $repo->findAll();

        return $this->render('site/home.html.twig', [
            'figures' => $figures

        ]);
    }
    
    /**
     * @Route("/site/{id}", name="site_show")
     */
    
    public function show(Figure $figure){
         
        return $this->render('site/show.html.twig', [
            'figure' => $figure
        ]);
    }
}
 