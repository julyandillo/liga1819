<?php

namespace App\Repository;

use App\Entity\Partido;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Partido|null find($id, $lockMode = null, $lockVersion = null)
 * @method Partido|null findOneBy(array $criteria, array $orderBy = null)
 * @method Partido[]    findAll()
 * @method Partido[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartidoRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Partido::class);
    }

    /**
     * devuelve un partido buscando por el equipo local y visitante
     * @param $local
     * @param $visitante
     * @return Partido|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findByTeamsNames($local, $visitante): ?Partido
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.equipoLocal', 'l')
            ->innerJoin('p.equipoVisitante', 'v')
            ->where('p.finalizado = 0 AND l.nombre = :local AND v.nombre = :visitante')
            ->setParameter('local', $local)
            ->setParameter('visitante', $visitante)
            ->getQuery()
            ->getOneOrNullResult();
    }

//    /**
//     * @return Partido[] Returns an array of Partido objects
//     */
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
    public function findOneBySomeField($value): ?Partido
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
