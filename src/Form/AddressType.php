<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('street', TextType::class, [
            'label' => "Nom et n° de voie : ",
            'required' => true,
        ])
        ->add('city', TextType::class, [
            'label' => "Ville : ",
            'required' => true,
        ])
        ->add('zipCode', NumberType::class, [
            'label' => "Code Postal : ",
            'required' => true,
        ])
        ->add('supplement', TextareaType::class, [
            'label' => "Complément d'adresse : ",
            'required' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
