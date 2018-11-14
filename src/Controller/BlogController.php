<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Figure;
use App\Repository\FigureRepository;
use App\Form\ArticleType;


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
     * @Route("/blog/new", name="blog_create")
     * @Route("/blog/{id}/edit" , name="blog_edit")
     */
    public function form(Figure $figure = null, Request $request, ObjectManager $manager) {
        
        
        if(!$figure) {
            $figure = new Figure();
        }
       // $form = $this->createFormBuilder($figure)
                   //  ->add('nom') 
                   //  ->add('content') 
                    // ->add('image')
                     //->add('video')
                    // ->add('auteur')
                     //->getForm();
        $form = $this->createForm(FigureType::class, $figure);
                    $form->handleRequest($request); 
                    
                    if($form->isSubmitted() && $form->isValid()) {
                        if(!$figure->Id()){
                        $figure->setCreateDate(new \DateTime());
                        }
                        
                        $manager->persist($figure);
                        $manager->flush();
                        
                        return $this->redirectRoute('blog_show' , ['id' => $figure->getId()]);
                    }
        
        return $this->render('blog/create.html.twig', [
            'formFigure' => $form->createView(),
            'editMode' => $figure->getId() !== null
        ]);
    }

/**
*@Route("/blog/{id}", name="blog_show")
*/
    public function show(Figure $figure){
       
    	return $this->render('blog/show.html.twig', [
    	    'figure' => $figure
    	]);
    }
    
  
}

