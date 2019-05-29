<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 21/12/2018
 * Time: 14:55
 */

namespace App\Controller;
use App\Entity\Brands;
use App\Entity\Booking;
use App\Entity\Membres;
use App\Entity\Vechicles;
use App\Form\VechiclesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
  * Require ROLE_ADMIN for *every* controller method in this class.
  *
  * @IsGranted("ROLE_ADMIN")
  */
class AdminController extends AbstractController
{
    private $date;

    public function __construct()
    {
        $this->date = new \DateTime();
    }
    /**
      * @return Response 
      * Require ROLE_ADMIN for only this controller method.
      * @Route("/admin", name="admin")
      * @IsGranted("ROLE_ADMIN")
      */
    public function adminDashboard(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        // or add an optional message - seen by developers
        
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        $AllMembres = $this->getDoctrine()
            ->getRepository(Membres::class)->findAll();
            $AllMembres=count($AllMembres);
        $AllBrands=$this->getDoctrine()
                    ->getRepository(Brands::class)->findAll();
                    $AllBrands=count($AllBrands);
        $AllVechicles=$this->getDoctrine()
                    ->getRepository(Vechicles::class)->findAll();
                    $AllVechicles=count($AllVechicles);  
        $AllBooking=$this->getDoctrine()
                    ->getRepository(Booking::class)->findAll();
                    $AllBooking=count($AllBooking);                       
        
        return $this->render('admin/dashboard.html.twig', [
          
          'AllMembres' => $AllMembres,
          'AllBrands'=>$AllBrands,
          'AllVechicles'=>$AllVechicles,
          'AllBooking'=>$AllBooking,

          
      ]);
    }

    /**
     * @return Response
     * @Route("/admin/createbrands", name="createBrands")
     * 
     */

    public function createBrands(Request $request)
    {
      // creation formulaire
      $brands = new Brands();
      $form = $this->createFormBuilder($brands)
              ->add('BrandName', TextType::class)
              
              ->getForm();

      //traitment du formulaire

      $form->handleRequest($request);

      //verification valité
       if($form->isSubmitted() && $form->isValid()){
        $brands->setCreatedDate(new \DateTime());
        $brands->setUpdatedDate(new \DateTime());

        $manger = $this->getDoctrine()->getManager();
        $manger->persist($brands);
        $manger->flush();
        unset($brands);
       
      } //create view 
        return $this->render('admin/createBrand.html.twig', [
          'createForm' => $form->createView()]); 
       
    }

    /**
     * @return Response
     * @Route("/admin/managebrands", name="manageBrands")
     * 
     */

    public function ManageBrands(Request $request):Response
    {
      $brands = new Brands();
      /*$form = $this->createFormBuilder(null)
             
              ->add('Search', SearchType::class, ['attr'=>['id'=>'myInput', 
                'onclick'=>'myFunction']])
              
              ->getForm();*/

      $AllBrands=$this->getDoctrine()
                      ->getRepository(Brands::class)->findAll();
      return $this->render('admin/manageBrands.html.twig',
                    ['AllBrands'=>$AllBrands]);
    }  

    /**
     * @return Response
    * @Route("/brands/edit/{id}", name="updateBrands")
    */
    
    public function updateBrands(Request $request, $id): Response
    { 
    $entityManager = $this->getDoctrine()->getManager();
    $brands = $entityManager->getRepository(Brands::class)->find($id);
   
    $form = $this->createFormBuilder($brands)
              ->add('BrandName', TextType::class,  ['data' => $brands->getBrandName()])
              
              ->getForm();

    if (!$brands) {
        throw $this->createNotFoundException(
            'No brands found for id '.$id
        );
    }

    
    $form->handleRequest($request);

      //verification valité
       if($form->isSubmitted() && $form->isValid()){
        $brands->setCreatedDate($brands->getCreatedDate());
        $brands->setUpdatedDate(new \DateTime());

        
        $entityManager->flush();

    return $this->redirectToRoute('manageBrands');
}

        return $this->render('admin/updateBrands.html.twig', [
    'createForm' => $form->createView()]);

}
 /**
     * @return Response
    * @Route("/brands/delete/{id}", name="deleteBrands")
    */
    
    public function deleteBrands($id): Response
    { 
        $entityManager = $this->getDoctrine()->getManager();
        $brands = $entityManager->getRepository(Brands::class)->find($id);
        $entityManager->remove($brands);
        
        $entityManager->flush();
        return $this->redirectToRoute('manageBrands');
    }

    /**
     * @return Response
     * @Route("/admin/postvechicles", name="postVechicles")
     * 
     */

    public function postVechicles(Request $request):Response
    {
      // creation 
     
      $vechicles = new Vechicles();
      $brands  = new Brands();    
      
      
      /*$brands->setBrandName('hello');
      $vechicles->getBrands()->add($brands);*/
      
      $form = $this->createForm(VechiclesType::class, $vechicles); 
      /*$form->add('BrandsNames', ChoiceType::class, array("mapped" => false));*/
     
      //traitment du formulaire

      $form->handleRequest($request);

      //verification valité
       if($form->isSubmitted() && $form->isValid()){
        
        
        
        $manger = $this->getDoctrine()->getManager();
        $manger->persist($vechicles);
        
        $manger->flush();
        unset($vechicles);
       
        return $this->render('admin/postVechicles.html.twig', [
          'createForm' => $form->createView()
          ]); 
          
      } //create view 
        return $this->render('admin/postVechicles.html.twig', [
          'createForm' => $form->createView()]); 
       
    }

