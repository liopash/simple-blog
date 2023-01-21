<?php

namespace Tests\Unit\App\Entity;

use App\Entity\Blog;
use App\Entity\Author;
use App\Entity\Comment;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class BlogTest extends TestCase
{
    public function testTitle()
    {
        $blog = new Blog();
        $blog->setTitle(" ");
        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();
        // 2 errors: blank title and too short title
        $errors = $validator->validate($blog);
        $this->assertEquals(2, $errors->count());

        $title = "Test Title";
        $blog->setTitle($title);
        $this->assertEquals($title, $blog->getTitle());
    }

    public function testContent()
    {
        $blog = new Blog();
        $blog->setContent("");
        $blog->setTitle("Test Title");
        $validator = Validation::createValidatorBuilder()
        ->enableAnnotationMapping()
        ->getValidator();
        // 2 errors: blank content and too short content
        $errors = $validator->validate($blog);
        $this->assertEquals(2, $errors->count());

        $content= "Test Content";
        $blog->setContent($content);
        $this->assertEquals($content, $blog->getContent());
    }

    public function testAuthor()
    {
        $blog = new Blog();
        $author = new Author();
        $author->setEmail("test@email.sk");
        $blog->setAuthor($author);
        $this->assertEquals($author, $blog->getAuthor());
    }

    public function testCreatedAt()
    {
        $blog = new Blog();
        $blog->setCreatedAtValue();
        $this->assertNotNull($blog->getCreatedAt());
    }

    public function testComments()
    {
        $blog = new Blog();
        $comment1 = new Comment();
        $comment1->setContent("Test Content");
        $comment2 = new Comment();
        $comment2->setContent("Test Content 2");
        $blog->addComment($comment1);
        $blog->addComment($comment2);
        $this->assertEquals(2, $blog->getComments()->count());
        $this->assertEquals($comment1, $blog->getComments()->first());
        $this->assertEquals($comment2, $blog->getComments()->last());
    }
}
