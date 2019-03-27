<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use \Datetime;


/**
 * @ORM\Entity(repositoryClass="App\Repository\JugadorRepository")
 */
class Jugador
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
     * @ORM\Column(type="string", length=100)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $posicion;

    /**
     * @ORM\Column(type="integer")
     */
    private $dorsal;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $imagen;

    /**
     * @ORM\Column(type="date",name="fecha_nacimiento")
     */
    private $fechanacimiento;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nacionalidad;

    /**
     * @ORM\Column(type="string", length=50, name="pais_nacimiento")
     */
    private $paisNacimiento;

    /**
     * @ORM\ManyToOne(targetEntity="Equipo", inversedBy="jugadores")
     * @ORM\JoinColumn(name="id_equipo", referencedColumnName="id")
     * 
     */
    private $equipo;

    /**
     * @ORM\OneToMany(targetEntity="Gol", mappedBy="jugador")
     */
    private $goles;

    /**
     * @ORM\OneToMany(targetEntity="Tarjeta", mappedBy="jugador")
     */
    private $tarjetas;

    private $edad;


    public function __construct() {
        $this->goles = new ArrayCollection();
        $this->tarjetas = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     *
     * @return self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPosicion()
    {
        return $this->posicion;
    }

    /**
     * @param mixed $posicion
     *
     * @return self
     */
    public function setPosicion($posicion)
    {
        $this->posicion = $posicion;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDorsal()
    {
        return $this->dorsal;
    }

    /**
     * @param mixed $dorsal
     *
     * @return self
     */
    public function setDorsal($dorsal)
    {
        $this->dorsal = $dorsal;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @param mixed $imagen
     *
     * @return self
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGoles()
    {
        return $this->goles;
    }

    /**
     * @return mixed
     */
    public function getFechanacimiento()
    {
        return $this->fechanacimiento;
    }

    /**
     * @param mixed $fechanacimiento
     *
     * @return self
     */
    public function setFechanacimiento($fechanacimiento)
    {
        $this->fechanacimiento = $fechanacimiento;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    /**
     * @param mixed $nacionalidad
     *
     * @return self
     */
    public function setNacionalidad($nacionalidad)
    {
        $this->nacionalidad = $nacionalidad;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTarjetas()
    {
        return $this->tarjetas;
    }

    /**
     * @param mixed $tarjetas
     *
     * @return self
     */
    public function setTarjetas($tarjetas)
    {
        $this->tarjetas = $tarjetas;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaisNacimiento()
    {
        return $this->paisNacimiento;
    }

    /**
     * @param mixed $paisNacimiento
     *
     * @return self
     */
    public function setPaisNacimiento($paisNacimiento)
    {
        $this->paisNacimiento = $paisNacimiento;

        return $this;
    }

    public function getEdad() 
    {
        $edad = new DateTime("now");
        return $edad->diff($this->fechanacimiento)->format("%y");
    }

    public function getEquipo(): ? Equipo
    {
        return $this->equipo;
    }
}
