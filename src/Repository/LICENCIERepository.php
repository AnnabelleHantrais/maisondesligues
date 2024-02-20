<?php

namespace App\Repository;

use App\Entity\LICENCIE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LICENCIE>
 *
 * @method LICENCIE|null find($id, $lockMode = null, $lockVersion = null)
 * @method LICENCIE|null findOneBy(array $criteria, array $orderBy = null)
 * @method LICENCIE[]    findAll()
 * @method LICENCIE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LICENCIERepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LICENCIE::class);
    }

//    /**
//     * @return LICENCIE[] Returns an array of LICENCIE objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LICENCIE
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
