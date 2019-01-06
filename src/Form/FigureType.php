<?php

namespace App\Form;

use App\Entity\Figure;
use App\Form\MediaType;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class FigureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('category', EntityType::class, [
                  'class' => Category::class,
                  'choice_label'=>'title'
            ])
            ->add('content')
            ->add(
                'media',
                CollectionType::class,
                [
                    'entry_type' => MediaType::class,
                    'allow_add'  => true
                ]
            )
        ;    
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Figure::class,
        ]);
    }
}
