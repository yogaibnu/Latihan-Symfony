<?php

namespace App\Repository;

use App\Entity\Produk;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Produk|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produk|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produk[]    findAll()
 * @method Produk[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProdukRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produk::class);
    }

    // /**
    //  * @return Produk[] Returns an array of Produk objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Produk
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
