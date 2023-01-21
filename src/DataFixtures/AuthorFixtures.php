<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $author1 = new Author();
        $author1->setEmail('joe.doe@example.com');
        $author2 = new Author();
        $author2->setEmail('jim.beam@gmail.com');
        $author3 = new Author();
        $author3->setEmail('kate.bush@yahoo.com');

        $manager->persist($author1);
        $manager->persist($author2);
        $manager->persist($author3);

        $manager->flush();

        $this->addReference('author1', $author1);
        $this->addReference('author2', $author2);
        $this->addReference('author3', $author3);
    }
}
