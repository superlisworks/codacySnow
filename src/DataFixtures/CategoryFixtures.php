<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Category;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 4; $i++){
            $category = new Category();
            $category->setName("Nom de la category n°$i")
            ->setComment("<p>Contenu sur la category n°$i</p>");
            
            $manager->persist($category);

        $manager->flush();
    }
}
}