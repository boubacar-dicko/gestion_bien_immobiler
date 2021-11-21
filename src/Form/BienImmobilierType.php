<?php

namespace App\Form;

use App\Entity\BienImmobilier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BienImmobilierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numeroBi')
            ->add('description')
            ->add('prix')
            ->add('nombrePieces')
            ->add('sold')
            ->add('nomBien')
            ->add('surface')
            ->add('nombreEtage')
            ->add('ville')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BienImmobilier::class,
        ]);
    }
}
