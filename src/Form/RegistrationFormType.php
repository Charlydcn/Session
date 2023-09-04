<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                "label" => "E-Mail : ",
                "attr" => [
                    "placeholder" => "dupont.jeanne@exemple.fr",
                ],
            ])
            
            ->add('pseudo', TextType::class, [
                "label" => "Pseudo : ",
                "attr" => [
                    "placeholder" => "pseudoExemple",
                ],
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre pseudo ne peut pas être inférieur à 3 caractères',
                        'max' => 20,
                        'maxMessage' => 'Votre pseudo ne peut pas excéder 20 caractères',
                    ])
                ]
            ])

            ->add('agreeTerms', CheckboxType::class, [
                "label" => "Accepter les CGU",
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => "Merci d'accepter les règles générales d'utilisation",
                        ]
                    ),
                ],
            ])
            ->add('password', RepeatedType::class, [
                'mapped' => false,
                "help" => "8-25 caractères",
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe de correspondent pas.',
                'required' => true,
                'first_options'  => [
                    'label' => 'Mot de passe : ',
                    "attr" => [
                        "placeholder" => "••••••••",
                        ]
                    ],
                'second_options' => [
                    'label' => 'Confirmation mot de passe : ',
                    "attr" => [
                        "placeholder" => "••••••••",
                        ]
                    ],
                'constraints' => [
                    new Length([
                            'min' => 8,
                            'minMessage' => 'Votre mot de passe doit contenir au moins 8 caractères',
                            'max' => 15,
                            'maxMessage' => 'Votre mot de passe ne peut pas excéder 15 caractères',
                    ],
                    )
                ]
                ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
