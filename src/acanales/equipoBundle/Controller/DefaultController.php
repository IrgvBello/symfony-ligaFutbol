<?php

namespace acanales\equipoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response; //Para Response
use acanales\equipoBundle\Entity\Equipos;//Entidad equipos------------------------ Borrar
use acanales\equipoBundle\Entity\Equipo;//Entidad equipo
use acanales\equipoBundle\Form\EquiposType;//Formulario------------------------ Borrar
use acanales\equipoBundle\Form\EquipoType;//Formulario
use Symfony\Component\Security\core\SecurityContext;//Formulario login



class DefaultController extends Controller
{
    /*public function indexAction($nombre)
    {
		
        return $this->render('acanalesequipoBundle:Default:index.html.twig', array('nombre' => $nombre));
		
    }
	*/
	public function equipoCreadoAction()
    {
		  $logger = $this->get('logger');
		  $logger->info('Equipo creado satisfactoriamente');
		  
        return new Response('<html><body><h2>Equipo creado</h2></body></html>');
    }
	
	/*public function crearEquipoAction()
    {
		//Crear un equipo
		$equipo=new Equipos();
		$equipo->setNombre("Real Madrid");
		$equipo->setDivision("Primera");
		$em=$this->getDoctrine()->getManager();
		$em->persist($equipo);
		$em->flush();
		
		return $this->redirect($this->generateUrl('acanalesequipo_equipocreado'));
    }*/
	
	
	public function equiposAction(){

		$equipos=$this->get('equipos.clasificacion')->ultimosClasificados(5);

		return $this->render("acanalesequipoBundle:Default:equipos.html.twig",array("equipos"=>$equipos));
	}
	
	public function bootstrapAction(){
		 return $this->render('acanalesequipoBundle:Default:bootstrap.html.twig');
	}
	/**************************************/
/**************************************/
/**************************************/
/**************************************/
	/**************************************/	
	public function equipoAction($nombre)
    {
		$equipo = $this->getDoctrine()
        ->getRepository('acanalesequipoBundle:Equipo')
        ->findOneByNombre($nombre);
		
        return $this->render('acanalesequipoBundle:Default:equipo.html.twig', array('equipo' => $equipo));
		
    }
	public function clasificacionAction(){
		$equipos=array();		
		
		$em = $this->getDoctrine()->getManager();
		$query = $em->createQuery(
			'SELECT equipo
			FROM acanalesequipoBundle:Equipo equipo
			ORDER BY equipo.pTS DESC'
		);
		
		$equipos = $query->getResult();

		return $this->render("acanalesequipoBundle:Default:clasificacion.html.twig",array("equipos"=>$equipos));
	}
	
	public function gestionEquiposAction(){
		$equipos=array();		
		
		$em = $this->getDoctrine()->getManager();
		$query = $em->createQuery(
			'SELECT equipo
			FROM acanalesequipoBundle:Equipo equipo
			ORDER BY equipo.pTS DESC'
		);
		
		$equipos = $query->getResult();

		return $this->render("acanalesequipoBundle:Default:gestionEquipos.html.twig",array("equipos"=>$equipos));
	}
	
	public function crearEquipoAction()
    {		
		  
		$equipo = new Equipo();
		$form=$this->createForm(new EquipoType(), $equipo);
		
			$request = $this->getRequest();
			$form->handleRequest($request);

			if($request->getMethod() == 'POST')
			{
				if($form->isValid())
				{		
					$em=$this->getDoctrine()->getManager();
					
					$equipo->upload();
					
					$em->persist($equipo);
					$em->flush();
					
					return $this->redirect($this->generateURL('acanalesequipo_equipocreado'));
				}
			}
			
	     return $this->render("acanalesequipoBundle:Default:crearEquipo.html.twig",array("form"=>$form->createView()));
	}
	public function editarEquipoAction($id)
    {		
		  
		$em = $this->getDoctrine()->getEntityManager();
		$equipo = $em->getRepository('acanalesequipoBundle:Equipo')->find($id);
		$form=$this->createForm(new EquipoType(), $equipo);
		
			$request = $this->getRequest();
			$form->handleRequest($request);

			if($request->getMethod() == 'POST')
			{
				if($form->isValid())
				{		
					$em=$this->getDoctrine()->getManager();
					
					$equipo->upload();
					
					$em->persist($equipo);
					$em->flush();
					
					return $this->redirect($this->generateURL('acanalesequipo_equipocreado'));
				}
			}
			
	     return $this->render("acanalesequipoBundle:Default:crearEquipo.html.twig",array("form"=>$form->createView()));
	}	
}
