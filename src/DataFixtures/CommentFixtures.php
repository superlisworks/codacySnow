<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Comment;

class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i <= 10; $i++){
            $comment = new Comment();
            $comment->setIdFigure("commentaire de la figure n°$i")
            ->setIdUser("commentaire de l'utilisateur n°$i")
            ->setPseudo("Pseudo de l'utilisateur n°$i")
            ->setcomment("contenu du commentaire n°$i")
            ->setCreationDate(new \DateTime());
            
            $manager->persist($comment);

        $manager->flush();
    }
}
}