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
use App\Form\FigureType;
use App\Entity\Comment;
use App\Form\CommentType;
use App\Entity\Media;

class SiteController extends AbstractController
{
    /**
     * @Route("/site", name="site")
     */
    public function index()
    {
        return $this->render('site/home.html.twig', [
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
     * @Route("/new", name="site_create")
     * @Route("/new/{id}/edit", name="site_edit")
     */

    public function form(Figure $figure = null, Request $request, ObjectManager $manager) {

            if(!$figure) {
                $figure = new Figure();
            }
            
            //$media = new Media();
            
            //$media->setTitle('Http://placehold.it/400x200')
               //   ->setType(1);
                  
           // $figure->addMedia($media);   

            $form = $this->createForm(FigureType::class, $figure);

             $form->handleRequest($request); 
             
            
             if($form->isSubmitted() && $form->isValid()) {
                if(!$figure->getId()){
                   $figure->setCreateAt(new \DateTime()); 
            }
                
                $manager->persist($figure);
                $manager->flush();
                


                return $this->redirectToRoute('site_show', [
                    'id' => $figure->getId()]);
        }  
                        
             return $this->render('site/create.html.twig', [
                'formFigure' => $form->createView(),
                'editMode'   => $figure->getId() !== null
            ]);
        }

    /**
     * @Route("/site/{id}", name="site_show")
     */
    
    public function show(Figure $figure, Request $request, ObjectManager $manager){
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $comment->setCreateAt(new \DateTime())
                    ->setFigure($figure);

            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('site_show', ['id' => $figure->getId()]);
        }

         
        return $this->render('site/show.html.twig', [
            'figure' => $figure,
            'commentForm' => $form->createView()
        ]);
    }

    
}
 