<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EstadisticaRepository")
 * @UniqueEntity(
 *     fields={"equipo", "jornada"},
 *     message="Ya hay una estadistica para el equipo en la misma jornada"
 * )
 */
class Estadistica
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
    private $puntos;

    /**
     * @ORM\Column(type="integer")
     */
    private $jugados;

    /**
     * @ORM\Column(type="integer")
     */
    private $ganados;

    /**
     * @ORM\Column(type="integer", name="ganados_local")
     */
    private $ganadosLocal;

    /**
     * @ORM\Column(type="integer", name="ganados_visitante")
     */
    private $ganadosVisitante;

    /**
     * @ORM\Column(type="integer")
     */
    private $empatados;

    /**
     * @ORM\Column(type="integer", name="empatados_local")
     */
    private $empatadosLocal;

    /**
     * @ORM\Column(type="integer", name="empatados_visitante")
     */
    private $empatadosVisitante;

    /**
     * @ORM\Column(type="integer")
     */
    private $perdidos;

    /**
     * @ORM\Column(type="integer", name="perdidos_local")
     */
    private $perdidosLocal;

    /**
     * @ORM\Column(type="integer", name="perdidos_visitante")
     */
    private $perdidosVisitante;

    /**
     * @ORM\Column(type="integer", name="goles_favor")
     */
    private $golesFavor;

    /**
     * @ORM\Column(type="integer", name="goles_favor_local")
     */
    private $golesFavorLocal;

    /**
     * @ORM\Column(type="integer", name="goles_favor_visitante")
     */
    private $golesFavorVisitante;

    /**
     * @ORM\Column(type="integer", name="goles_contra")
     */
    private $golesContra;

    /**
     * @ORM\Column(type="integer",name="goles_contra_local")
     */
    private $golesContraLocal;

    /**
     * @ORM\Column(type="integer", name="goles_contra_visitante")
     */
    private $golesContraVisitante;

    /**
     * @ORM\ManyToOne(targetEntity="Equipo")
     * @ORM\JoinColumn(name="id_equipo", referencedColumnName="id")
     */
    private $equipo;

    /**
     * @ORM\ManyToOne(targetEntity="Jornada")
     * @ORM\JoinColumn(name="id_jornada", referencedColumnName="id")
     */
    private $jornada;


    public function __construct($equipo, $jornada)
    {
        $this->id = null;
        $this->perdidosVisitante = 0;
        $this->perdidos = 0;
        $this->perdidosLocal = 0;
        $this->jugados = 0;
        $this->empatados = 0;
        $this->empatadosVisitante = 0;
        $this->empatadosLocal = 0;
        $this->ganados = 0;
        $this->ganadosLocal = 0;
        $this->ganadosVisitante = 0;
        $this->puntos = 0;
        $this->golesContraVisitante = 0;
        $this->golesContra = 0;
        $this->golesFavorVisitante = 0;
        $this->golesFavor = 0;
        $this->ganadosVisitante = 0;
        $this->ganados = 0;
        $this->golesFavorLocal = 0;
        $this->golesContraLocal = 0;
        $this->ganadosLocal = 0;
        $this->equipo = $equipo;
        $this->jornada = $jornada;
    }

    /**
     * @return mixed
     */
    public function getPuntos()
    {
        return $this->puntos;
    }

    /**
     * @param mixed $puntos
     *
     * @return self
     */
    public function setPuntos($puntos)
    {
        $this->puntos = $puntos;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getJugados()
    {
        return $this->jugados;
    }

    /**
     * @param mixed $jugados
     *
     * @return self
     */
    public function setJugados($jugados)
    {
        $this->jugados = $jugados;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGanados()
    {
        return $this->ganados;
    }

    /**
     * @param mixed $ganados
     *
     * @return self
     */
    public function setGanados($ganados)
    {
        $this->ganados = $ganados;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGanadosLocal()
    {
        return $this->ganadosLocal;
    }

    /**
     * @param mixed $ganadosLocal
     *
     * @return self
     */
    public function setGanadosLocal($ganadosLocal)
    {
        $this->ganadosLocal = $ganadosLocal;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGanadosVisitante()
    {
        return $this->ganadosVisitante;
    }

    /**
     * @param mixed $ganadosVisitante
     *
     * @return self
     */
    public function setGanadosVisitante($ganadosVisitante)
    {
        $this->ganadosVisitante = $ganadosVisitante;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmpatados()
    {
        return $this->empatados;
    }

    /**
     * @param mixed $empatados
     *
     * @return self
     */
    public function setEmpatados($empatados)
    {
        $this->empatados = $empatados;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmpatadosLocal()
    {
        return $this->empatadosLocal;
    }

    /**
     * @param mixed $empatadosLocal
     *
     * @return self
     */
    public function setEmpatadosLocal($empatadosLocal)
    {
        $this->empatadosLocal = $empatadosLocal;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmpatadosVisitante()
    {
        return $this->empatadosVisitante;
    }

    /**
     * @param mixed $empatadosVisitante
     *
     * @return self
     */
    public function setEmpatadosVisitante($empatadosVisitante)
    {
        $this->empatadosVisitante = $empatadosVisitante;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPerdidos()
    {
        return $this->perdidos;
    }

    /**
     * @param mixed $perdidos
     *
     * @return self
     */
    public function setPerdidos($perdidos)
    {
        $this->perdidos = $perdidos;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPerdidosLocal()
    {
        return $this->perdidosLocal;
    }

    /**
     * @param mixed $perdidosLocal
     *
     * @return self
     */
    public function setPerdidosLocal($perdidosLocal)
    {
        $this->perdidosLocal = $perdidosLocal;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPerdidosVisitante()
    {
        return $this->perdidosVisitante;
    }

    /**
     * @param mixed $perdidosVisitante
     *
     * @return self
     */
    public function setPerdidosVisitante($perdidosVisitante)
    {
        $this->perdidosVisitante = $perdidosVisitante;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGolesFavor()
    {
        return $this->golesFavor;
    }

    /**
     * @param mixed $golesFavor
     *
     * @return self
     */
    public function setGolesFavor($golesFavor)
    {
        $this->golesFavor = $golesFavor;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGolesFavorLocal()
    {
        return $this->golesFavorLocal;
    }

    /**
     * @param mixed $golesFavorLocal
     *
     * @return self
     */
    public function setGolesFavorLocal($golesFavorLocal)
    {
        $this->golesFavorLocal = $golesFavorLocal;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGolesFavorVisitante()
    {
        return $this->golesFavorVisitante;
    }

    /**
     * @param mixed $golesFavorVisitante
     *
     * @return self
     */
    public function setGolesFavorVisitante($golesFavorVisitante)
    {
        $this->golesFavorVisitante = $golesFavorVisitante;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGolesContra()
    {
        return $this->golesContra;
    }

    /**
     * @param mixed $golesContra
     *
     * @return self
     */
    public function setGolesContra($golesContra)
    {
        $this->golesContra = $golesContra;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGolesContraLocal()
    {
        return $this->golesContraLocal;
    }

    /**
     * @param mixed $golesContraLocal
     *
     * @return self
     */
    public function setGolesContraLocal($golesContraLocal)
    {
        $this->golesContraLocal = $golesContraLocal;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGolesContraVisitante()
    {
        return $this->golesContraVisitante;
    }

    /**
     * @param mixed $golesContraVisitante
     *
     * @return self
     */
    public function setGolesContraVisitante($golesContraVisitante)
    {
        $this->golesContraVisitante = $golesContraVisitante;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEquipo()
    {
        return $this->equipo;
    }

    /**
     * @param mixed $equipo
     *
     * @return self
     */
    public function setEquipo($equipo)
    {
        $this->equipo = $equipo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getJornada()
    {
        return $this->jornada;
    }

    /**
     * @param mixed $jornada
     *
     * @return self
     */
    public function setJornada($jornada)
    {
        $this->jornada = $jornada;

        return $this;
    }

    public function addGoles($golesAnotados, $golesEncajados, $local = true)
    {
        $this->golesContra += $golesEncajados;
        $this->golesFavor += $golesAnotados;

        if ($local) {
            $this->golesContraLocal += $golesEncajados;
            $this->golesFavorLocal += $golesAnotados;
        } else {
            $this->golesFavorVisitante += $golesAnotados;
            $this->golesContraVisitante += $golesEncajados;
        }
    }

    public function partidoGanado( $local = true)
    {
        $this->puntos += 3;
        $this->jugados += 1;
        $this->ganados += 1;

        if ($local) {
            $this->ganadosLocal += 1;
        } else {
            $this->ganadosVisitante += 1;
        }
    }

    public function partidoEmpatado($local = true)
    {
        $this->puntos += 1;
        $this->jugados += 1;
        $this->empatados += 1;

        if ($local) {
            $this->empatadosLocal += 1;
        } else {
            $this->empatadosVisitante += 1;
        }
    }

    public function partidoPerdido($local = true)
    {
        $this->jugados += 1;
        $this->perdidos += 1;

        if ($local) {
            $this->perdidosLocal += 1;
        } else {
            $this->perdidosVisitante += 1;
        }
    }

    public function __clone()
    {
        // TODO: Implement __clone() method.
        $this->id = null;
    }
}
