<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nomUser',TextType::class,[
            'required' => false,             
        ])
        ->add('prenomUser',TextType::class,[
            'required' => false,             
        ])
        ->add('type',ChoiceType::class,[
            'choices' => [
                'particulier' => 'particulier',
                'professionnel' => 'professionnel'
            ],
            'required' => false,             
        ])
        ->add('adresseFacturation', TextType::class,[
            'required' => false,             
        ])
        ->add('cpFacturation', NumberType::class, [
            'required' => false,                 
            'label' => 'Code postal'
        ])
        ->add('villeFacturation', TextType::class,[
            'required' => false,             
        ])
        ->add('email',TextType::class,[
            'required' => false,  
        ])
        ->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'first_options' => [
                'label' => 'Mot de passe',
            ],
            'second_options' => [
                'label' => 'Comfirmation du mot de passe', 
            ],
            'invalid_message' => 'Les mots de passe ne correspondent pas',
            'required' => false,             
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
