<?php

namespace App\Controller;

use App\Entity\Membres;
use App\Entity\Vechicles;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
        //return $this->render('index.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @return Response
     * @Route({"/user"}, name="userlogin")
     */

        public function logout(): Response {
            
            $AllVechicles=$this->getDoctrine()
                      ->getRepository(Vechicles::class)->findAll();
             return $this->render('index.html.twig', ['AllVechicles'=>$AllVechicles
                ]);
    
            
            //return $this->render('admin.html.twig');
 

    }

}