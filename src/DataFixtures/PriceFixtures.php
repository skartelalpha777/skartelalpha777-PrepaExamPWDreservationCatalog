<?php

namespace App\DataFixtures;

use App\Entity\Price;
use App\Entity\Show;
use App\Enum\TicketType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PriceFixtures extends Fixture  implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $prices = [
            [
                'type' => TicketType::Standard,
                'price' => '15.00',
                'start_date' => '2024-01-01 15:00:00',
                'end_date' => '2027-12-31 15:00:00',
                'ref' => 'Standart',
                'show_ref' => 'stomp'
            ],
            [
                'type' => TicketType::Enfant,
                'price' => '10.00',
                'start_date' => '2024-01-01 00:00:00',
                'end_date' => '2025-08-12 15:00:00',
                'ref' => 'Enfant',
                'show_ref' => 'ayiti'

            ],
            [
                'type' => TicketType::Senior,
                'price' => '8.00',
                'start_date' => '2024-01-01 00:00:00',
                'end_date' => '2026-10-31 15:00:00',
                'ref' => 'Senior',
                'show_ref' => 'cible-mouvante'

            ],
            [
                'type' => TicketType::Standard,
                'price' => '8.00',
                'start_date' => '2024-01-01 00:00:00',
                'end_date' => '2027-10-31 15:00:00',
                'ref' => 'Standart',
                'show_ref' => 'guarattelle-di-pulcinella'

            ],
        ];

        foreach ($prices as $record) {
            $price = new Price();
            $price->setType($record['type']);
            $price->setPrice($record['price']);
            $price->setStartDate(new \DateTime($record['start_date']));
            $price->setEndDate(new \DateTime($record['end_date']));
            $price->addShow($this->getReference($record['show_ref'], Show::class));

            $manager->persist($price);

            $this->addReference($record['ref'].'-'.$record['show_ref'], $price);
        }

        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            ShowFixtures::class
           
        ];
    }
}
