<?php

namespace acanales\equipoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response; //Para Response
use acanales\equipoBundle\Entity\Equipos;//Entidad equipo

class DefaultController extends Controller
{
    public function indexAction($nombre)
    {
        return $this->render('acanalesequipoBundle:Default:index.html.twig', array('nombre' => $nombre));
    }
	
	public function equipoCreadoAction()
    {
        return new Response('<html><body><h2>Equipo creado</h2></body></html>');
    }
	
	public function crearEquipoAction()
    {
		//Crear un equipo
		$equipo=new Equipos();
		$equipo->setNombre("Real Madrid");
		$equipo->setDivision("Primera");
		$em=$this->getDoctrine()->getManager();
		$em->persist($equipo);
		$em->flush();
		
		
		return $this->redirect($this->generateUrl('acanalesequipo_equipocreado'));
    }
}
