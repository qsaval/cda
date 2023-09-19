<?php

namespace App\Repository;

use App\Entity\DetailLivraison;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DetailLivraison>
 *
 * @method DetailLivraison|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailLivraison|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailLivraison[]    findAll()
 * @method DetailLivraison[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailLivraisonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailLivraison::class);
    }

//    /**
//     * @return DetailLivraison[] Returns an array of DetailLivraison objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DetailLivraison
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
