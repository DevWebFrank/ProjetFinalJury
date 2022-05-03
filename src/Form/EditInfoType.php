<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class EditInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('name', TextType::class, [
                'label' => 'Nom',
                'required' => false
            ])

            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Prénom*'
                ],

            ])
            ->add('birthDay', DateType::class, [
                'label' => 'Date de naissance',
                'required' => false,
                'years' => range(date('Y') - 75, date("Y", strtotime('-15 years'))),
                'placeholder' => '--- Choisir ---',
            ])
            ->add('adresse', TextType::class, [
                'label' => ' Adresse',
                'required' => false
            ])

            ->add('telephone', TextType::class, [
                'label' => 'Téléphone',
                'required' => false,
                'constraints' => [
                    new Length([
                        'min' => 10,
                        'minMessage' => '{{ label }} doit faire au minimum {{ limit }} chiffres.',
                        'max' => 15,
                        'maxMessage' => '{{ label }} doit faire au maximum {{ limit }} chiffres.'
                    ])
                ]
            ])

            ->add('email', EmailType::class, [
                'label' => 'Adresss email',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
