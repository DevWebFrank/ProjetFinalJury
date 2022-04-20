<?php

namespace App\Form;

use App\Dictionary\Legals;
use App\Entity\LegalNotices;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class LegalNoticesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', ChoiceType::class, [
                'label' => 'Nom du document',
                'disabled' => true,
                'required' => false,
                'choices' => [
                    Legals::MENTIONS_LEGALES => Legals::MENTIONS_LEGALES,
                    Legals::PROTECTIONS_DES_DONNEES => Legals::PROTECTIONS_DES_DONNEES,
                    Legals::CONDITIONS_GENERALES_UTILISATION => Legals::CONDITIONS_GENERALES_UTILISATION,
                    Legals::CONDITIONS_GENERALES_DE_VENTE => Legals::CONDITIONS_GENERALES_DE_VENTE,
                    Legals::RETOUR_REMBOURSEMENT => Legals::RETOUR_REMBOURSEMENT,

                ]
            ])
            ->add('content', CKEditorType::class,[
                'label' => 'texte',
                'required' => false,
                'attr' => [
                    'placeholder' => 'ajpouter votre texte ici'
                ]
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LegalNotices::class,
        ]);
    }
}