<?php

namespace App\Form;

use App\Entity\User;
use Webmozart\Assert\Assert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    $builder
        ->add('email', EmailType::class, [
            'help' => 'votre email',
            'row_attr' => ['class' => 'col-md-8'],
            'help_attr' => array(
                'class' => 'col-md-12 mb-2'
            ),
            'label' => false,
        ])

        ->add('password', RepeatedType::class, [
            'row_attr' => ['class' => 'col-md-8'],
            'type' => PasswordType::class,
            'invalid_message' => 'Les 2 mots de passe doivent être identiques.',
            'options' => ['attr' => ['class' => 'password-field']],
            'required' => true,

            'first_options'  => [
                'label' => false, 
                'help' => 'votre mot de passe', 
                'help_attr' => array(
                    'class' => 'col-md-12 mb-2'
                )
        ],

            'second_options' => [
                'label' => false, 
                'help' => 'retapez votre mot de passe', 
                'help_attr' => array(
                    'class' => 'col-md-12 mb-2'
                )
            ],
        ])

        ->add('firstName', null, array(
            'help' => 'Prénom',
            'row_attr' => ['class' => 'col-md-8'],
            'help_attr' => array(
                'class' => 'col-md-12 mb-2'
            ),
            'label' => false,

        ))
        ->add('lastName', null, array(
            'help' => 'Nom',
            'row_attr' => ['class' => 'col-md-8'],
            'help_attr' => array(
                'class' => 'col-md-12 mb-2'
            ),
            'label' => false,

        ))
        ->add('zipCode', IntegerType::class, array(
            'help' => 'Code Postal',
            'row_attr' => ['class' => 'col-md-8'], 
            'help_attr' => array(
                'class' => 'col-md-12 mb-2'
            ),
            'label' => false,
            'invalid_message' => 'Le code postal doit contenir 5 chiffres.',

        ))
        ->add('city', null, array(
            'help' => 'Ville',
            'row_attr' => ['class' => 'col-md-8'],
            'help_attr' => array(
                'class' => 'col-md-12 mb-2'
            ),
            'label' => false,
        ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
