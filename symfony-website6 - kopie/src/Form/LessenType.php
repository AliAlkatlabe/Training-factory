<?php

namespace App\Form;

use App\Entity\Lessen;
use App\Entity\Training;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class LessenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date',DateType::class)
            ->add('time', TimeType::class)
            ->add('location')
            ->add('max_persons', NumberType::class)
            // ->add('training')
            ->add('training', EntityType::class, [
                // looks for choices from this entity
                'class' => Training::class,
            ])
  
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lessen::class,
        ]);
    }
}
