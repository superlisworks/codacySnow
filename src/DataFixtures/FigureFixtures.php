<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Figure;
use App\Entity\Group;


class FigureFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setName("grabs")->setComment("les meilleurs Grabs");
        
        $manager->persist($category);
        
        for($i = 1; $i<= 10; $i++){
          $figure = new Figure();  
          $figure->setName("Nom de la figure n°$i")
                 ->setContent("<p>Contenu de la figure n°$i</p>")
                 ->setCreateDate(new \DateTime())
                 ->setImage("http://placehold.it/350x150")
                 ->setGroup($category);
          
          $manager->persist($figure);
        }
        $manager->flush();
    }
}
