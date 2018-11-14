<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Figure;

class FigureFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
          
                for($i = 1; $i <= 10; $i++){
                    $figure = new Figure();
                    $figure->setName("Nom de la figure n°$i")
                    ->setContent("<p>Documentation de la figure n°$i</p>")
                    ->setCreateDate(new \DateTime());
                    
                    $manager->persist($figure);
                }
                
                $manager->flush();
            }
        }
    

