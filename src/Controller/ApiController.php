<?php

namespace App\Controller;

use App\Entity\Estadistica;
use App\Entity\Gol;
use App\Entity\Jugador;
use App\Entity\Partido;
use App\Entity\Tarjeta;
use App\Entity\User;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;


class ApiController extends FOSRestController
{
    public function getLoginAction() {}

    /**
     * @Rest\Post("/register", name="register_user")
     *
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();

        $username = $request->request->get('_username');
        $password = $request->request->get('_password');

        $user = new User($username);
        $user->setPassword($encoder->encodePassword($user, $password));

        $em->persist($user);
        $em->flush();

        $response = array(
            "code" => 200,
            "message" => "Usuario '{$username}' creado correctamente",
            "error" => false
        );

        return new Response(json_encode($response));
    }

    /**
     * @Rest\Post("/login", name="login")
     */
    public function loginAction() {}

    /**
     * @Rest\Get("/test", name="test")
     */
    public function testAction()
    {
        $response = array(
            "code" => 200,
            "message" => "el usuario '{$this->getUser()->getUsername()}' tiene permiso para utilizar la API"
        );

        return new Response(json_encode($response));
    }

    /**
     * @Rest\Post("/guardarpartido", name="update_partido")
     * @param Request $request
     * @return Response
     */
    public function partidoAction(Request $request)
    {
        $local = $request->request->get('local');
        $visitante = $request->request->get('visitante');
        $golesLocal = $request->request->get('golesLocal');
        $golesVisitante = $request->request->get('golesVisitante');


        try {
            $partido = $this->getDoctrine()
                ->getRepository(Partido::class)
                ->findByTeamsNames($local, $visitante);

            if ($partido) {
                $partido->setFinalizado(true);
                $partido->setGolesLocal($golesLocal);
                $partido->setGolesVisitante($golesVisitante);

                $json_request = json_decode($request->getContent());

                foreach ($json_request->goles as $gol) {
                    $jugador = $this->getDoctrine()
                        ->getRepository(Jugador::class)
                        ->find($gol->jugador);
                    $partido->addGol(new Gol($gol->minuto, $jugador, $gol->penalti, $gol->propiaMeta, $partido));
                }

                foreach ($json_request->tarjetas as $tarjeta) {
                    $jugador = $this->getDoctrine()
                        ->getRepository(Jugador::class)
                        ->find($tarjeta->jugador);
                    $partido->addTarjeta(new Tarjeta($tarjeta->minuto, $jugador, $tarjeta->tipo, $partido));
                }

                $estadisticasLocal = $this->getDoctrine()
                    ->getRepository(Estadistica::class)
                    ->findLast($partido->getEquipoLocal()->getId());

                if ($estadisticasLocal != null) {
                    $estadisticasLocalActualizadas = clone $estadisticasLocal;
                    $estadisticasLocalActualizadas->setJornada($partido->getJornada());
                } else {
                    $estadisticasLocalActualizadas = new Estadistica($partido->getEquipoLocal(),
                        $partido->getJornada());
                }
                $estadisticasLocalActualizadas->addGoles($golesLocal, $golesVisitante);

                $estadisticasVisitante = $this->getDoctrine()
                    ->getRepository(Estadistica::class)
                    ->findLast($partido->getEquipoVisitante()->getId());

                if ($estadisticasVisitante != null) {
                    $estadisticasVisitanteActualizadas = clone $estadisticasVisitante;
                    $estadisticasVisitanteActualizadas->setJornada($partido->getJornada());
                } else {
                    $estadisticasVisitanteActualizadas = new Estadistica($partido->getEquipoVisitante(),
                        $partido->getJornada());
                }
                $estadisticasVisitanteActualizadas->addGoles($golesVisitante, $golesLocal, false);


                if ($golesLocal > $golesVisitante) {
                    $estadisticasLocalActualizadas->partidoGanado();
                    $estadisticasVisitanteActualizadas->partidoPerdido(false);
                } else if ($golesLocal == $golesVisitante) {
                    $estadisticasLocalActualizadas->partidoEmpatado();
                    $estadisticasVisitanteActualizadas->partidoEmpatado(false);
                } else {
                    $estadisticasLocalActualizadas->partidoPerdido();
                    $estadisticasVisitanteActualizadas->partidoGanado(false);
                }

                $em = $this->getDoctrine()->getManager();
                $em->persist($partido);
                $em->persist($estadisticasLocalActualizadas);
                $em->persist($estadisticasVisitanteActualizadas);

                $em->flush();


                $response = array(
                    "code" => 200,
                    "message" => "Partido {$local}-{$visitante} guardado correctamente"
                );

                return new Response(json_encode($response));

                /*return $this->render('api/index.html.twig', [
                    'controller_name' => 'PartidoController',
                    'partido' => $partido,
                    'estadisticas' => [
                        'local' => $estadisticasLocalActualizadas,
                        'visitante' => $estadisticasVisitanteActualizadas
                    ]
                ]);*/
            } else {
                $response = array(
                    "code" => 200,
                    "message" => "El partido {$local} - {$visitante} ya estaba guardado"
                );

                return new Response(json_encode($response));
            }

        } catch (NonUniqueResultException $ex) {
            $response = array(
                "code" => 200,
                "message" => "Se ha encontrado mas de un partido con los datos facilitados"
            );

            return new Response(json_encode($response));
        }
        // return new Response(json_encode($response));
    }




}
