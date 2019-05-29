<?php

namespace App\Form;

use App\Entity\Membres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MembresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom') 
            ->add('Prenom')
            ->add('Email')
            ->add('Password', PasswordType::class)
            ->add('Confirme_Password', PasswordType::class)
            ->add('Adresse')
            ->add('Ville')
            ->add('CodePostal')
            ->add('Pays')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Membres::class,
        ]);
    }
}
