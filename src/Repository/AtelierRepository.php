<?php

namespace App\Repository;

use App\Entity\Atelier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;
use App\Entity\Vacation;

/**
 * @extends ServiceEntityRepository<Atelier>
 *
 * @method Atelier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Atelier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Atelier[]    findAll()
 * @method Atelier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AtelierRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Atelier::class);
    }

//    /**
//     * @return Atelier[] Returns an array of Atelier objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }
//    public function findOneBySomeField($value): ?Atelier
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function RecupListAtelier() {
        
        $querybuilder = $this->createQueryBuilder('a')
                
                ->join(Vacation::class, 'v', Join::WITH, 'a.id = v.atelier')
                ->groupBy('a.id');
                dump($querybuilder);

        return $querybuilder->getQuery()->getResult();
    }
}
