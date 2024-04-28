<?php

namespace App\Repository;

use App\Entity\Hotel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\CategorieChambreRepository;
use Doctrine\ORM\Query\Expr\Join;
/**
 * @extends ServiceEntityRepository<Hotel>
 *
 * @method Hotel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hotel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hotel[]    findAll()
 * @method Hotel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HotelRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Hotel::class);
    }

    public function RecupHotel() {
        // Récupérer tous les hôtels
        $hotels = $this->getDoctrine()
                ->getRepository(Hotel::class)
                ->findAll();

        // Créer un tableau vide pour les catégories et tarifs
        $categoriesEtTarifs = [];

        // Parcourir les hôtels
        foreach ($hotels as $hotel) {
            // Récupérer les catégories et tarifs de l'hôtel
            $categories = $this->getDoctrine()
                    ->getRepository(CategorieChambre::class)
                    ->findCategoriesAvecTarifs($hotel->getId());

            // Ajouter les catégories et tarifs au tableau
            $categoriesEtTarifs[$hotel->getId()] = $categories;
        }

        // Afficher la page d'accueil avec le menu déroulant et les tarifs
        return $this->render('templates/home/index.html.twig', [
                    'hotels' => $hotels,
                    'categoriesEtTarifs' => $categoriesEtTarifs,
        ]);
    }

    public function findChambresEtTarifsParHotel($hotelId) {
        $entityManager = $this->getEntityManager();
        $qb = $entityManager->createQueryBuilder();

        $qb->select('h.id, h.pnom, c.libelleCategorie, p.tarifNuite')
                ->from('App\Entity\Hotel', 'h')
                ->join('App\Entity\Proposer', 'p',Join::WITH, $qb->expr()->eq('p.hotel', ':hotelId') )
                ->join('App\Entity\CategorieChambre', 'c', Join::WITH, $qb->expr()->eq('p.categorie', 'c.id'))
                ->where('h.id = :hotelId')
//                ->groupBy('h.id, c.id')
                ->orderBy('h.pnom', 'ASC')
                ->addOrderBy('c.libelleCategorie', 'ASC')
                ->setParameter('hotelId', $hotelId);

        return $qb->getQuery()->getResult();
    }


    public function findChambresEtNuitesParHotel() {
            $entityManager = $this->getEntityManager();
            $qb = $entityManager->createQueryBuilder();

            $qb->select('h.id, h.pnom, c.libelleCategorie, p.tarifNuite')
                    ->from('App\Entity\Hotel', 'h')
                    ->join('App\Entity\Proposer', 'p',Join::WITH, $qb->expr()->eq('p.hotel', ':hotelId') )
                    ->join('App\Entity\CategorieChambre', 'c', Join::WITH, $qb->expr()->eq('p.categorie', 'c.id'))
                    ->where('h.id = :hotelId')
    //                ->groupBy('h.id, c.id')
                    ->orderBy('h.pnom', 'ASC')
                    ->addOrderBy('c.libelleCategorie', 'ASC')
                    ->addGroupBy()
                    ->setParameter('hotelId', $hotelId);

            return $qb->getQuery()->getResult();
        }
}

