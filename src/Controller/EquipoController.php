<?php

namespace App\Controller;

use App\Entity\Equipo;
use App\Entity\Estadistica;
use App\Entity\Tarjeta;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EquipoController extends AbstractController
{
    /**
     * @Route("/equipos", name="equipos")
     */
    public function index()
    {
        $equipos = $this->getDoctrine()
        	->getRepository(Equipo::class)
        	->findAllSorted('nombre');

        return $this->render('equipo/equipos.html.twig', ['equipos' => $equipos]);
    }

    /**
     * @Route("/equipo/{id}", name="equipo")
     */
    public function mostrarEquipo($id)
    {
    	$equipo = $this->getDoctrine()
    						->getRepository(Equipo::class)
    						->find($id);

    	$estadisticas = $this->getDoctrine()
            ->getRepository(Estadistica::class)
            ->findLast($equipo);

    	$jugadosChart = new PieChart();
    	$jugadosChart->getData()->setArrayToDataTable(
    	    [
    	        ['partidos jugados', '#'],
                ['ganados', $estadisticas->getGanados()],
                ['empatados', $estadisticas->getEmpatados()],
                ['perdidos', $estadisticas->getPerdidos()]
            ]
        );
    	$jugadosChart->getOptions()->setTitle('Partidos disputados: ' . $estadisticas->getJugados());
    	$jugadosChart->getOptions()->getLegend()->setPosition('none');
    	$jugadosChart->getOptions()->setHeight(250);
    	$jugadosChart->getOptions()->setWidth(250);
    	$jugadosChart->getOptions()->setFontSize(14);

    	$ganadosChart = new PieChart();
    	$ganadosChart->getData()->setArrayToDataTable(
    	    [
    	        ['partidos ganados', '#'],
    	        ['en casa', $estadisticas->getGanadosLocal()],
                ['fuera', $estadisticas->getGanadosVisitante()]
            ]
        );
    	$ganadosChart->getOptions()->setTitle('Ganados: ' . $estadisticas->getGanados());
    	$ganadosChart->getOptions()->getLegend()->setPosition('none');
    	$ganadosChart->getOptions()->setWidth(200);
    	$ganadosChart->getOptions()->setHeight(200);
    	$ganadosChart->getOptions()->setFontSize(12);
    	
    	$empatadosChart = new PieChart();
    	$empatadosChart->getData()->setArrayToDataTable(
    	    [
    	        ['partidos empatados', '#'],
                ['en casa', $estadisticas->getEmpatadosLocal()],
                ['fuera', $estadisticas->getEmpatadosVisitante()]
            ]
        );
        $empatadosChart->getOptions()->setTitle('Empatados: ' . $estadisticas->getEmpatados());
        $empatadosChart->getOptions()->getLegend()->setPosition('none');
        $empatadosChart->getOptions()->setWidth(200);
        $empatadosChart->getOptions()->setHeight(200);
        $empatadosChart->getOptions()->setFontSize(12);

        $perdidosChart = new PieChart();
        $perdidosChart->getData()->setArrayToDataTable(
            [
                ['partidos perdidos', '#'],
                ['en casa', $estadisticas->getperdidosLocal()],
                ['fuera', $estadisticas->getperdidosVisitante()]
            ]
        );
        $perdidosChart->getOptions()->setTitle('Perdidos: ' . $estadisticas->getPerdidos());
        $perdidosChart->getOptions()->getLegend()->setPosition('none');
        $perdidosChart->getOptions()->setWidth(200);
        $perdidosChart->getOptions()->setHeight(200);
        $perdidosChart->getOptions()->setFontSize(12);
        
        $puntosChart = new PieChart();
        $puntosChart->getData()->setArrayToDataTable(
            [
                ['puntos', '#'],
                ['en casa', $estadisticas->getGanadosLocal()*3 + $estadisticas->getEmpatadosLocal()],
                ['fuera', $estadisticas->getGanadosVisitante()*3 + $estadisticas->getEmpatadosVisitante()]
            ]
        );
        $puntosChart->getOptions()->setTitle('Puntos: ' . $estadisticas->getPuntos() . ' de ' .
            $estadisticas->getJugados()*3 . ' posibles (' .
            round(($estadisticas->getPuntos()/($estadisticas->getJugados()*3))*100, 2) .'%)');
        $puntosChart->getOptions()->getLegend()->setPosition('none');
        $puntosChart->getOptions()->setWidth(250);
        $puntosChart->getOptions()->setHeight(250);
        $puntosChart->getOptions()->setFontSize(14);

        $golesChart = new PieChart();
        $golesChart->getData()->setArrayToDataTable(
            [
                ['goles', '#'],
                ['en casa', $estadisticas->getGolesFavorLocal()],
                ['fuera', $estadisticas->getGolesFavorVisitante()]
            ]
        );
        $golesChart->getOptions()->setTitle('Goles a favor: ' . $estadisticas->getGolesFavor());
        $golesChart->getOptions()->getLegend()->setPosition('none');
        $golesChart->getOptions()->setWidth(250);
        $golesChart->getOptions()->setHeight(250);
        $golesChart->getOptions()->setFontSize(14);

        $golesContraChart = new PieChart();
        $golesContraChart->getData()->setArrayToDataTable(
            [
                ['goles en contra', '#'],
                ['en casa', $estadisticas->getgolesContraLocal()],
                ['fuera', $estadisticas->getgolesContraVisitante()]
            ]
        );
        $golesContraChart->getOptions()->setTitle('Goles en contra: ' . $estadisticas->getGolesContra());
        $golesContraChart->getOptions()->getLegend()->setPosition('none');
        $golesContraChart->getOptions()->setWidth(250);
        $golesContraChart->getOptions()->setHeight(250);
        $golesContraChart->getOptions()->setFontSize(14);

        $tarjetas = $this->getDoctrine()
            ->getRepository(Tarjeta::class);

        $tarjetasChart = new PieChart();
        $tarjetasChart->getData()->setArrayToDataTable(
            [
                ['tarjetas', '#'],
                ['amarillas', $tarjetas->getTarjetasEquipo($equipo->getId(), 1)],
                ['rojas', $tarjetas->getTarjetasEquipo($equipo->getId(), 2)]
            ]
        );
        $tarjetasChart->getOptions()->setTitle('Tarjetas: ' . $tarjetas->getTarjetasEquipo($equipo->getId()));
        $tarjetasChart->getOptions()->getLegend()->setPosition('none');
        $tarjetasChart->getOptions()->setWidth(250);
        $tarjetasChart->getOptions()->setHeight(250);
        $tarjetasChart->getOptions()->setFontSize(14);

        
    	return $this->render('equipo/equipo.html.twig',
            [
                'equipo' => $equipo,
                'estadisticas' => $estadisticas,
                'ganados' => $ganadosChart,
                'jugados' => $jugadosChart,
                'empatados' => $empatadosChart,
                'perdidos' => $perdidosChart,
                'puntos' => $puntosChart,
                'golesFavor' => $golesChart,
                'golesContra' => $golesContraChart,
                'tarjetas' => $tarjetasChart
            ]);
    }
}
