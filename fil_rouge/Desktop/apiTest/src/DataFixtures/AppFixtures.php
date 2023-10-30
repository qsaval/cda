<?php

namespace App\DataFixtures;

use App\Entity\Commande;
use App\Entity\Detail;
use App\Entity\Fournisseur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;
use Faker\Factory;
use App\Entity\Bd;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }
    public function load(ObjectManager $manager): void
    {
        for ($z = 0; $z < 3; $z++){
            $four = new Fournisseur();
            $four->setNomFourniseur($this->faker->word());
            $manager->persist($four);

            $fours[] = $four;
        }


        for ($j = 0; $j < 7; $j++) {
            $bd = new Bd();
            $bd->setTitre($this->faker->word())
                ->setImage($this->faker->imageUrl())
                ->setAuteur($this->faker->name())
                ->setEditeur($this->faker->word())
                ->setDateEdition($this->faker->dateTime())
                ->setStock(mt_rand(0,500))
                ->setResume($this->faker->text(300))
                ->setPrix(mt_rand(6, 10))
                ->setFournisseur($fours[mt_rand(0,count($fours)-1)]);
            $bds[] = $bd;
            $manager->persist($bd);
        }

        for($d = 0; $d < 30; $d++){
            $com = new Commande();
            $com->setMontantCommande(mt_rand(20,35))
                ->setDateCommande($this->faker->dateTime())
                ->setEtatCommande(mt_rand(0,3));
            $manager->persist($com);

            $coms[] = $com;
        }

        for ($a = 0; $a < 5; $a++){
            $com = new Commande();
            $com->setMontantCommande(mt_rand(20,35))
                ->setDateCommande(new \DateTime())
                ->setEtatCommande(mt_rand(0,3));
            $manager->persist($com);
        }

        for($p = 0; $p < 4; $p++){
            $dc = new Detail();
            $dc->setBd($bds[mt_rand(0,count($bds)-1)])
                ->setCommande($coms[mt_rand(0,count($coms)-1)])
                ->setNbCommander(mt_rand(1,3))
                ->setPrixCommander(mt_rand(6,10));
            $manager->persist($dc);
        }

        $manager->flush();
    }
}
