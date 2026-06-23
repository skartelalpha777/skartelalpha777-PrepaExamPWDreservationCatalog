<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Type;

class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            ['type'=>'auteur'],
            ['type'=>'scénographe'],
            ['type'=>'comédien'],
        ];
        
        foreach ($data as $record) {
            $type = new Type();
            $type->setType($record['type']);

            $manager->persist($type);

            $this->addReference($record['type'],$type);
        }

        $manager->flush();
    }
}
