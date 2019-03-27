<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GolRepository")
 */
class Gol
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="integer")
     */
    private $minuto;

    /**
     * @ORM\Column(type="boolean")
     */
    private $penalti;

    /**
     * @ORM\Column(type="boolean", name="propia_meta")
     */
    private $propiaMeta;

    /**
     * @ORM\ManyToOne(targetEntity="Jugador", inversedBy="goles")
     * @ORM\JoinColumn(name="id_jugador", referencedColumnName="id")
     */
    private $jugador;

    /**
     * @ORM\ManyToOne(targetEntity="Partido", inversedBy="goles")
     * @ORM\JoinColumn(name="id_partido", referencedColumnName="id")
     */
    private $partido;

    public function __construct($minuto, $jugador, $penalti, $propiaMeta, $partido)
    {
        $this->minuto = $minuto;
        $this->jugador = $jugador;
        $this->partido = $partido;
        $this->penalti = $penalti;
        $this->propiaMeta = $propiaMeta;
    }


    /**
     * @return mixed
     */
    public function getMinuto()
    {
        return $this->minuto;
    }

    /**
     * @param mixed $minuto
     *
     * @return self
     */
    public function setMinuto($minuto)
    {
        $this->minuto = $minuto;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPenalti()
    {
        return $this->penalti;
    }

    /**
     * @param mixed $penalti
     *
     * @return self
     */
    public function setPenalti($penalti)
    {
        $this->penalti = $penalti;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPropiaMeta()
    {
        return $this->propiaMeta;
    }

    /**
     * @param mixed $propiaMeta
     *
     * @return self
     */
    public function setPropiaMeta($propiaMeta)
    {
        $this->propiaMeta = $propiaMeta;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getJugador()
    {
        return $this->jugador;
    }

    /**
     * @param mixed $jugador
     *
     * @return self
     */
    public function setJugador($jugador)
    {
        $this->jugador = $jugador;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPartido()
    {
        return $this->partido;
    }

    /**
     * @param mixed $partido
     *
     * @return self
     */
    public function setPartido($partido)
    {
        $this->partido = $partido;

        return $this;
    }
}
