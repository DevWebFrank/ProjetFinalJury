<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'required' => false, // pour enlever le msg "Veuillez renseigner ce champ" du HTML5
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

            ->add('message', TextareaType::class, [
                'label' => 'Votre message',
                'required' => false,
                'attr' => ['rows' => 6],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champ ne peut être vide',
                    ]),
                ],
            ])

            /* ->add('subjectMessage', TextType::class, [
                'label' => 'Sujet',
                'attr' => [
                    'placeholder' => 'Sujet',
                ],
            ])
            ->add('contentMessage', TextareaType::class, [
                'label' => 'Message',
                'attr' => [
                    'placeholder' => 'Message',
                ],
            ]) */

            ->add('email', EmailType::class, [
                'label' => 'E-mail',
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

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}
