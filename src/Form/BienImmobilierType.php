<?php

namespace App\Form;

use App\Entity\BienImmobilier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('nomBien', ChoiceType::class,[
                'choices'=> $this->getChoices()
            ])
            ->add('status', ChoiceType::class,[
                'choices'=> $this->getStatus()
            ])
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

    private function getChoices()
    {
        $choices = BienImmobilier::BIEN;
        $output=[];
        foreach ($choices as $k=> $v)
        {
            $output[$v] = $k;
        }

        return $output;
    }

    private function getStatus()
    {
        $choices = BienImmobilier::STATUS;
        $output=[];
        foreach ($choices as $k=> $v)
        {
            $output[$v] = $k;
        }

        return $output;
    }
}
