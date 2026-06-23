<?php

namespace App\Form;

use App\Entity\Price;
use App\Entity\Show;
use Dom\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PriceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type')
            ->add('price')
            ->add('shows', EntityType::class, [
                'class' => Show::class,
                'label' => 'Pour quel spectacle',
                'choice_label' => 'title',
                'multiple' => true,
                'expanded' => false

            ])
            //  ->add('start_date')
            ->add('end_date')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Price::class,
        ]);
    }
}
