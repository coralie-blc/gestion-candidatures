<?php

namespace App\Form;

use App\Entity\Candidature;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CandidatureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, [
                'help' => 'Date d\'envoi',
                'placeholder'=>'...',
                'widget' => 'choice',
                'years' => range(date('Y'), date('Y')-3),
                'label' => false,
                'widget' => 'single_text',
                'row_attr' => ['class' => 'form-group col-md-8'],
                'label_attr' => array(
                    'class' => 'col-md-12 mb-2'
                ),
                'help_attr' => array(
                    'class' => 'col-md-12 mb-2'
                )
                 ])

            ->add('poste', null , array(
                'help' => 'Nom du poste',
                'row_attr' => ['class' => 'form-group col-md-8'],
                'help_attr' => array(
                    'class' => 'col-md-12 mb-2'
                ),
                'attr'=> 
                    array(
                        'placeholder'=>'...',
                    ) ,
                    'label' => false,
                )
            )

            ->add('contactName', null , array(
                'help' => 'Nom du contact',
                'row_attr' => ['class' => 'form-group col-md-8'],
                'help_attr' => array(
                    'class' => 'col-md-12 mb-2'
                ),
                'attr'=> 
                    array(
                        'placeholder'=>'...',
                        ) ,
                    'label' => false,
                )
            )

            ->add('entreprise', null , array(
                'help' => 'Entreprise',
                'row_attr' => ['class' => 'form-group col-md-8'],
                'help_attr' => array(
                    'class' => 'col-md-12 mb-2'
                ),
                'attr'=> 
                    array(
                        'placeholder'=>'...',
                        ) ,
                    'label' => false,
                )
            )

            ->add('ville', null , array(
                'help' => 'Ville',
                'row_attr' => ['class' => 'form-group col-md-8'],
                'help_attr' => array(
                    'class' => 'col-md-12 mb-2'
                ),
                'attr'=> 
                    array(
                        'placeholder'=>'...',
                        ),
                    'label' => false,
                )
            )

            ->add('contact', TextareaType::class, [
                'help' => 'Contact - @ / 06',
                'required' => false, 
                'label' => false,
                'attr'=> 
                array(
                    'placeholder'=>'...',
                ),
                'row_attr' => ['class' => 'form-group col-md-8'],
                'help_attr' => array(
                    'class' => 'col-md-12 mb-2'
                ),
            ])

            ->add('notes', TextareaType::class, [
                'help' => 'Notes éventuelles',
                'required' => false, 
                'label' => false,
                'attr'=> 
                array(
                    'placeholder'=>'...',
                ),
                'row_attr' => ['class' => 'form-group col-md-8'],
                'help_attr' => array(
                    'class' => 'col-md-12 mb-2'
                ),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Candidature::class,
        ]);
    }
}
