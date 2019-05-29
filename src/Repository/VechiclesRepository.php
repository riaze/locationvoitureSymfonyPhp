<?php

namespace App\Repository;

use App\Entity\Vechicles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Vechicles|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vechicles|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vechicles[]    findAll()
 * @method Vechicles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VechiclesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Vechicles::class);
    }

    // /**
    //  * @return Vechicles[] Returns an array of Vechicles objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vechicles
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
