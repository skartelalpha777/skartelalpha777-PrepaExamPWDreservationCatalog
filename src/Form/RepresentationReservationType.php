<?php

namespace App\Form;

use App\Entity\Price;
use App\Entity\Representation;
use App\Entity\Reservation;
use App\Entity\RepresentationReservation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RepresentationReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantity')
            ->add('representation', EntityType::class, [
                'class' => Representation::class,
                'choice_label' => 'id',
            ])
            ->add('price', EntityType::class, [
                'class' => Price::class,
                'choice_label' => 'id',
            ])
            ->add('reservation', EntityType::class, [
                'class' => Reservation::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RepresentationReservation::class,
        ]);
    }
}
