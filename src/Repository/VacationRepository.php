<?php

namespace App\Repository;

use App\Entity\Vacation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use DoctrineExtensions\Query\Mysql\Date;

/**
 * @extends ServiceEntityRepository<Vacation>
 *
 * @method Vacation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vacation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vacation[]    findAll()
 * @method Vacation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VacationRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Vacation::class);
    }

//    /**
//     * @return Vacation[] Returns an array of Vacation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }
//    public function findOneBySomeField($value): ?Vacation
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    // Dans votre repository VacationRepository.php

    public function findDistinctDateheureDebutAndFin() {
        return $this->createQueryBuilder('v') // 'v' est un alias pour votre entité Vacation
                        ->select('DISTINCT v.dateheureDebut, v.dateheureFin') // Assurez-vous que les noms des propriétés correspondent à ceux de votre entité
                        ->getQuery()
                        ->getResult();
    }
    
    public function findDistinctDates() {
        return $this->createQueryBuilder('v') // 'v' est un alias pour votre entité Vacation
                        ->select("DISTINCT DATE(v.dateheureDebut)") // Assurez-vous que les noms des propriétés correspondent à ceux de votre entité
                        ->getQuery()
                        ->getResult();
    }
}
