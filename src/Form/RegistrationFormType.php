<?php

namespace App\Form;

use App\Entity\User;
use App\Form\AddressType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => "Email : ",
                'required' => true,
            ])
            ->add('password', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'required' => true,
                'first_options' => [
                'label' => "Mot de passe : ",
                 ],
                'second_options' => [
                'label' => "Répéter le mot de passe : ",
                'mapped' => false,
                ],
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => "Veuillez entrer un mot de passe",
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => "Votre mot de passe doit être d'au moins {{ limit }} caractères",
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('firstName', TextType::class, [
                'label' => "Prénom : ",
                'required' => true,
            ])
            ->add('lastName', TextType::class, [
                'label' => "Nom : ",
                'required' => true,
            ])
            ->add('phone', TelType::class, [
                'label' => "Téléphone : ",
                'required' => false,
            ])
            ->add('address', AddressType::class, [
                'label' => "Adresse : ", 
                'required' => true
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => "J'accepte les conditions. ",
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez acceptez les conditions.',
                    ]),
                ],
            ])
            ->add('send', SubmitType::class, [
                'label' => "S'inscrire",
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
