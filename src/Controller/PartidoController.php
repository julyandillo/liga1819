<?php

namespace App\Controller;

use App\Entity\Partido;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PartidoController extends AbstractController
{
    /**
     * @Route("/partido/{id}", name="partido")
     */
    public function index($id)
    {
        $partido = $this->getDoctrine()->getRepository(Partido::class)->find($id);
        dump($partido);

        return $this->render('partido/partido.html.twig', [
            'partido' => $partido,
        ]);
    }

}
