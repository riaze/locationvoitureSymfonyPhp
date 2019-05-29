<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 17/12/2018
 * Time: 14:30
 */

namespace App\Controller;



use App\Entity\Brands;
use App\Entity\Booking;
use App\Entity\Membres;
use App\Entity\Vechicles;
use App\Form\BookingType;
use App\Form\MembresType;
use App\Form\ChangepasswordType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class ProjectController extends  AbstractController
{

    /**
     * @return Response
     * @Route("/", name="index")
     */
    public function Home(Request $request): Response
    {
        $AllVechicles=$this->getDoctrine()
                      ->getRepository(Vechicles::class)->findAll();
        return $this->render('index.html.twig', ['AllVechicles'=>$AllVechicles
        ]);

    }




    /** 
     * @param Request $request
     * @param $encoder
     * @return Response
     * @Route("/register",  name="register")
     */


    public function createRegister(Request $request, UserPasswordEncoderInterface $encoder):Response{
        // creation formulaire
        $membres = new Membres();
        $form = $this->createForm(MembresType::class,$membres);

        //traitment du formulaire

        $form->handleRequest($request);

        //verification valité
        if($form->isSubmitted() && $form->isValid()){
            $hash = $encoder->encodePassword($membres, $membres->getPassword() );
            $membres->setPassword($hash);
            $membres->setRoles(['ROLE_ADMIN']);
            $membres = $form->getData();

            $manger = $this->getDoctrine()->getManager();
            $manger->persist($membres);
            $manger->flush();

            /* unset($entity);
            unset($form);*/

            return $this->render('register.html.twig', [
                'createForm' => $form->createView(),
                'message' => "vous êtes bien inscrit et vous pouvez faire login "]);
        }

        //Renvoi du formulaire
        return $this->render('register.html.twig',[
            'createForm' => $form->createView(),
            'message' =>''
        ]);
    }

    /**
     * @return Response
     * @Route("/cardetails/{id}", name="carDetails")
     */
    public function carDetails(Request $request, $id): Response
    {   
        $PrintBookingMsg = false;
        $UserNotLogin= false;
        $entityManager = $this->getDoctrine()->getManager();
        $AllVechicles = $entityManager->getRepository(Vechicles::class)->find($id);
        $brands = $entityManager->getRepository(Brands::class)->find($AllVechicles->getBrands()->getId());
        
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);      
        $form->handleRequest($request);

      //verification valité
        
        
        if($this->getUser() && $form->isSubmitted() && $form->isValid()){
          
        $membres = $entityManager->getRepository(Membres::class)->find($this->getUser()->getId());   
        $booking->setVechicles($AllVechicles);
        $booking->setBrand($brands);
        $booking->setMembres($membres);
        $booking->setStatus('Not yet Comfirme');
        $booking = $form->getData();
        $entityManager->persist($booking);
        $entityManager->flush();
        unset($booking);
        $PrintBookingMsg = true;
        return $this->render('carDetails.html.twig', ['AllVechicles'=>$AllVechicles,
       'createForm' => $form->createView(), 'PrintBookingMsg'=>$PrintBookingMsg, 'UserNotLogin' =>$UserNotLogin]);

    }
      if(empty($this->getUser()) && $form->isSubmitted()){
        $UserNotLogin= true;
        return $this->render('carDetails.html.twig', ['AllVechicles'=>$AllVechicles,
        'createForm' => $form->createView(), 'PrintBookingMsg'=>$PrintBookingMsg, 'UserNotLogin' =>$UserNotLogin]);  
      }

      
      //create view 
     
        return $this->render('carDetails.html.twig', ['AllVechicles'=>$AllVechicles,
                            'createForm' => $form->createView(), 'PrintBookingMsg'=>$PrintBookingMsg, 'UserNotLogin' =>$UserNotLogin]);

    }


     /**
     * @return Response
     * @Route("/changepassord/", name="changepassord")
     * 
     */

    public function changePassord(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    { 
      $em = $this->getDoctrine()->getManager();
      $user = $this->getUser();
      $membre = new Membres();
    	$form = $this->createForm(ChangepasswordType::class, $membre);

    	$form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           
         
            $oldPassword = $request->request->get('changepassword')['oldPassword'];
            
            // Si l'ancien mot de passe est bon
            if ($passwordEncoder->isPasswordValid($user, $oldPassword)) {
                
                $newPassword = $request->request->get('changepassword')['plainPassword']["first"];
                
                
                $newEncodedPassword = $passwordEncoder->encodePassword($user, $newPassword);
                
               
                $user->setPassword($newEncodedPassword);
                
                $em->persist($user);
               
                $em->flush();

                $this->addFlash('notice', 'Votre mot de passe à bien été changé !');
                
                return $this->render('changepassword.html.twig', [
                  'createForm' => $form->createView()])  ;   
            } else {
                $form->addError(new FormError('Ancien mot de passe incorrect'));
            }
        }      
      
        return $this->render('changepassword.html.twig', [
                'createForm' => $form->createView()])  ;   
     
}
}