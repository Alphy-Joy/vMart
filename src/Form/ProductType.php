<?php

namespace App\Form;


use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Doctrine\ORM\EntityRepository;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('productName')
            ->add('productCode')
            ->add('productCategory', EntityType::class, [
                'class' => Category::class,
                'placeholder' => '---Select Category---',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')
                            ->where('s.status=true');
                },
            ])       
            // ->add('productCategory', EntityType::class, [
            //     'class' => Category::class,
    
            // ])     
            ->add('status', ChoiceType::class, [
                'choices'  => [
                    'Available' => 1,
                    'Not Available' => 0,
                ],
            ])
            ->add('productImage',FileType::class, array(
                'required' => false, 
                'data_class' => null
                ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
