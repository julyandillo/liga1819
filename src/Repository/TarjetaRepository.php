<?php

namespace App\Repository;

use App\Entity\Tarjeta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tarjeta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tarjeta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tarjeta[]    findAll()
 * @method Tarjeta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TarjetaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tarjeta::class);
    }

    public function getTarjetas()
    {
        $sql = "SELECT j.nombre, COUNT(t.id) as tarjetas, e.nombre as equipo
                    FROM tarjeta t
                    INNER JOIN jugador j ON j.id = t.id_jugador
                    INNER JOIN equipo e on j.id_equipo = e.id
                    GROUP BY j.id
                    HAVING count(t.id) > 0
                    ORDER BY COUNT(t.id) DESC";

        $db = $this->getEntityManager()->getConnection();
        $statement = $db->query($sql);

        return $statement->fetchAll();
    }

    public function getTarjetasEquipo($equipo, $tipo = 0)
    {
        $sql = "SELECT COUNT(*) as tarjetas
                FROM tarjeta t
                INNER JOIN jugador j on t.id_jugador = j.id
                INNER JOIN equipo e on j.id_equipo = e.id AND e.id = {$equipo}";

        if ($tipo > 0) {
            $sql .= " WHERE t.tipo = {$tipo}";
        }

        $db = $this->getEntityManager()->getConnection();
        $statement = $db->query($sql);

        $result = $statement->fetch();
        return (int) $result['tarjetas'];

    }

//    /**
//     * @return Tarjeta[] Returns an array of Tarjeta objects
//     */
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
    public function findOneBySomeField($value): ?Tarjeta
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