    /**
     * @return Response
     * @Route("/admin/managevechicles", name="manageVechicles")
     * 
     */

    public function ManageVechicles(Request $request):Response
    {
      $vechicle = new Vechicles();
      $brand = new Brands();
      /*$form = $this->createFormBuilder(null)
             
              ->add('Search', SearchType::class, ['attr'=>['id'=>'myInput', 
                'onclick'=>'myFunction']])
              
              ->getForm();*/

    $AllVechicles=$this->getDoctrine()
                      ->getRepository(Vechicles::class)->findAll();
    
                      

      return $this->render('admin/manageVechicles.html.twig',
                    ['AllVechicles'=>$AllVechicles
                    ]);

     
    } 

    /**
     * @return Response
    * @Route("/vechicles/edit/{id}", name="updateVechicles")
    */
    
    public function updateVechicles(Request $request, $id): Response
    { 
    $entityManager = $this->getDoctrine()->getManager();
    $vechicles = $entityManager->getRepository(Vechicles::class)->find($id);
   
    $form = $this->createFormBuilder($vechicles)
              
              ->add('vechicleTitle', TextType::class,  ['data' => $vechicles->getVechicleTitle()])
              ->add('VechilcleOverview', TextType::class,  ['data' => $vechicles->getVechilcleOverview()])
              ->add('Brands', EntityType::class, [
                'class'=> 'App\Entity\Brands',
                
                'choice_label'=>'BrandName' ,
                'data' => $vechicles->getVechicleTitle()
                ])
              ->add('PrricePerDay')
              ->add('FuelType', ChoiceType::class,
                      [
                          'choices' => [
                              'Diesel'=> 'Diesel',
                              'petrol'=> 'Petrol',
                              'gaz'=> 'Gaz',
                          ]
                      ]
                    )
              ->add('ModelYear')
              ->add('SeatingCapacity')
              ->add('Vimage1')
              ->add('Vimage2')
              ->add('Vimage')
              ->add('AirConditioner')
              ->add('PowerDoorLocks')
              ->add('AntiLockBraking')
              ->add('BreakAssist')
              ->add('PowerSteering')
              ->add('DriverAirBag')
              ->add('regDate')
              ->add('UpdationDate')
              
              ->getForm();

    if (!$vechicles) {
        throw $this->createNotFoundException(
            'No vechicles found for id '.$id
        );
    }

    
    $form->handleRequest($request);

      //verification valité
       if($form->isSubmitted() && $form->isValid()){
        
        
        $entityManager->flush();

    return $this->redirectToRoute('manageVechicles');
}

        return $this->render('admin/updateVechicles.html.twig', [
    'createForm' => $form->createView()]);

}

/**
     * @return Response
    * @Route("/Vechicles/delete/{id}", name="deleteVechicles")
    */
    
    public function deleteVechicles($id): Response
    { 
        $entityManager = $this->getDoctrine()->getManager();
        $vechicle = $entityManager->getRepository(Vechicles::class)->find($id);
        $entityManager->remove($vechicle);
        $entityManager->flush();
        return $this->redirectToRoute('manageVechicles');
    }

    /**
     * @return Response
     * @Route("/admin/managebooking", name="manageBookings")
     * 
     */

    public function ManageBooking(Request $request):Response
    {
      $entityManager = $this->getDoctrine()->getManager();
      $bookings = $entityManager 
                      ->getRepository(Booking::class)->findAll();
                      
    
                      

      return $this->render('admin/manageBookings.html.twig',
                    ['bookings'=>$bookings
                    ]);

     
    } 
     /**
     * @return Response
     * @Route("/deletebooking/{id}", name="deletebookings")
     * 
     */

    public function deleteBooking($id): Response
    { 
        $entityManager = $this->getDoctrine()->getManager();
        $booking = $entityManager->getRepository(Booking::class)->find($id);
        $entityManager->remove($booking);
        $entityManager->flush();
        return $this->redirectToRoute('manageBookings');
    }

       /**
     * @return Response
     * @Route("/confirme/{id}/{status}", name="confirmebookings")
     * 
     */

    public function confirmeBooking($id, $status): Response
    { 
      if($status == 'confirmed')
      {
        $status ='cancelled';
      }
      elseif($status == 'cancelled' || 'Not yet Comfirme'){$status = 'confirmed';}
      $entityManager = $this->getDoctrine()->getManager();
      $query = 'UPDATE Booking b SET b.Status = :statuss WHERE b.id = :id';
      $stmt = $entityManager->getConnection()->prepare($query);
      $stmt->execute(array('id'=>$id, 'statuss'=>$status));
      return $this->redirectToRoute('manageBookings');
   
    }

    /**
     * @return Response
     * @Route("/admin/managemembres", name="manageMembres")
     * 
     */

    public function ManageMembres(Request $request):Response
    {
      $entityManager = $this->getDoctrine()->getManager();
      $membres = $entityManager 
                      ->getRepository(Membres::class)->findAll();
                      
      return $this->render('admin/manageMembres.html.twig',
                    ['membres'=>$membres]);

     
    } 
    /**
     * @return Response
     * @Route("/deletemembres/{id}", name="deletemembres")
     * 
     */

    public function deleteMembres($id): Response
    { 
        $entityManager = $this->getDoctrine()->getManager();
        $membres = $entityManager->getRepository(Membres::class)->find($id);
        $entityManager->remove($membres);
        $entityManager->flush();
        return $this->redirectToRoute('manageMembres');
    }

     

}

