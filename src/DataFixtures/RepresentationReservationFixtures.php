<?php

namespace App\DataFixtures;

use App\Entity\RepresentationReservation;
use App\Entity\Price;
use App\Entity\Representation;
use App\Entity\Reservation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RepresentationReservationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            ['reservation_ref' => 'reservation-1', 'representation_ref' => 'ayiti-2026-05-28 15:00:00', 'quantity' => 2, 'price_ref' => 'Enfant-ayiti'],
            ['reservation_ref' => 'reservation-2', 'representation_ref' => 'stomp-2026-05-30 20:30:00', 'quantity' => 4, 'price_ref' => 'Standart-stomp'],
            ['reservation_ref' => 'reservation-3', 'representation_ref' => 'cible-mouvante-2026-05-30 20:30:00', 'quantity' => 1, 'price_ref' => 'Senior-cible-mouvante'],
            ['reservation_ref' => 'reservation-4', 'representation_ref' => 'guarattelle-di-pulcinella-2026-08-30 20:30:00', 'quantity' => 1, 'price_ref' => 'Standart-guarattelle-di-pulcinella'],
        ];

        foreach ($data as $record) {
            $repRes = new RepresentationReservation();

        
            $repRes->setReservation($this->getReference($record['reservation_ref'], Reservation::class));
            $repRes->setRepresentation($this->getReference($record['representation_ref'], Representation::class));
            $repRes->setQuantity($record['quantity']);
            
            $repRes->setPrice($this->getReference($record['price_ref'], Price::class));

            $manager->persist($repRes);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ReservationFixtures::class,
            RepresentationFixtures::class,
            PriceFixtures::class,
        ];
    }
}
