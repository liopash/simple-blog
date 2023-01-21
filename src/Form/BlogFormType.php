<?php

namespace App\Form;

use App\Entity\Blog;
use App\Form\DataTransformer\EmailDataTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class BlogFormType extends AbstractType
{
    public function __construct(private EmailDataTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Title for your blog...',
                    'size' => 58,
                ],
            ])
            ->add('content', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Content of your blog...',
                    'rows' => 20,
                    'cols' => 50,
                ],
            ])
            ->add('author', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Your email...',
                    'size' => 58,
                ],
                'invalid_message' => 'Invalid email',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Create Blog',
            ])
        ;

        $builder->get('author')->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Blog::class,
        ]);
    }
}
