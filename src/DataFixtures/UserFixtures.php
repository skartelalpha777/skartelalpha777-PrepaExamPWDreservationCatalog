<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Enum\Roles;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    // 2. Injecter le service de hachage
    public function __construct(private UserPasswordHasherInterface $passwordHasher) {}
    public function load(ObjectManager $manager): void
    {

        $data = [

            ['firstname' => 'Daniel', 'lastname' => 'Marcelin', 'email' => 'aa@gmail.com', 'password' => 'aaaa'],
            ['firstname' => 'Bob', 'lastname' => 'Lebon', 'email' => 'bb@gmail.com', 'password' => 'aaaa'],
            ['firstname' => 'Frederic', 'lastname' => 'Sull', 'email' => 'cc@gmail.com', 'password' => 'aaaa'],



        ];

        foreach ($data as $person) {


            $user = new User();
            $user->setFirstname($person['firstname']);
            $user->setLastname($person['lastname']);
            $user->setEmail($person['email']);
            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $person['password']
            );
            $user->setPassword($hashedPassword);
            if ($person['firstname'] == 'Daniel') {
                $user->setRole(Roles::Administrateur);
            }

            // $product = new Product();
            $manager->persist($user);

            $this->addReference($person['firstname'], $user);
        }
        $manager->flush();
    }
}
