<?php

namespace App\DataFixtures;

use App\Entity\Show;
use App\Entity\Location;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Cocur\Slugify\Slugify;

class ShowFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $data = [
            [
                'slug' => null,
                'title' => 'Stomp',
                'description' => 'Un mélange d’explosions sonores, de rythme et de mouvement',
                'poster_url' => 'https://media.out.be/media/x900/q80/p51x57/lib/data/tbl_items/2024/9/162433/visuals/1726474936959.stomp.JPG',
                'duration' => 90,
                'location_slug' => 'dexia-art-center',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'Guarattelle di Pulcinella',
                'description' => '« Guarattella » est un ancien mot napolitain qui signifie « une situation initialement très simple qui évolue vers une situation très confuse »',
                'poster_url' => 'https://media.out.be/media/x900/q80/p50x20/lib/data/tbl_items/2026/4/207860/visuals/1776188987104.credit-ph_Virgilio-Ardy.jpg',
                'duration' => 120,
                'location_slug' => 'dexia-art-center',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'Ayiti',
                'description' => "Un homme est bloqué à l'aéroport.\n "
                    . 'Questionné par les douaniers, il doit alors justifier son identité, '
                    . 'et surtout prouver qu\'il est haïtien - qu\'est-ce qu\'être haïtien ?',
                'poster_url' => 'https://www.librairie-theatrale.com/cdn/shop/files/p6gw0fhyJheV-u5Kg2RzwBOCiYgQI-FpOfsYzXEwFzclyFdXG7L4QA-cover-large.jpg?v=1759909024',
                'duration' => 140,
                'location_slug' => 'espace-delvaux-la-venerie',
                'bookable' => true,

            ],
            [
                'slug' => null,
                'title' => 'Cible mouvante',
                'description' => "Dans ce « thriller d'anticipation », des adultes semblent alimenter "
                    . "et véhiculer une crainte féroce envers les enfants âgés entre 10 et 12 ans.",
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BZDg3ZjY2OGQtOGY4NC00MGM0LTgyMzktNWIxZmZjMmNmNDZmXkEyXkFqcGc@._V1_QL75_UY281_CR5,0,190,281_.jpg',
                'location_slug' => 'la-samaritaine',
                'duration' => 90,
                'bookable' => true,

            ],
            [
                'slug' => null,
                'title' => 'Ceci n\'est pas un chanteur belge',
                'description' => "Non peut-être ?!\nEntre Magritte (pour le surréalisme comique) "
                    . 'et Maigret (pour le réalisme mélancolique), ce dixième opus semalien propose '
                    . 'quatorze nouvelles chansons mêlées à de petits textes humoristiques et '
                    . 'à quelques fortes images poétiques.',
                'poster_url' => 'https://www.retouralarchipel.net/claudesemal/Icono/Spectacles/Ceci/2012Ceciaffiche.jpg',
                'location_slug' => 'espace-delvaux-la-venerie',
                'duration' => 60,
                'bookable' => false,

            ],
            [
                'slug' => null,
                'title' => 'Manneke… !',
                'description' => 'A tour de rôle, Pierre se joue de ses oncles, '
                    . 'tantes, grands-parents et surtout de sa mère.',
                'poster_url' => 'https://www.spectable.be/image/image/K/souper-spectacle-avec-les-manneken-peas_403170.jpg',
                'location_slug' => 'la-samaritaine',
                'duration' => 100,
                'bookable' => true,

            ],
            [
                'slug' => null,
                'title' => 'Roméo et Juliette',
                'description' => 'Une adaptation moderne du classique de Shakespeare.',
                'poster_url' => 'https://images.7sur7.be/ZGlvLzI2OTg2MzI1OC9maXQtd2lkdGgvNjI4/romeo-et-juliette-revient-sur-scene-en-2027',
                'duration' => 120,
                'location_slug' => 'espace-delvaux-la-venerie',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'Le Bourgeois Gentilhomme',
                'description' => 'Une comédie-ballet de Molière revisitée.',
                'poster_url' => 'https://pivotmedia.tourismewallonie.be/OTH-A0-0124-0KEZ/OTH-A0-0124-0KEZ.jpg',
                'duration' => 110,
                'location_slug' => 'la-samaritaine',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'Jazz Night Brussels',
                'description' => 'Une soirée dédiée aux grands standards du jazz.',
                'poster_url' => 'https://media.out.be/media/x900/q80/p50x20/lib/data/tbl_items/2026/4/207235/visuals/1775637484030.image.png',
                'duration' => 90,
                'location_slug' => 'dexia-art-center',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'Le Songe d’une Nuit d’Été',
                'description' => 'Une plongée féérique dans l’univers de Shakespeare.',
                'poster_url' => 'https://www.ccverviers.be/wp-content/uploads/24_Aff_Le-songe-dune-nuit-dete.jpg',
                'duration' => 125,
                'location_slug' => 'espace-delvaux-la-venerie',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'Impro Battle XXL',
                'description' => 'Deux équipes s’affrontent dans une compétition d’improvisation.',
                'poster_url' => 'https://www.mondial-impro.com/wp-content/uploads/2025/10/20251024_BelgiqueVSSuisse-13-scaled.jpg',
                'duration' => 100,
                'location_slug' => 'la-samaritaine',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'Les Misérables',
                'description' => 'Une adaptation scénique du roman de Victor Hugo.',
                'poster_url' => 'https://picsum.photos/400/600?random=6',
                'duration' => 150,
                'location_slug' => 'dexia-art-center',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'Cyrano',
                'description' => 'Une relecture contemporaine de Cyrano de Bergerac.',
                'poster_url' => 'https://picsum.photos/400/600?random=7',
                'duration' => 130,
                'location_slug' => 'espace-delvaux-la-venerie',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'Stand-Up Bruxelles',
                'description' => 'Les meilleurs humoristes belges sur scène.',
                'poster_url' => 'https://picsum.photos/400/600?random=8',
                'duration' => 80,
                'location_slug' => 'la-samaritaine',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'La Tempête',
                'description' => 'Une œuvre magique et poétique de Shakespeare.',
                'poster_url' => 'https://picsum.photos/400/600?random=9',
                'duration' => 115,
                'location_slug' => 'dexia-art-center',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'Brussels Dance Project',
                'description' => 'Un spectacle mêlant danse contemporaine et vidéo.',
                'poster_url' => 'https://picsum.photos/400/600?random=10',
                'duration' => 95,
                'location_slug' => 'espace-delvaux-la-venerie',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'L’Avare',
                'description' => 'La célèbre comédie de Molière.',
                'poster_url' => 'https://picsum.photos/400/600?random=11',
                'duration' => 105,
                'location_slug' => 'la-samaritaine',
                'bookable' => false,
            ],
            [
                'slug' => null,
                'title' => 'Cabaret Noir',
                'description' => 'Une soirée musicale inspirée des cabarets berlinois.',
                'poster_url' => 'https://picsum.photos/400/600?random=12',
                'duration' => 90,
                'location_slug' => 'dexia-art-center',
                'bookable' => true,
            ],
            [

                'slug' => null,
                'title' => 'Macbeth',
                'description' => 'Une tragédie sur le pouvoir et l’ambition.',
                'poster_url' => 'https://picsum.photos/400/600?random=13',
                'duration' => 140,
                'location_slug' => 'espace-delvaux-la-venerie',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'Le Petit Prince',
                'description' => 'Un spectacle familial inspiré du roman de Saint-Exupéry.',
                'poster_url' => 'https://picsum.photos/400/600?random=14',
                'duration' => 75,
                'location_slug' => 'la-samaritaine',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'Brussels Gospel Choir',
                'description' => 'Concert exceptionnel du célèbre chœur bruxellois.',
                'poster_url' => 'https://picsum.photos/400/600?random=15',
                'duration' => 100,
                'location_slug' => 'dexia-art-center',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'Le Malade Imaginaire',
                'description' => 'Une satire toujours aussi actuelle.',
                'poster_url' => 'https://picsum.photos/400/600?random=16',
                'duration' => 100,
                'location_slug' => 'espace-delvaux-la-venerie',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'Nuit Flamenco',
                'description' => 'Danse et musique andalouses.',
                'poster_url' => 'https://picsum.photos/400/600?random=17',
                'duration' => 95,
                'location_slug' => 'la-samaritaine',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'Hamlet',
                'description' => 'Une tragédie intemporelle.',
                'poster_url' => 'https://picsum.photos/400/600?random=18',
                'duration' => 145,
                'location_slug' => 'dexia-art-center',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'Cirque Urbain',
                'description' => 'Acrobaties et arts de rue.',
                'poster_url' => 'https://picsum.photos/400/600?random=19',
                'duration' => 85,
                'location_slug' => 'espace-delvaux-la-venerie',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'Voix du Monde',
                'description' => 'Voyage musical à travers les cultures.',
                'poster_url' => 'https://picsum.photos/400/600?random=20',
                'duration' => 90,
                'location_slug' => 'la-samaritaine',
                'bookable' => true,
            ],
        ];


        foreach ($data as $record) {
            $slugify = new Slugify();

            $show = new Show();
            $show->setSlug($slugify->slugify($record['title']));
            $show->setTitle($record['title']);
            $show->setDescription($record['description']);
            $show->setPosterUrl($record['poster_url']);
            $show->setDuration($record['duration']);
            $show->setBookable($record['bookable']);

            if ($record['location_slug']) {
                $show->setLocation($this->getReference($record['location_slug'], Location::class));
            }

            $manager->persist($show);

            $this->addReference($show->getSlug(), $show);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            LocationFixtures::class,
        ];
    }
}
