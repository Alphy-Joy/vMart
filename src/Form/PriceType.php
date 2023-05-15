<?php

namespace App\Form;

use App\Entity\Price;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Quantity;

class PriceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('category', EntityType::class, [
            'class' => Category::class,
            'placeholder' => '---Select Category---',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('s')
                        ->where('s.status=true');
            },
        ])    
        ->add('product', EntityType::class, [
            'class' => Product::class,
            'placeholder' => '---Select Product---',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('s')
                        ->where('s.status=true');
            },
        ])   
        ->add('Quantity', EntityType::class, [
            'class' => Quantity::class,
            'placeholder' => '---Select Quantity---',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('s')
                        ->where('s.status=true');
            },
        ])     
        ->add('price')
        ->add('status', ChoiceType::class, [
            'choices'  => [
                'Available' => 1,
                'Not Available' => 0,
            ],
        ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Price::class,
        ]);
    }
}
