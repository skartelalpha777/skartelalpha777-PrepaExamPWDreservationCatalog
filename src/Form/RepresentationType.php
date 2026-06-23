<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Representation;
use App\Entity\Show;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RepresentationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('schedule')
            ->add('price')
            ->add('representationShow', EntityType::class, [
                'class' => Show::class,
                'choice_label' => 'title',
            ])
    
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Representation::class,
        ]);
    }
}
