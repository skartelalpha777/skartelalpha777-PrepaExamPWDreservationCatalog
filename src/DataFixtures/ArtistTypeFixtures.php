<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\ArtisType;
use App\Entity\Artist;
use App\Entity\Type;

class ArtistTypeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            [
                'artist_firstname' => 'Daniel',
                'artist_lastname' => 'Marcelin',
                'type' => 'auteur',
            ],
            [
                'artist_firstname' => 'Philippe',
                'artist_lastname' => 'Laurent',
                'type' => 'auteur',
            ],
            [
                'artist_firstname' => 'Daniel',
                'artist_lastname' => 'Marcelin',
                'type' => 'scénographe',
            ],
            [
                'artist_firstname' => 'Philippe',
                'artist_lastname' => 'Laurent',
                'type' => 'scénographe',
            ],
            [
                'artist_firstname' => 'Daniel',
                'artist_lastname' => 'Marcelin',
                'type' => 'comédien',
            ],
            [
                'artist_firstname' => 'Marius',
                'artist_lastname' => 'Von Mayenburg',
                'type' => 'auteur',
            ],
            [
                'artist_firstname' => 'Olivier',
                'artist_lastname' => 'Boudon',
                'type' => 'scénographe',
            ],
            [
                'artist_firstname' => 'Anne Marie',
                'artist_lastname' => 'Loop',
                'type' => 'comédien',
            ],
            [
                'artist_firstname' => 'Pietro',
                'artist_lastname' => 'Varasso',
                'type' => 'comédien',
            ],
            [
                'artist_firstname' => 'Laurent',
                'artist_lastname' => 'Caron',
                'type' => 'comédien',
            ],
            [
                'artist_firstname' => 'Élena',
                'artist_lastname' => 'Perez',
                'type' => 'comédien',
            ],
            [
                'artist_firstname' => 'Guillaume',
                'artist_lastname' => 'Alexandre',
                'type' => 'comédien',
            ],
            [
                'artist_firstname' => 'Claude',
                'artist_lastname' => 'Semal',
                'type' => 'auteur',
            ],
            [
                'artist_firstname' => 'Laurence',
                'artist_lastname' => 'Warin',
                'type' => 'scénographe',
            ],
            [
                'artist_firstname' => 'Claude',
                'artist_lastname' => 'Semal',
                'type' => 'comédien',
            ],
            [
                'artist_firstname' => 'Pierre',
                'artist_lastname' => 'Wayburn',
                'type' => 'auteur',
            ],
            [
                'artist_firstname' => 'Gwendoline',
                'artist_lastname' => 'Gauthier',
                'type' => 'auteur',
            ],
            [
                'artist_firstname' => 'Pierre',
                'artist_lastname' => 'Wayburn',
                'type' => 'comédien',
            ],
            [
                'artist_firstname' => 'Gwendoline',
                'artist_lastname' => 'Gauthier',
                'type' => 'comédien',
            ],
        ];

        foreach ($data as $record) {
            //Récupérer l'artiste (entité principale)
            $artist = $this->getReference(
                $record['artist_firstname'] . '-' . $record['artist_lastname'],
                Artist::class
            );

            //Récupérer le type (entité secondaire)
            $type = $this->getReference($record['type'], Type::class);

            //Définir l'entité principale
            $at = new ArtisType();
            $at->setArtist($artist);
            $at->setType($type);

            //Persister l'entité principale
            $manager->persist($at);

            // Ajouter une référence pour l'utiliser plus tard (ex: dans ArtisTypeShowFixtures)
            $this->addReference(
                $record['artist_firstname'] . '-' . $record['artist_lastname'] . '-' . $record['type'],
                $at
            );
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ArtistFixtures::class,
            TypeFixtures::class,
        ];
    }
}
