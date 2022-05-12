<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactSupportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'required' => false, // pour SUPPRIMER le msg HTML5 => "Veuillez renseigner ce champ"
                'attr' => [
                    'placeholder' => 'Nom',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut être vide',
                    ]),
                ],
            ])

            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Prénom',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut être vide',
                    ]),
                ],
            ])
            ->add('telephone', TelType::class, [
                'label' => 'Votre téléphone',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Téléphone'
                ],
                'constraints' => [
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Votre téléphone doit faire au minimum {{ limit }} chiffres.',
                        'max' => 15,
                        'maxMessage' => 'Votre téléphone doit faire au maximum {{ limit }} chiffres.'
                    ]),
                    new NotBlank([
                        'message' => 'Ce champ ne peut être vide',
                    ]),
                ]
            ])
            ->add('subjectMessage', TextType::class, [
                'label' => 'Sujet de ma demande :',
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut être vide',
                    ]),
                ],
            ])
            ->add('contentMessage', TextareaType::class, [
                'label' => 'Ma demande :',
                'required' => false,
                'attr' => [
                    'rows' => 4,
                    'placeholder' => 'Je trouve vos produits...',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut être vide',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail :',
                'attr' => [
                    'autocomplete' => 'email',
                    'placeholder' => 'Adresse e-mail',
                ],
                'required' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Rentrer votre e-mail',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
