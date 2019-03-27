<?php

namespace App\Repository;

use App\Entity\Gol;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Gol|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gol|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gol[]    findAll()
 * @method Gol[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GolRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Gol::class);
    }

    public function getGoleadores()
    {
        $sql = "SELECT j.nombre, COUNT(g.id) as goles, e.nombre as equipo
                    FROM gol g
                    INNER JOIN jugador j ON j.id = g.id_jugador
                    INNER JOIN equipo e on j.id_equipo = e.id
                    GROUP BY j.id
                    HAVING count(g.id) > 0
                    ORDER BY COUNT(g.id) DESC";

        $db = $this->getEntityManager()->getConnection();
        $statement = $db->query($sql);

        return $statement->fetchAll();
    }

//    /**
//     * @return Gol[] Returns an array of Gol objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gol
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
