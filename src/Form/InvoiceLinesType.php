<?php

namespace App\Form;

use App\Entity\InvoiceLines;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class InvoiceLinesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description', TextType::class, [
                'required'=> true,
                'label' => 'Description',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Description',
                ],
            ])
            ->add('quantity', IntegerType::class, [
                'required'=> true,
                'label' => 'Quantity',
                'attr' => [
                    'class' => 'form-control quantity',
                    'placeholder' => 'Quantity',
                ],
            ])
            ->add('amount', NumberType::class, [
                'required'=> true,
                'label' => 'Amount',
                'attr' => [
                    'class' => 'form-control amount',
                    'placeholder' => 'Amount',
                ],
            ])
            ->add('vatAmount', NumberType::class, [
                'required'=> true,
                'label' => 'VAT amount',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'VAT amount',
                    'disabled' => true
                ],
            ])
            ->add('total', NumberType::class, [
                'required'=> true,
                'label' => 'Total with VAT ',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Total with VAT ',
                    'disabled' => true
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => InvoiceLines::class,
        ]);
    }
}
