<?php

namespace App\Form;

use App\Entity\BienSearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BienSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('maxPrice', IntegerType::class,[
                'required' => false,
                'label' => false,
                'attr' =>  [
                    'placeholder' => 'budget Max'
                ]
            ])
            ->add('minSurface', IntegerType::class,[
                'required' => false,
                'label' => false,
                'attr' =>  [
                    'placeholder' => 'surface Min'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BienSearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }
}
