<?php

namespace App\Repository;

use App\Entity\Annonce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Annonce>
 *
 * @method Annonce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Annonce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Annonce[]    findAll()
 * @method Annonce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnonceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Annonce::class);
    }

    public function save(Annonce $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Annonce $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getSeller(int $id): array
    {
        return $this->createQueryBuilder('annonce')
            ->innerJoin('annonce.id_user', 'user')
            ->addSelect('user.pseudo', 'user.email', 'user.id', 'user.profilePicture')
            ->andWhere('annonce.id LIKE :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }

    /**
     * Recherche par titre d'annonce ou localisation
     * @param $search
     * @return array
     */
    public function searchAnnonce($search): array
    {
        return $this->createQueryBuilder('annonce')
                ->innerJoin('annonce.id_user', 'user')
                ->where('annonce.title LIKE :search')
                ->orWhere('user.localisation LIKE :search')
                ->setParameter('search', $search.'%')
                ->getQuery()
                ->getResult();
    }

//    /**
//     * @return Annonce[] Returns an array of Annonce objects
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

//    public function findOneBySomeField($value): ?Annonce
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
