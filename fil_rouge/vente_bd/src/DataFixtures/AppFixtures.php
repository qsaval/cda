<?php

namespace App\DataFixtures;

use App\Entity\Bd;
use App\Entity\Categorie;
use App\Entity\Fournisseur;
use App\Entity\Livraison;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
use App\Entity\User;
use App\Entity\Commande;
use App\Entity\DetailCommande;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        for($k = 0; $k < 2; $k++){
            $user = new User();
            $user->setEmail($this->faker->email())
                ->setPassword(password_hash('password', PASSWORD_DEFAULT))
                ->setNomUser($this->faker->lastName())
                ->setPrenomUser($this->faker->firstName())
                ->setAdresseFacturation($this->faker->streetAddress())
                ->setVilleFacturation($this->faker->city())
                ->setCpFacturation($this->faker->postcode())
                ->setAdresseLivraison($this->faker->streetAddress())
                ->setVilleLivraison($this->faker->city())
                ->setCpLivraison($this->faker->postcode())
                ->setType($this->faker->word());
            $manager->persist($user);

            $users[] = $user;
            
        }

        for ($z = 0; $z < 2; $z++) {
            $catm = new Categorie();
            $catm->setNomCategorie($this->faker->word())
                ->setImageCategorie($this->faker->image())
                ->setCategorie(null);
            $manager->persist($catm);

            for ($i = 0; $i < 2; $i++) {
                $cat = new Categorie();
                $cat->setNomCategorie($this->faker->word())
                    ->setImageCategorie($this->faker->image())
                    ->setCategorie($catm);
                $manager->persist($cat);

                $four = new Fournisseur();
                $four->setNomFourniseur($this->faker->word())
                    ->setNomContact($this->faker->name())
                    ->setTelephoneContact($this->faker->phoneNumber())
                    ->setAdresseFournisseur($this->faker->streetAddress())
                    ->setVilleFournisseur($this->faker->city())
                    ->setCpFournisseur(strval($this->faker->postcode()));
                $manager->persist($four);

                for ($j = 0; $j < 2; $j++) {
                    $bd = new Bd();
                    $bd->setCategorie($cat)
                        ->setFournisseur($four)
                        ->setTitre($this->faker->word())
                        ->setImageBd($this->faker->image())
                        ->setAuteur($this->faker->name())
                        ->setEditeur($this->faker->word())
                        ->setDateEdition($this->faker->dateTime())
                        ->setResume($this->faker->text(300))
                        ->setPrix(mt_rand(6, 10));
                    $manager->persist($bd);

                    $bds[] = $bd;
                }
            }
        }

        for($t = 0;$t < 2; $t++){
            $liv = new Livraison();
            $liv->setDateLivraison($this->faker->dateTime())
                ->setNomTransporteur($this->faker->word())
                ->setRetardEventuel(mt_rand(0,1) == 1 ? true:false)
                ->setTelephoneTransporteur($this->faker->phoneNumber());
            $manager->persist($liv);

            $livs[] = $liv;
        }

        for($d = 0; $d < 3; $d++){
            $com = new Commande();
            $com->setLivraison($livs[mt_rand(0,count($livs)-1)])
                ->setUser($users[mt_rand(0,count($users)-1)])
                ->setMontantCommande(mt_rand(20,35))
                ->setDateCommande($this->faker->dateTime())
                ->setEtatCommande(mt_rand(0,3))
                ->setFacture($this->faker->fileExtension('pdf'))
                ->setAdresseFacture($this->faker->streetAddress())
                ->setVilleFacture($this->faker->city())
                ->setCpFacture($this->faker->postcode())
                ->setNbColis(mt_rand(1,3));
            $manager->persist($com);
            
            $coms[] = $com;
        }

        for($p = 0; $p < 4; $p++){
            $dc = new DetailCommande();
            $dc->setBd($bds[mt_rand(0,count($bds)-1)])
                ->setCommande($coms[mt_rand(0,count($coms)-1)])
                ->setNbCommander(mt_rand(1,3))
                ->setPrixCommander(mt_rand(6,10));
            $manager->persist($dc);
        }

        $manager->flush();
    }
}
