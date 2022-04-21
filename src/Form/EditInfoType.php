<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class EditInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('name', TextType::class, [
                'label' => 'Votre nom',
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
            ])
            ->add('adresse', TextType::class, [
                'label' => ' Votre adresse',
                'required' => false
            ])

            ->add('telephone', textType::class, [
                'label' => 'Votre téléphone',
                'required' => false
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
