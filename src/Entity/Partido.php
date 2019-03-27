<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartidoRepository")
 */
class Partido
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
     * @ORM\Column(type="integer", name="goles_local")
     */
    private $nGolesLocal;

    /**
     * @ORM\Column(type="integer", name="goles_visitante")
     */
    private $nGolesVisitante;

    /**
     * @ORM\ManyToOne(targetEntity="Equipo")
     * @ORM\JoinColumn(name="id_equipo_local", referencedColumnName="id")
     */
    private $equipoLocal;

    /**
     * @ORM\ManyToOne(targetEntity="Equipo")
     * @ORM\JoinColumn(name="id_equipo_visitante", referencedColumnName="id")
     */
    private $equipoVisitante;

    /**
     * @ORM\ManyToOne(targetEntity="Jornada", inversedBy="partidos")
     * @ORM\JoinColumn(name="id_jornada", referencedColumnName="id")
     */
    private $jornada;

    /**
     * @ORM\OneToMany(targetEntity="Gol", mappedBy="partido", cascade={"persist"})
     */
    private $goles;

    /**
     * @ORM\OneToMany(targetEntity="Tarjeta", mappedBy="partido", cascade={"persist"})
     */
    private $tarjetas;

    /**
     * @ORM\Column(type="boolean")
     */
    private $finalizado;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;

    private $eventosLocal;

    private $eventosVisitante;

    public function __construct() {
        $this->goles = new ArrayCollection();
        $this->tarjetas = new ArrayCollection();

        $this->eventosLocal = array();
        $this->eventosVisitante = array();
    }
    /**
     * @return mixed
     */
    public function getGolesLocal()
    {
        return $this->nGolesLocal;
    }

    /**
     * @param mixed $nGolesLocal
     *
     * @return self
     */
    public function setGolesLocal($nGolesLocal)
    {
        $this->nGolesLocal = $nGolesLocal;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGolesVisitante()
    {
        return $this->nGolesVisitante;
    }

    /**
     * @param mixed $nGolesVisitante
     *
     * @return self
     */
    public function setGolesVisitante($nGolesVisitante)
    {
        $this->nGolesVisitante = $nGolesVisitante;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEquipoLocal(): ? Equipo
    {
        return $this->equipoLocal;
    }

    /**
     * @return mixed
     */
    public function getEquipoVisitante(): ? Equipo
    {
        return $this->equipoVisitante;
    }

    /**
     * @return mixed
     */
    public function getJornada(): ? Jornada
    {
        return $this->jornada;
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
    public function getFinalizado()
    {
        return $this->finalizado;
    }

    /**
     * @param mixed $finalizado
     *
     * @return self
     */
    public function setFinalizado($finalizado)
    {
        $this->finalizado = $finalizado;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     *
     * @return self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function addGol(Gol $gol)
    {
        $this->goles->add($gol);
    }

    public function addTarjeta(Tarjeta $tarjeta)
    {
        $this->tarjetas->add($tarjeta);
    }

    public function getTarjetas()
    {
        return $this->tarjetas;
    }

    private function ordenaEventos($equipo='local')
    {
        $eventos = array();

        foreach ($this->goles as $gol) {
            if ($equipo == 'local' && ($gol->getJugador()->getEquipo()->getId() == $this->getEquipoLocal()->getId() ||
                    ($gol->getPropiaMeta() && $gol->getJugador()->getEquipo()->getId() == $this->getEquipoVisitante()->getId())) ) {
                $eventos[] = [
                    'tipo' => 'gol',
                    'minuto' => $gol->getMinuto(),
                    'data' => $gol
                ];
            } else if($equipo == 'visitante' && $gol->getJugador()->getEquipo()->getId() == $this->getEquipoVisitante()->getId() ||
                ($gol->getPropiaMeta() && $gol->getJugador()->getEquipo()->getId() == $this->getEquipoLocal()->getId())) {
                $eventos[] = [
                    'tipo' => 'gol',
                    'minuto' => $gol->getMinuto(),
                    'data' => $gol
                ];
            }
        }

        foreach ($this->tarjetas as $tarjeta) {
            if ($equipo == 'local' && $tarjeta->getJugador()->getEquipo()->getId() == $this->getEquipoLocal()->getId()) {
                $eventos[] = [
                    'tipo' => 'tarjeta',
                    'minuto' => $tarjeta->getMinuto(),
                    'data' => $tarjeta
                ];
            } else if ($equipo == 'visitante' && $tarjeta->getJugador()->getEquipo()->getId() == $this->getEquipoVisitante()->getId()) {
                $eventos[] = [
                    'tipo' => 'tarjeta',
                    'minuto' => $tarjeta->getMinuto(),
                    'data' => $tarjeta
                ];
            }
        }

        usort($eventos,function($a, $b) { if ($a['minuto'] == $b['minuto']) {return 0;} return ($a['minuto'] < $b['minuto']) ? -1 : 1; });

        return $eventos;
    }

    public function getEventosLocal()
    {
        if (!empty($this->eventosLocal)) {
            return $this->eventosLocal;
        }

        $this->eventosLocal = $this->ordenaEventos();

        return $this->eventosLocal;
    }

    public function getEventosVisitante()
    {
        if (!empty($this->eventosVisitante)) {
            return $this->eventosVisitante;
        }

        $this->eventosVisitante = $this->ordenaEventos('visitante');

        return $this->eventosVisitante;
    }
}
