<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
   /**
   *@Route("/inscription", name="security_registration")
   */

    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder) {
    	$user = new User();

    	$form = $this->createForm(RegistrationType::class, $user);

    	$form->handleRequest($request);

    	if($form->isSubmitted() && $form->isValid()) {
    		$hash = $encoder->encodePassword($user, $user->getPassword());

    		$user->setPassword($hash);
            

            $user->setLastConnection(new \DateTime ());
    		
    		$manager->persist($user);	
    		$manager->flush();
    		
    		$this->addFlash(
    		    'success',
    		    "Votre compte a bien été créé !, vous pouvez vous connecter :)"
    		    );
    		
            return $this->redirectToRoute('security_login');
    	}

    	return $this->render('security/registration.html.twig', [
    			'form' => $form->createView()
    	]);
     }
    

    /**
    * @Route("/connexion", name="security_login")
    */

    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        
        return $this->render('security/login.html.twig', [
            'hasError' => $error !== null
        ]);
    }

    /**
    * @Route("/deconnexion", name="security_logout")
    */

    public function logout() {}

}
