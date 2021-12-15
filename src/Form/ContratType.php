<?php

namespace App\Form;

use App\Entity\BienImmobilier;
use App\Entity\Client;
use App\Entity\Contrat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContratType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numeroContrat')
            ->add('dateContrat')
            ->add('transaction', ChoiceType::class,[
                'choices' => $this->getChoices(),
            ])
            ->add('bienImmobilier', EntityType::class,[
                'class'=> BienImmobilier::class,
                'choice_label'=> function($bien){
                return 'Le Bien : '.$bien->getNomBien().' de Numero : '.$bien->getNumeroBi();
                }

            ])
            ->add('client', EntityType::class,[
                'class'=> Client::class,
                'choice_label' => function($client){
                return 'Le Client: '.$client->getNom().' de CNI: '.$client->getCni();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contrat::class,
        ]);
    }
    private function getChoices()
    {
        $choices = Contrat::TRANSACTION;
        $output=[];
        foreach ($choices as $k=> $v)
        {
            $output[$v] = $k;
        }

        return $output;
    }

}
