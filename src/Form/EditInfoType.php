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

            ->add('telephone', textType::class, [
                'label' => 'Téléphone',
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
