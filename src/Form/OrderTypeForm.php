<?php

namespace App\Form;

use App\Entity\Order;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class OrderTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('clientName', TextType::class, [
                'label' => 'Client Name',
        ])
            ->add('email', EmailType::class, ['label' => 'Email'])
            ->add('size', ChoiceType::class, [
                'choices' => [
                    'Small' => 'S',
                    'Medium' => 'M',
                    'Large' => 'L',
                ],
                'label' => 'Pizza size',
            ])
            ->add('ingredients', ChoiceType::class, [
                'choices' => [
                    'Pepperoni' => 'pepperoni',
                    'Mushrooms' => 'mushrooms',
                    'Onions' => 'onions',
                    'Sausage' => 'sausage',
                    'Bacon' => 'bacon',
                    'Black olives' => 'black_olives',
                    'Green peppers' => 'green_peppers',
                    'Pineapple' => 'pineapple',
                ],
                'label' => 'Ingredients',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('comment', TextType::class, [
                'label' => 'Comment',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
