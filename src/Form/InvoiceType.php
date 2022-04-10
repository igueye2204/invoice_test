<?php

namespace App\Form;

use App\Entity\Invoice;
use App\Form\InvoiceLinesType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'required' => true,
                'data' => new \DateTime("now"),
                'attr' => ['class' => 'js-datepicker form-control'],
            ])
            ->add('number', IntegerType::class, [
                'required'=> true,
                'label' => 'Number',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Number',
                ],
            ])
            ->add('customerId', IntegerType::class, [
                'required'=> true,
                'label' => 'Customer ID',
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Customer ID',
                ],
            ])
            ->add('invoiceLines', CollectionType::class, [
                'label' => false,
                'entry_type' => InvoiceLinesType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Invoice::class,
        ]);
    }
}
