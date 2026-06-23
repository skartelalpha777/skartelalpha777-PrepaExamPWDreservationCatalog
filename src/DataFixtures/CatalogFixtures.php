<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Catalog;
use App\Entity\Show;
use Cocur\Slugify\Slugify;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CatalogFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $data = [

            ['title' => 'Humour et One-Man Show', 'year' => 2026, 'validityDate' => '2026-12-28 15:00:00', 'showRef' => 'stomp'],
            ['title' => 'Spectacles de Rue', 'year' => 2025, 'validityDate' => '2026-10-28 20:00:00', 'showRef' => 'ayiti'],
            ['title' => 'Spectacles Jeune Public', 'year' => 2024, 'validityDate' => '2027-12-28 19:00:00', 'showRef' => 'cible-mouvante'],
            ['title' => '4. Spectacles de Magie et Illusion', 'year' => 2025, 'validityDate' => '2026-09-30 00:00:00', 'showRef' => 'stomp'],
            ['title' => 'Théâtre Classique', 'year' => 2024, 'validityDate' => '2027-10-30 0:00:00', 'showRef' => 'stomp'],
            ['title' => 'Humour', 'year' => 2026, 'validityDate' => '2025-01-17 23:00:00', 'showRef' => 'cible-mouvante'],
        ];
        $slugify = new Slugify();
        foreach ($data as $record) {
            $Catalog = new Catalog();
            $Catalog->setTitle($record['title']);
            $Catalog->setYear($record['year']);
            $Catalog->setValidityDate(new \DateTime($record['validityDate']));
            $Catalog->addShow($this->getReference($record['showRef'], Show::class));
            $manager->persist($Catalog);
            $this->addReference($slugify->slugify($record['title']), $Catalog);
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
