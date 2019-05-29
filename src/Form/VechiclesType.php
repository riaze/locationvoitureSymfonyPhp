<?php

namespace App\Form;

use App\Form\BrandsType;
use App\Entity\Vechicles;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class VechiclesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vechicleTitle');
        
        $builder->add('VechilcleOverview')  
            ->add('Brands', EntityType::class, [
                'class'=> 'App\Entity\Brands',
                
                'choice_label'=>'BrandName' 
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


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Vechicles::class,
            'cascade_validation' => true,
        ]);
    }
}
