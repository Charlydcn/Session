<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
                'attr' => [
                    'int' => true,
                    'class' => 'form-control',
                ]
            ])

            ->add('dateDebut', DateType::class, [
                "widget" => "single_text",
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            ->add('dateFin', DateType::class, [
                "widget" => "single_text",
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            ->add('formation', EntityType::class, [
                'class' => Formation::class,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])

            ->add('Valider', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
