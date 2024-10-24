<?php

namespace App\Repository;

use App\Entity\Groupes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Groupes>
 */
class GroupesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Groupes::class);
    }

    //    /**
    //     * @return Groupes[] Returns an array of Groupes objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    public function findOneById($value): ?Groupes
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.id = :val') //on cherche l'id
            ->setParameter('val', $value) //on veut que la valeur soit la valeur passée en paramètre
            ->getQuery() //on fait un get
            ->getOneOrNullResult() //va nous en retrouner un ou alors retournera null
        ;
    }
}
