<?php

namespace App\Repository;

use App\Entity\Specialitys;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Specialitys|null find($id, $lockMode = null, $lockVersion = null)
 * @method Specialitys|null findOneBy(array $criteria, array $orderBy = null)
 * @method Specialitys[]    findAll()
 * @method Specialitys[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpecialitysRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Specialitys::class);
    }

    // /**
    //  * @return Specialitys[] Returns an array of Specialitys objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Specialitys
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
