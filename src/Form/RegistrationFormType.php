<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Rollerworks\Component\PasswordStrength\Validator\Constraints\PasswordStrength;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Nom*'
                ]
            ])

            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Prénom*'
                ],
                'constraints' => [
                    new Length([
                        'min' => 4,
                        'minMessage' => 'Ce champ doit faire au minimum {{ limit }} caractères.'
                    ])
                ]
            ])

            ->add('birthDay', DateType::class, [
                'label' => 'Date de naissance',
                'required' => false,
                'years' => range(date('Y') - 75, date("Y", strtotime('-15 years'))),
                'placeholder' => '--- Choisir ---',


            ])

            ->add('adresse', TextType::class, [
                'label' => ' Votre adresse',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Votre adresse*'
                ]
            ])

            ->add('telephone', TextType::class, [
                'label' => 'Votre téléphone',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Téléphone*'
                ],
                'constraints' => [
                    new Length([
                        'max' => 15,
                        'maxMessage' => 'Ce champ doit faire au maximum {{ limit }} caractères.'
                    ])
                ]
            ])

            ->add('email', EmailType::class, [
                'label' => 'Adresse email',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Email*'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Il existe déjà un compte avec cet email (FormType)',
                    ]),
                ]
            ])

            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Accepter les CGU',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Veuillez accepter les CGU',
                    ]),
                ]
            ])

            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'options' => ['attr' => ['class' => 'password-field']],
                'mapped' => false,
                'label' => 'Mot de passe',
                'required' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => 'Mot de passe*'
                ],
                'constraints' => [
                    new PasswordStrength(
                        [
                            'minLength' => 8, // nombre de caractère minimum
                            'tooShortMessage' => 'Le mot de passe doit contenir au minimum 8 caractéres.',
                            'minStrength' => 4, // 4 = trong le niveau de robustesse du mot de passe (de 1 à 5)
                            'message' => 'Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial.',
                        ]
                    )
                ],

                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => [
                        'placeholder' => 'Mot de passe*'
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Vous devez renseigner un mot de passe',
                        ]),
                    ],
                ],

                'second_options' => [
                    'label' => 'Confirmer votre mot de passe',
                    'attr' => [
                        'placeholder' => 'Confirmer votre mot de passe*'
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Vous devez confirmer votre mot de passe',
                        ]),
                    ],
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
