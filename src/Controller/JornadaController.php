<?php

namespace App\Controller;

use App\Entity\Jornada;
use App\Entity\Partido;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class JornadaController extends AbstractController
{
    /**
     * @Route("/jornadas", name="jornadas")
     */
    public function index(Request $request)
    {
        $jornadas = $this->getDoctrine()->getRepository(Jornada::class)->findAll();

        $form = $this->createFormBuilder()
            ->add('Jornada', ChoiceType::class,
                array(
                    'label'        => 'Jornadas',
                    'choices'      => $jornadas,
                    'choice_label' => 'getId',
                ))
            ->add('ver', SubmitType::class, 
            	array('label' => 'Ver'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
        	$jornada = $form->getData();

        	return $this->render('jornada/partidos_jornada.html.twig', array('jornada' => $jornada['Jornada']));
        }

        return $this->render('jornada/jornadas.html.twig', ['jornadasForm' => $form->createView()]);
    }

    /**
     * @Route("/jornada/{nJornada}", name="partidos_jornada")
     */
    public function verJornada($nJornada)
    {
    	$jornada = $this->getDoctrine()->getRepository(Jornada::class)->find($nJornada);

    	return $this->render('jornada/partidos_jornada.html.twig', array('jornada' => $jornada));
    }
}
