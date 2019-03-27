<?php

namespace App\Controller;

use App\Entity\Estadistica;
use App\Entity\Gol;
use App\Entity\Tarjeta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $clasificacion = $this->getDoctrine()
            ->getRepository(Estadistica::class)
            ->getClasificacion();

        return $this->render('index/index.html.twig', ['clasificacion' => $clasificacion]);
    }

    /**
     * @Route("/golestarjetas", name="golestarjetas")
     */
    public function golesTarjetas()
    {
        $goles = $this->getDoctrine()
            ->getRepository(Gol::class)
            ->getGoleadores();

        $tarjetas = $this->getDoctrine()
            ->getRepository(Tarjeta::class)
            ->getTarjetas();

        return $this->render('golestarjetas.html.twig', ['goles' => $goles, 'tarjetas' => $tarjetas]);
    }
}
