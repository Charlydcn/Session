<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
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
                ]
            ])
            
            ->add('pseudo', TextType::class, [
                "label" => "Pseudo : ",
                "attr" => [
                    "placeholder" => "pseudoExemple",
                ]
            ])

            ->add('agreeTerms', CheckboxType::class, [
                "label" => "Accepter les CGU",
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                        ]
                    ),
                ],
            ])
            ->add('password', RepeatedType::class, [
                'mapped' => false,
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe de correspondent pas.',
                'options' => ['attr' => ['class' => 'password-field']],
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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
