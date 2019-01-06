<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Figure;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use App\Entity\Media;

class FigureFixtures extends Fixture
{
    
    private $encoder;
    
    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
        
    }

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        
        //Management of Users
        $users = [];
        $genres = ['male', 'female'];
        
        for($i =1; $i <= 10; $i++) {
            $user = new User();
            
            $genre = $faker->randomElement($genres);
            
            $picturePath  = 'https://randomuser.me/api/portraits/';
            $picturePath .= ($genre == 'male' ? 'men/' : 'women/');
            $picturePath .= $faker->numberBetween(1, 99) . '.jpg';
            
            $password = $this->encoder->encodePassword($user, 'password');
          
            $user->setUserName($faker->username($genre))
                 ->setEmail($faker->email)
                 ->setPassword($password)
                 ->setPicturePath($picturePath)
                 ->setLastConnection($faker->dateTimeBetween('-6 months'))
                 ->setRole(1);
                 
                 $manager->persist($user);
                 array_push ($users, $user);
        }
        
        //Management of figures

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
                       ->setCoverImage($faker->imageUrl(1000,350))
                       ->setContent($content)
                       ->setCreateAt($faker->dateTimeBetween('-6 months'))
                       ->setCategory($category)
                       ->setAuthor($user);
                
                       for($l = 1; $l <= mt_rand(2, 5); $l++) {
                           $media = new Media();
                           
                           $media->setTitle($faker->imageUrl())
                                 ->setType(1)
                                 ->setFigure($figure);
                                 
                           $manager->persist($media);    
                       }
                
                       $user = $users[mt_rand(0, count($users) -1)];

                $manager->persist($figure);

                // We give comments to a figure
                for ($k = 1; $k <= mt_rand(4, 10); $k ++) {
                    $comment = new Comment();

                    
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
