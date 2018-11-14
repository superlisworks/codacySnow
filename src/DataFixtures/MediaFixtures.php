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
            $media->setIdFigure($i)
            ->setName("Nom du media n°$i")
            ->setType(rand (0 , 1));
            
            $manager->persist($media);
        $manager->flush();
    }
}
}