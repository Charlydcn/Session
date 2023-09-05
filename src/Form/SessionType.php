<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbPlaces', NumberType::class, [
                'label' => 'Nombre de places',
                'attr' => [
                    'int' => true,
                ]
            ])

            ->add('dateDebut', DateType::class, [
                'label' => 'Date de début',
                "widget" => "single_text",
            ])

            ->add('dateFin', DateType::class, [
                'label' => 'Date de fin',
                "widget" => "single_text",
            ])

            ->add('formation', EntityType::class, [
                'class'  => Formation::class,
                'constraints' => [
                    new Length([
                        'max' => '100',
                        'maxMessage' => 'Formation incorrecte.',
                    ])
                ]
            ])

            ->add('Valider', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
