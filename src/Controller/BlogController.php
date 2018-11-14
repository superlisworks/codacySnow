<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig');
            
    }

    /**
    *@route("/", name="home")
    */
    public function home() {
    	return $this->render('blog/home.html.twig');
    }

/**
*@Route("/blog/{id}", name="blog_show")
*/
    public function show($id) {
        $repo = $this->getDoctrine()->getRepository(Figure::class);
        
        $figure = $repo->find($id);
    	return $this->render('blog/show.html.twig', [
    	    'figure' => $figure
    	]);
    }
    
    
}
