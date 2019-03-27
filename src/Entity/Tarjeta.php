<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TarjetaRepository")
 */
class Tarjeta
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

    public function __construct($minuto, $jugador, $tipo, $partido)
    {
        $this->minuto = $minuto;
        $this->partido = $partido;
        $this->jugador = $jugador;
        $this->tipo = $tipo;
    }

    /**
     * @ORM\Column(type="integer")
     */
    private $minuto;

    /**
     * @ORM\Column(type="smallint")
     */
    private $tipo;

    /**
     * @ORM\ManyToOne(targetEntity="Jugador", inversedBy="tarjetas")
     * @ORM\JoinColumn(name="id_jugador", referencedColumnName="id")
     */
    private $jugador;

    /**
     * @ORM\ManyToOne(targetEntity="Partido", inversedBy="tarjetas")
     * @ORM\JoinColumn(name="id_partido", referencedColumnName="id")
     */
    private $partido;

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
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     *
     * @return self
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

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
