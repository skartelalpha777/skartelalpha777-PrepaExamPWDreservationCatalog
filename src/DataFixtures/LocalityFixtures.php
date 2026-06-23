<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Locality;

class LocalityFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $data = [
            ['postal_code' => '1000', 'locality' => 'Bruxelles'],
            ['postal_code' => '1020', 'locality' => 'Laeken'],
            ['postal_code' => '1030', 'locality' => 'Schaerbeek'],
            ['postal_code' => '1050', 'locality' => 'Ixelles'],
            ['postal_code' => '1070', 'locality' => 'Anderlecht'],
            ['postal_code' => '1170', 'locality' => 'Watermael-Boitsfort'],
            ['postal_code' => '1180', 'locality' => 'Uccle'],
        ];
        foreach ($data as $loc) {
            $locality = new Locality();
            $locality->setPostalcode($loc['postal_code']);
            $locality->setLocality($loc['locality']);
            $manager->persist($locality);
            $this->addReference($loc['locality'], $locality);
        }




        $manager->flush();
    }
}
