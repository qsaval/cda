<?php

namespace App\Form;

use App\Entity\Bd;
use App\Entity\Categorie;
use App\Entity\Fournisseur;
use Doctrine\ORM\QueryBuilder;
use App\Repository\CategorieRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image',
            ])
            ->add('auteur')
            ->add('editeur')
            ->add('dateEdition')
            ->add('resume')
            ->add('prix')
            ->add('stock')
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'query_builder' => function (CategorieRepository $cr): QueryBuilder {
                    return $cr->createQueryBuilder('c')
                        ->join('c.categorie', 'm')
                        ->groupBy('c.id');
                },
                'choice_label' => 'nomCategorie'
            ])
            // SELECT * FROM `categorie` m JOIN categorie f ON m.id = f.categorie_id GROUP BY m.id; 
            ->add('fournisseur', EntityType::class, [
                'class' => Fournisseur::class,
                'choice_label' => 'nomFourniseur'
            ])
            ->add('ajouter', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bd::class,
        ]);
    }
}
