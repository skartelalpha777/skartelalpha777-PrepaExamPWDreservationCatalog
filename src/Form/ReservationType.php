<?php

namespace App\Form;

use App\Entity\Price;
use App\Entity\Representation;
use App\Entity\RepresentationReservation;
use App\Entity\Reservation;
use Doctrine\Common\Collections\Expr\Value;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('booking_date')
            // ->add('status')

            /* ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ]) */
            ->add('representations', EntityType::class, [
                'class' => Representation::class,
                'label' => ' ',
                'choices' => $options['representations'],
                'choice_label' => function (Representation $representation) {

                    $titre = $representation->getRepresentationShow() ? $representation->getRepresentationShow()->getTitle() : 'Aucune répresenation';

                    $showTime = $representation->getSchedule() ? $representation->getSchedule()->format('d/m/Y à H:i') : ' ';
                    return $titre . ' - Date : ' . $showTime;
                },
                'multiple' => true,
                'mapped' => false,
                'expanded' => false,

            ])
            ->add('price', EntityType::class, [
                'class' => Price::class,
                'label' => 'Prix',
                'choices' => $options['prices'],
                'choice_label' => function (Price $prix) {

                    $type = $prix->getType() ? $prix->getType()->value : 'Type indefini';
                    $prixValue = $prix->getPrice() ? $prix->getPrice() : 'Prix indefini';

                    return 'Type: ' . $type . '  Prix : ' . $prixValue . ' €';
                },
                'multiple' => true,
                'mapped' => false,
                'expanded' => false,

            ])
            ->add('quantity', IntegerType::class, [

                'mapped' => false,
            ])
            /* ->add('representation', EntityType::class, [
                'class' => Representation::class,
                'choice_label' => function (Representation $representation) {
                    $titre = $representation->getRepresentationShow()->getTitle();
                    $date = $representation->getSchedule() ? $representation->getSchedule()->format('d/m/Y à H:i') : '';
                    return $titre . ' - ' . $date;
                },
            ]) */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
            'representations' => [], // On déclare notre nouvelle option vide par défaut
            'prices' => [], // Nouvelle option pour restreindre les prix au spectacle
        ]);
    }
}
