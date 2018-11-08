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
*@Route("/blog/12", name="blog_show")
*/
    public function show() {
    	return $this->render('blog/show.html.twig');
    }
    
    /**
     * @Route("/blog", name="blog_create")
     */
    
    public function create() {
        return $this->render('blog/create.html.twig');
    }
}
