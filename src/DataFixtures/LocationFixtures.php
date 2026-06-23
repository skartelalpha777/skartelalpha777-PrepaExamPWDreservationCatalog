<?php

namespace App\DataFixtures;

use Cocur\Slugify\Slugify;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Location;
use App\Entity\Locality;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LocationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $locations = [
            [
                'slug' => null,
                'designation' => 'Espace Delvaux / La Vénerie',
                'address' => '3 rue Gratès',
                'locality' => 'Watermael-Boitsfort',
                'website' => 'https://www.lavenerie.be',
                'phone' => '+32 (0)2/663.85.50',
            ],
            [
                'slug' => null,
                'designation' => 'Dexia Art Center',
                'address' => '50 rue de l\'Ecuyer',
                'locality' => 'Bruxelles',
                'website' => null,
                'phone' => null,
            ],
            [
                'slug' => null,
                'designation' => 'La Samaritaine',
                'address' => '16 rue de la samaritaine',
                'locality' => 'Bruxelles',
                'website' => 'http://www.lasamaritaine.be/',
                'phone' => null,
            ],
            [
                'slug' => null,
                'designation' => 'Espace Magh',
                'address' => '17 rue du Poinçon',
                'locality' => 'Bruxelles',
                'website' => 'http://www.espacemagh.be',
                'phone' => '+32 (0)2/274.05.10',
            ],
        ];
        $slug = new Slugify();
        foreach ($locations as $location) {

            $loc = new Location();
            $loc->setSlug($slug->slugify($location['designation']));
            $loc->setDesignation($location['designation']);
            $loc->setAddress($location['address']);
            $loc->setLocality($this->getReference($location['locality'], Locality::class));
            $loc->setWebsite($location['website']);
            $loc->setPhone($location['phone']);
            $manager->persist($loc);
            $this->addReference($loc->getSlug(), $loc);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            LocalityFixtures::class,
        ];
    }
}
