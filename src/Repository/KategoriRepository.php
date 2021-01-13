<?php

namespace App\Repository;

use App\Entity\Kategori;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Kategori|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kategori|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kategori[]    findAll()
 * @method Kategori[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KategoriRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Kategori::class);
    }

    // /**
    //  * @return Kategori[] Returns an array of Kategori objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Kategori
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
