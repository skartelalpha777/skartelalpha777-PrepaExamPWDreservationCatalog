<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Representation;
use App\Entity\Show;
use App\Entity\Location;



class RepresentationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            ['show' => 'ayiti', 'schedule' => '2026-05-28 15:00:00', 'location-slug' => 'espace-magh'],
            ['show' => 'ayiti', 'schedule' => '2026-05-28 20:30:00', 'location-slug' => 'la-samaritaine'],
            ['show' => 'stomp', 'schedule' => '2026-05-30 20:30:00', 'location-slug' => 'dexia-art-center'],
            ['show' => 'cible-mouvante', 'schedule' => '2026-05-30 20:30:00', 'location-slug' => 'la-samaritaine'],
            ['show' => 'guarattelle-di-pulcinella', 'schedule' => '2026-08-30 20:30:00', 'location-slug' => 'dexia-art-center'],
            ['show' => 'guarattelle-di-pulcinella', 'schedule' => '2026-05-30 20:30:00', 'location-slug' => 'dexia-art-center'],
        ];

        foreach ($data as $record) {
            $representation = new Representation();
            $representation->setRepresentationShow($this->getReference($record['show'], Show::class));
            $representation->setSchedule(new \DateTime($record['schedule']));
            $representation->setLocation($this->getReference($record['location-slug'],Location::class));


            $manager->persist($representation);

            $this->addReference($record['show'] . "-" . $record['schedule'], $representation);
        }

        $manager->flush();
    }

     public function getDependencies(): array
    {
        return [
            LocationFixtures::class,
            ShowFixtures::class
        ];
    }
}
