<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type',ChoiceType::class,[
                'choices' => [
                    'particulier' => 'particulier',
                    'professionnel' => 'professionnel'
                ],
                'required' => false,             
            ])
            ->add('nomUser',TextType::class,[
                'required' => false,             
            ])
            ->add('prenomUser',TextType::class,[
                'required' => false,             
            ])
            ->add('email',TextType::class,[
                'required' => false,  
            ])
            ->add('adresseFacturation', TextType::class,[
                'required' => false,             
            ])
            ->add('villeFacturation', TextType::class,[
                'required' => false,             
            ])
            ->add('cpFacturation', TextType::class, [
                'required' => false,                 
                'label' => 'Code postal facturation'
            ])
            ->add('adresseLivraison', TextType::class,[
                'required' => false,             
            ])
            ->add('cpLivraison', TextType::class, [
                'required' => false,                 
                'label' => 'Code postal livraison'
            ])
            ->add('villeLivraison', TextType::class,[
                'required' => false,             
            ])
            ->add('modifier', SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
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
