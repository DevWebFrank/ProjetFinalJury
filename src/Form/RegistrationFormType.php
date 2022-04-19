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
                ]
            ])
            ->add('birthDay', DateType::class, [
                'label' => 'Date de naissance',
                'required' => false,
            ])

            ->add('adresse', TextType::class, [
                'label' => ' Votre adresse',
                'required' => false
            ])

            ->add('telephone', TextType::class, [
                'label' => 'Votre téléphone',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Téléphone*'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse email',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Email*'
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
                ],
            ])


            /* ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'label' => 'Mot de passe',
                'required' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => 'Mot de passe*'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Vous devez renseigner un TOTO mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Le mot de passe doit faire au moins {{ limit }} caracteres',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ]); */

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
                    new NotBlank([
                        'message' => 'Vous devez renseigner un MOTO mot de passe.',
                    ]),
                    // new Length([
                    //     'min' => 6,
                    //    'minMessage' => 'Le mot de passe doit faire au moins {{ limit }} caracteres',
                    // max length allowed by Symfony for security reasons
                    //   'max' => 4096,
                    //]),
                    new PasswordStrength(
                        [
                            'minLength' => 8, // nombre de caractère minimum
                            'tooShortMessage' => 'Le mot de passe doit contenir 8 caractéres.',
                            'minStrength' => 4, // 4=strong force du mot de passe (de 1 à 5)
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
