<?php

namespace App\Repository;

use App\Entity\Nuite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PDO;

/**
 * @extends ServiceEntityRepository<Nuite>
 *
 * @method Nuite|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nuite|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nuite[]    findAll()
 * @method Nuite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NuiteRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Nuite::class);
    }

//    /**
//     * @return Nuite[] Returns an array of Nuite objects
//     */
    public function findDistinctDateNuite(): array {
        return $this->createQueryBuilder('n')
                        ->select('DISTINCT n.dateNuite')
                        ->getQuery()
                        ->getSingleColumnResult()
        ;
    }

    public function findNuitelByHotelAndDate($hotelId, $dateNuite): ?Nuite {

        return $this->createQueryBuilder('n')
                        ->andWhere('n.hotel=:hotelId')
                        ->andWhere('n.dateNuite =:dateNuite')
                        ->setParameter('dateNuite', $dateNuite)
                        ->setParameter('hotelId', $hotelId)
                        ->getQuery()
                        ->getSingleResult()
        ;
    }

   
}
