<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use \Datetime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipoRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Equipo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId():  ? int
    {
        return $this->id;
    }

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $escudo;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $entrenador;

    /**
     * @ORM\Column(type="integer")
     */
    private $fundacion;

    /**
     * @ORM\OneToOne(targetEntity="Estadio")
     * @ORM\JoinColumn(name="id_estadio", referencedColumnName="id")
     */
    private $estadio;

    /**
     * @ORM\OneToMany(targetEntity="Jugador", mappedBy="equipo")
     * @ORM\OrderBy({"nombre" = "ASC"})
     */
    private $jugadores;

    /**
     * @ORM\Column(type="string", length=100, name="nombre_club")
     */
    private $nombreClub;

    /**
     * @ORM\Column(type="string")
     */
    private $direccion;

    private $mediaEdad;

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
    public function getEscudo()
    {
        return $this->escudo;
    }

    /**
     * @param mixed $escudo
     *
     * @return self
     */
    public function setEscudo($escudo)
    {
        $this->escudo = $escudo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEntrenador()
    {
        return $this->entrenador;
    }

    /**
     * @param mixed $entrenador
     *
     * @return self
     */
    public function setEntrenador($entrenador)
    {
        $this->entrenador = $entrenador;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFundacion()
    {
        return $this->fundacion;
    }

    /**
     * @param mixed $fundacion
     *
     * @return self
     */
    public function setFundacion($fundacion)
    {
        $this->fundacion = $fundacion;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEstadio()
    {
        return $this->estadio;
    }

    /**
     * @param mixed $estadio
     *
     * @return self
     */
    public function setEstadio($estadio)
    {
        $this->estadio = $estadio;

        return $this;
    }

    public function __construct()
    {
        $this->jugadores = new ArrayCollection();
        $this->partidos_visitante = new ArrayCollection();
        $this->partidos_local = new ArrayCollection();
    }

    public function getJugadores()
    {
        return $this->jugadores;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     *
     * @return self
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNombreClub()
    {
        return $this->nombreClub;
    }

    /**
     * @param mixed $nombreClub
     *
     * @return self
     */
    public function setNombreClub($nombreClub)
    {
        $this->nombreClub = $nombreClub;

        return $this;
    }

    /**
     * @ORM\PostLoad
     */
    public function setMediaEdad()
    {
        $media = 0;
        $sinEdad = 0;

        foreach ($this->jugadores->toArray() as $jugador) {
            if (strtotime($jugador->getFechanacimiento()->format('Y-m-d')) != strtotime('1980-01-01')) {
                $media += (int) $jugador->getEdad();
            } else {
                $sinEdad++;
            }

        }

        $this->mediaEdad = $media / ($this->jugadores->count()-$sinEdad);
    }

    public function getMediaEdad()
    {
        return round($this->mediaEdad, 1);
    }
}
