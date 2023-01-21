<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Entity\Comment;
use App\Form\BlogFormType;
use App\Form\CommentFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class BlogController extends AbstractController
{
    const BLOGS_PER_PAGE = 5;
    const COMMENTS_PER_PAGE = 7;

    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/blogs', name: 'app_blog')]
    #[Route('/', name: 'app_blog_index')]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $blogs = $this->em->getRepository(Blog::class)->findAll();

        $pagination = $paginator->paginate(
            $blogs,
            $request->query->getInt('page', 1),
            self::BLOGS_PER_PAGE
        );

        return $this->render('blog/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/blog/create', name: 'app_blog_create')]
    public function create(Request $request): Response
    {
        $blog = new Blog();
        // $blog->setAuthor(new Author());
        $form = $this->createForm(BlogFormType::class, $blog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blog = $form->getData();

            $this->em->persist($blog);
            $this->em->flush();

            return $this->redirectToRoute('app_blog');
        }

        return $this->render('blog/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/blog/{id}', name: 'app_blog_show')]
    public function show($id, Request $request, PaginatorInterface $paginator): Response
    {
        $blog = $this->em->getRepository(Blog::class)->find($id);

        $form = $this->handleCommentForm($request, $blog);

        if ($form['redirect']) {
            return $this->redirectToRoute('app_blog_show', ['id' => $id]);
        }

        $comments = $this->em->getRepository(Comment::class)->findBy(['blog' => $blog]);
        $pagination = $paginator->paginate(
            $comments,
            $request->query->getInt('page', 1),
            self::COMMENTS_PER_PAGE
        );

        return $this->render('blog/show.html.twig', [
            'blog' => $blog,
            'form' => $form['formView'],
            'comments' => $pagination,
        ]);
    }

    private function handleCommentForm(Request $request, Blog $blog): array
    {
        $comment = new Comment();
        $comment->setBlog($blog);
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();

            $this->em->persist($comment);
            $this->em->flush();

            return [
                'formView' => null,
                'redirect' => true,
            ];
        }

        return [
            'formView' => $form->createView(),
            'redirect' => false,
        ];
    }
}
