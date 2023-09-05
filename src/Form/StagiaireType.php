<?php

namespace App\Form;

use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class StagiaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'placeholder' => 'Dupont'
                ]
            ])
            
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Jeanne'
                ]
            ])

            ->add('courriel', EmailType::class, [
                'attr' => [
                    'placeholder' => 'dupont.jeanne@exemple.fr'
                ]
            ])

            ->add('dateNaissance', BirthdayType::class, [
                'label' => 'Date de naissance',
                'required' => false,
                "widget" => "single_text",
            ])

            ->add('ville', TextType::class, [
                'attr' => [
                    'placeholder' => 'Strasbourg, Colmar..'
                ]
            ])

            ->add('telephone', TelType::class, [
                'label' => 'Numéro de téléphone',
                'attr' => [
                    'maxlength' => 15,
                    'placeholder' => '0612345678'
                ],
                'constraints' => [
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Numéro de téléphone incorrect (trop court)',
                        'max' => 15,
                        'maxMessage' => 'Numéro de téléphone incorrect (trop long)'
                    ]),
                ],
            ])

            ->add('sexe', ChoiceType::class, [
                'choices'  => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                    'Autre' => 'Autre',
                ],
            ])

            ->add('Valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stagiaire::class,
        ]);
    }
}
