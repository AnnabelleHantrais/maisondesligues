<?php

namespace App\Repository;

use App\Entity\CLUB;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CLUB>
 *
 * @method CLUB|null find($id, $lockMode = null, $lockVersion = null)
 * @method CLUB|null findOneBy(array $criteria, array $orderBy = null)
 * @method CLUB[]    findAll()
 * @method CLUB[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CLUBRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CLUB::class);
    }

//    /**
//     * @return CLUB[] Returns an array of CLUB objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CLUB
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
