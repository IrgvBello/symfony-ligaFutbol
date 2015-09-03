<?php

namespace acanales\equipoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response; //Para Response
use acanales\equipoBundle\Entity\Equipos;//Entidad equipo
use acanales\equipoBundle\Form\EquiposType;//Formulario



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
	public function crearEquipoAction()
    {
		$equipo = new Equipos();
		$form=$this->createForm(new EquiposType(), $equipo);
		
			$request = $this->getRequest();
			$form->handleRequest($request);

			if($request->getMethod() == 'POST')
			{
				if($form->isValid())
				{
					return $this->redirect($this->generateURL('acanalesequipo_equipocreado'));
				}
			}
			
	     return $this->render("acanalesequipoBundle:Default:formulario.html.twig",array("form"=>$form->createView()));
	}
	
	public function equiposAction(){

		$equipos=$this->get('equipos.clasificacion')->ultimosClasificados(5);

		return $this->render("acanalesequipoBundle:Default:equipos.html.twig",array("equipos"=>$equipos));
	}
	
	public function bootstrapAction(){
		 return $this->render('acanalesequipoBundle:Default:bootstrap.html.twig');
	}
	
}
