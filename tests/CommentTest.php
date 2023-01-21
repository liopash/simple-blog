<?php

namespace App\Tests\Entity;

use App\Entity\Comment;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Validation;

class CommentTest extends TestCase
{
    public function testContent()
    {
        $comment = new Comment();
        $comment->setContent("");
        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();
        // 2 errors: blank content and too short content
        $errors = $validator->validate($comment);
        $this->assertEquals(2, $errors->count());

        $content= "Test Content";
        $comment->setContent($content);
        $this->assertEquals($content, $comment->getContent());
    }
}
