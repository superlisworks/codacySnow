<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Figure;
use App\Entity\Category;
use App\Entity\Comment;

class FigureFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        // creation of 3 categories Faker

        for ($i = 1; $i <= 3; $i ++) {
            $category = new Category();
            $category->setTitle($faker->sentence())
                ->setDescription($faker->paragraph());

            $manager->persist($category);

            // creation of 4 or 6 figures Faker

            for ($j = 1; $j <= mt_rand(4, 6); $j ++) {
                $figure = new Figure();

                $content =  join($faker->paragraphs(5), '<br/>');

                $figure->setName($faker->sentence())
                    ->setContent($content)
                    ->setCreateAt($faker->dateTimeBetween('-6 months'))
                    ->setCategory($category);

                $manager->persist($figure);

                // We give comments to a figure
                for ($k = 1; $k <= mt_rand(4, 10); $k ++) {
                    $comment = new Comment();

                    //$content = '<p>' . join($faker->paragraphs(2), '</p><p>') . '</p>';
                    $content =  join($faker->paragraphs(2), '<br/>');

                    $days = (new \DateTime())->diff($figure->getCreateAt())->days;

                    $comment->setAuthor($faker->name)
                        ->setContent($content)
                        ->setCreateAt($faker->dateTimeBetween('-' . $days . 'days'))
                        ->setFigure($figure);

                    $manager->persist($comment);
                }
            }
        }

        $manager->flush();
    }
}
