<?php

namespace App\Repository;

use App\Entity\Restauration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PDO;
use Doctrine\ORM\EntityManager;


/**
 * @extends ServiceEntityRepository<Restauration>
 *
 * @method Restauration|null find($id, $lockMode = null, $lockVersion = null)
 * @method Restauration|null findOneBy(array $criteria, array $orderBy = null)
 * @method Restauration[]    findAll()
 * @method Restauration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestaurationRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Restauration::class);
    }

    public function findDistinctDateRestauration(): array {
        return $this->createQueryBuilder('r')
                        ->select('DISTINCT r.dateRestauration')
                        ->getQuery()
                        ->getSingleColumnResult()
        ;
    }

    public function findDistinctTypeRepas(): array {
        return $this->createQueryBuilder('r')
                        ->select('DISTINCT r.typeRepas')
                        ->getQuery()
                        ->getSingleColumnResult()
        ;
    }

//    /**
//     * @return Restauration[] Returns an array of Restauration objects
//     */
    public function findByDateRestauration($value): array|bool {
      return $this->createQueryBuilder('r')
              ->andWhere('r.dateRestauration=:val')
              ->setParameter('val', $value)
                        ->getQuery()
                        ->getResult()
        ;
    }

//    public function findOneBySomeField($value): ?Restauration
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
