<?php

namespace App\Repository;

use App\Entity\Traduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Traduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method Traduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method Traduct[]    findAll()
 * @method Traduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TraductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Traduct::class);
    }

    // /**
    //  * @return Traduct[] Returns an array of Traduct objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Traduct
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
