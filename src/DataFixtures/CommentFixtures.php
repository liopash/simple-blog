<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $comment1 = new Comment();
        $comment1->setContent('This is a comment');
        $comment1->setBlog($this->getReference('blog1'));
        $comment1->setAuthor($this->getReference('author1'));
        $comment2 = new Comment();
        $comment2->setContent('This is another comment');
        $comment2->setBlog($this->getReference('blog2'));
        $comment2->setAuthor($this->getReference('author2'));
        $comment3 = new Comment();
        $comment3->setContent('This is yet another comment');
        $comment3->setBlog($this->getReference('blog2'));
        $comment3->setAuthor($this->getReference('author3'));

        $manager->persist($comment1);
        $manager->persist($comment2);
        $manager->persist($comment3);

        $manager->flush();
    }
}
