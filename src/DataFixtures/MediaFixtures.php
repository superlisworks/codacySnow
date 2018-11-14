<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Media;

class MediaFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++){
            $media = new Media();
            $media->setIdFigure("Media de la figure n°$i")
            ->setName("Nom du media n°$i")
            ->setType("Type de media n°$i");
            
            $manager->persist($media);
        $manager->flush();
    }
}
}