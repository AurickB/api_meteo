<?php

namespace App\Repository;

use App\Entity\WeatherSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method WeatherSearch|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeatherSearch|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeatherSearch[]    findAll()
 * @method WeatherSearch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeatherSearchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeatherSearch::class);
    }

    // /**
    //  * @return WeatherSearch[] Returns an array of WeatherSearch objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WeatherSearch
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
