<?php

namespace App\Controller;

use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/comments', name: 'app_comment')]
    public function index(): Response
    {
        $comments = $this->em->getRepository(Comment::class)->findAll();

        return $this->render('comment/index.html.twig', [
            'comments' => $comments,
        ]);
    }
}
