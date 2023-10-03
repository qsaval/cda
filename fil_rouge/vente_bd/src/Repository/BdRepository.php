<?php

namespace App\Repository;

use App\Entity\Bd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bd>
 *
 * @method Bd|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bd|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bd[]    findAll()
 * @method Bd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bd::class);
    }

   /**
    * @return Bd[] Returns an array of Bd objects
    */
   public function findByExampleField(): array
   {
       return $this->createQueryBuilder('b')
           ->groupBy('b.categorie')
           ->orderBy('b.id', 'ASC')
           ->setMaxResults(3)
           ->getQuery()
           ->getResult()
       ;
   }

   public function findBdByName(string $query)
    {
        $qb = $this->createQueryBuilder('b');
        $qb
            ->where(
                $qb->expr()->andX(
                    $qb->expr()->orX(
                        $qb->expr()->like('b.titre', ':query'),
                        $qb->expr()->like('b.resume', ':query'),
                    )
                )
            )
            ->setParameter('query', '%' . $query . '%')
        ;
        return $qb
            ->getQuery()
            ->getResult();
    }

//    public function findOneBySomeField($value): ?Bd
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
