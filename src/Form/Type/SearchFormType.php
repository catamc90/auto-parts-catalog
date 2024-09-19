<?php

namespace App\Form\Type;

use App\Entity\Languages;
use App\Entity\Suppliers;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lngDescription', EntityType::class, [
                'label_attr' => ['class' => 'form-label'],
                'attr' => ['class' => 'form-control', 'placeholder' => 'lngDescription', 'autocomplete' => 'off'],
                'label' => 'Lang list',
                'required' => true,
                'class' => Languages::class,
                'choice_label' => 'lngDescription',
                'placeholder' => 'Please select one Lang',
            ])

            ->add('supplier', EntityType::class, [
                'label_attr' => ['class' => 'form-label'],
                'class' => Suppliers::class,
                'attr' => ['class' => 'form-control', 'placeholder' => 'Supplier', 'autocomplete' => 'off'],
            ])

            ->add('articleSearchNr', TextType::class, [
                'mapped' => false,
                'attr' => ['class' => 'form-control', 'placeholder' => 'Article search nr...C 2029', 'autocomplete' => 'off'],
            ])

            ->add('search', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary'],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'search_form_type';
    }
}
