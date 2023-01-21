<?php

namespace Tests\Unit\App\Entity;

use App\Entity\Author;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class AuthorTest extends TestCase
{
    public function testEmail()
    {
        $author = new Author();
        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        // test invalid email
        $author->setEmail("invalid email");
        $errors = $validator->validate($author);
        $this->assertEquals(1, $errors->count());


        // test valid email
        $author->setEmail("valid@email.com");
        $errors = $validator->validate($author);
        $this->assertEquals(0, $errors->count());

        // test blank email
        $author->setEmail("");
        $errors = $validator->validate($author);
        $this->assertEquals(1, $errors->count());
    }

    public function testAvatar()
    {
        $author = new Author();
        $author->setAvatar();
        $this->assertNotNull($author->getAvatar());
        $this->assertContains($author->getAvatar(), Author::AUTHOR_AVATARS);
    }

    public function testCreatedAt()
    {
        $author = new Author();
        $author->setCreatedAtValue();
        $this->assertNotNull($author->getCreatedAt());
    }
}
