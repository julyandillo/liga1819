<?php

namespace App\Repository;

use App\Entity\Estadistica;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Estadistica|null find($id, $lockMode = null, $lockVersion = null)
 * @method Estadistica|null findOneBy(array $criteria, array $orderBy = null)
 * @method Estadistica[]    findAll()
 * @method Estadistica[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadisticaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Estadistica::class);
    }

    /**
     * Devuelve las ultimas estadisticas de un equipo para poder ir sumandolas en cada partido
     * @param $equipo
     * @return Estadistica|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findLast($equipo): ?Estadistica
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.equipo = :equipo')
            ->orderBy('e.jornada', 'DESC')
            ->setParameter('equipo', $equipo)
            ->getQuery()
            ->setMaxResults(1)
            ->getOneOrNullResult();
    }

    /**
     * @return array
     * @throws DBALException
     */
    public function getClasificacion()
    {
        $sql = "
            SELECT e.nombre, est.*
            FROM equipo e
            LEFT JOIN (SELECT MAX(id) as id, id_equipo FROM estadistica GROUP BY id_equipo) et ON et.id_equipo = e.id 
            LEFT JOIN estadistica est ON est.id = et.id
            ORDER BY puntos DESC, (goles_favor-goles_contra) DESC, goles_favor ASC, goles_contra DESC
            ";

        $db = $this->getEntityManager()->getConnection();
        $statement = $db->query($sql);

        return $statement->fetchAll();
    }

//    /**
//     * @return Estadistica[] Returns an array of Estadistica objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Estadistica
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
