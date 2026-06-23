<?php

namespace App\Form;

use App\Entity\Review;
use App\Entity\Show;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('review')
            ->add('stars')
          //  ->add('validated')
            //  ->add('createdAt')
            //  ->add('updatedAt')
            /*  ->add('showReview', EntityType::class, [
                'class' => Show::class,
                'choice_label' => 'id',
            ])
            */
            /* ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
