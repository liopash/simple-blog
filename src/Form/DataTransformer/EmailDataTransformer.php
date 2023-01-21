<?php // src/Form/DataTransformer/authorToNumberTransformer.php
namespace App\Form\DataTransformer;

use App\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;


class EmailDataTransformer implements DataTransformerInterface
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    /**
     * Transforms an object (author) to a string (number).
     *
     * @param  Author|null $author
     */
    public function transform($author): string
    {
        if (null === $author) {
            return '';
        }

        return $author->getEmail();
    }

    /**
     * Transforms a string (email) to an object (author).
     *
     * @param  string $authorNumber
     * @throws TransformationFailedException if object (author) is not found.
     */
    public function reverseTransform($email): ?author
    {
        $author = $this->em->getRepository(Author::class)->findOneByEmail($email);

        if ($author instanceof Author) {
            return $author;
        }

        $author = new Author();
        $author->setEmail($email);

        // validate email
        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();
        $violations = $validator->validate($author);

        if (count($violations) > 0) {
            throw new TransformationFailedException('Invalid email');
        }

        $this->em->persist($author);
        $this->em->flush();

        return $author;
    }
}