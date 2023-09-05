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
                ],
                'constraints' => [
                    new Length([
                        'max' => '20',
                        'maxMessage' => 'Nom incorrect. (20 caractères max)',
                    ])
                ]
            ])
            
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Jeanne'
                ],
                'constraints' => [
                    new Length([
                        'max' => '20',
                        'maxMessage' => 'Prénom incorrect. (20 caractères max)',
                    ])
                ]
            ])

            ->add('courriel', EmailType::class, [
                'attr' => [
                    'placeholder' => 'dupont.jeanne@exemple.fr'
                ],
                'constraints' => [
                    new Length([
                        'max' => '50',
                        'maxMessage' => 'E-Mail incorrect. (50 caractères max)',
                    ])
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
                ],
                'constraints' => [
                    new Length([
                        'max' => '30',
                        'maxMessage' => 'Ville incorrect. (30 caractères max)',
                    ])
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
                        'minMessage' => 'Numéro de téléphone incorrect (6 caractères minimum)',
                        'max' => 15,
                        'maxMessage' => 'Numéro de téléphone incorrect (15 caractères maximum)'
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
