<?php

namespace App\Repository;

use App\Entity\Personne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Personne|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personne|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personne[]    findAll()
 * @method Personne[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonneRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Personne::class);
    }

    // /**
    //  * @return Personne[] Returns an array of Personne objects
    //  */

    public function findByNameOrdredFirstname($name, $maxResult = 5, $order = 0)
    {
        if ($order) {
            $order = 'Desc';
        } else {
            $order = 'Asc';
        }
        return $this->createQueryBuilder('p')
            ->andWhere('p.name = :name')
            ->setParameter('name', $name)
            ->orderBy('p.firstname', $order )
            ->setMaxResults($maxResult)
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Personne
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
