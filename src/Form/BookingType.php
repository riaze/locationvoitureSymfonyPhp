<?php

namespace App\Form;

use App\Entity\Booking;
use App\Entity\Membres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('FromDate', DateType::class)
        ->add('ToDate', DateType::class)
        ->add('Message', TextareaType::class, ['required' => false] )
        
         
        /*->add('membres', EntityType::class, [
                                             'class'=> 'App\Entity\Membres',  
                                             'choice_label'=>'id' 
                                                ]) 
        ->add('vechicles', EntityType::class, [
                                              'class'=> 'App\Entity\Vechicles',  
                                              'choice_label'=>'id' 
                                                       ])   
        ->add('brand', EntityType::class, [
                                               'class'=> 'App\Entity\Brands',  
                                               'choice_label'=>'id' 
                                                                 ])                                                                                   
        ->add('submit', SubmitType::class, ['label' => 'Book Now',
                                            'attr' => ['class' => 'btn btn-sm btn-success ml-5',],])    */   

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
