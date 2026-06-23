<?php

namespace App\DataFixtures;

use App\Entity\Reservation;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ReservationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            ['user_ref' => 'Bob', 'booking_date' => '2026-05-01 10:00:00', 'ref' => 'reservation-1'],
            ['user_ref' => 'Frederic', 'booking_date' => '2026-05-02 11:30:00', 'ref' => 'reservation-2'],
            ['user_ref' => 'Daniel', 'booking_date' => '2026-05-03 14:00:00', 'ref' => 'reservation-3'],
               ['user_ref' => 'Frederic', 'booking_date' => '2026-07-02 19:30:00', 'ref' => 'reservation-4'],
        ];

        foreach ($data as $record) {
            $reservation = new Reservation();
            
            $reservation->setBookingDate(new \DateTime($record['booking_date']));
            $reservation->setUser($this->getReference($record['user_ref'], User::class));

            $manager->persist($reservation);

            $this->addReference($record['ref'], $reservation);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}