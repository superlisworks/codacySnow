<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++){
            $user = new User();
            $user->setFirstName("Nom l'utilisateur n°$i")
            ->setLasName("Prenom l'utilisateur n°$i")
            ->setPseudo("Pseudo de l'utilisateur n°$i")
            ->setEmail("Email de l'utilisateur n°$i")
            ->setPicturePath("Photo de l'utilisateur n°$i")
            ->setLogin("Login de l'utilisateur")
            ->setPassword("Mot de passe de l'utilisateur n°$i")
            ->setRole("Role de l'utilisateur n°$i")
            ->setLastConnection(new \DateTime());
            
            $manager->persist($user);
        $manager->flush();
    }
}
}