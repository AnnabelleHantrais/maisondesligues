<?php

namespace App\Repository;

use App\Entity\Proposer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Proposer>
 *
 * @method Proposer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Proposer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Proposer[]    findAll()
 * @method Proposer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProposerRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Proposer::class);
    }

    /**
     * @return Proposer[] Returns an array of Proposer objects
     */
    public function findProposerByNuiteAndHotel($categorieId, $hotelId): Proposer {
        return $this->createQueryBuilder('p')
                        ->andWhere('p.hotel = :hotelId')
                        ->andWhere('p.categorie = :categorieId')
                        ->setParameter(':categorieId', $categorieId)
                        ->setParameter(':hotelId', $hotelId)
                        ->orderBy('p.id', 'ASC')
                        ->setMaxResults(10)
                        ->getQuery()
                        ->getSingleResult()
        ;
    }

//    public function findOneBySomeField($value): ?Proposer
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
