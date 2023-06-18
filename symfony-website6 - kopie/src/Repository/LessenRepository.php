<?php

namespace App\Repository;

use App\Entity\Lessen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Lessen>
 *
 * @method Lessen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lessen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lessen[]    findAll()
 * @method Lessen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LessenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lessen::class);
    }

    public function save(Lessen $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Lessen $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }




    public function findAllLessons($user): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT L
            FROM App\Entity\Lessen L
            WHERE L not in (SELECT L2 FROM App\Entity\Lessen L2 LEFT JOIN L2.registrations r WHERE :user = r.member)'
        );
        $query->setParameter('user', $user);

        // returns an array of Product objects
        return $query->getResult();
    }
}

//    /**
//     * @return Lessen[] Returns an array of Lessen objects
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

//    public function findOneBySomeField($value): ?Lessen
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

