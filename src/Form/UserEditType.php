<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class UserEditType extends AbstractType
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
            'label' => 'Email',
        ])

        ->add('firstName', null, array(
            'help' => 'Prénom',
            'row_attr' => ['class' => 'col-md-8'],
            'help_attr' => array(
                'class' => 'col-md-12 mb-2'
            ),
            'label' => 'Prénom',

        ))
        ->add('lastName', null, array(
            'help' => 'Nom',
            'row_attr' => ['class' => 'col-md-8'],
            'help_attr' => array(
                'class' => 'col-md-12 mb-2'
            ),
            'label' => 'Nom',

        ))
        ->add('zipCode', null, array(
            'help' => 'Code Postal',
            'row_attr' => ['class' => 'col-md-8'], 
            'help_attr' => array(
                'class' => 'col-md-12 mb-2'
            ),
            'label' => 'Code Postal',

        ))
        ->add('city', null, array(
            'help' => 'Ville',
            'row_attr' => ['class' => 'col-md-8'],
            'help_attr' => array(
                'class' => 'col-md-12 mb-2'
            ),
            'label' => 'Ville',
        ))

        ->add('relanceDays', IntegerType::class, array(
            'help' => 'Notification relance après ... jours.',
            'row_attr' => ['class' => 'col-md-8'],
            'help_attr' => array(
                'class' => 'col-md-12 mb-2'
            ),
            'label' => 'Relance'
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
