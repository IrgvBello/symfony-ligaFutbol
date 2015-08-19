<?php

namespace acanales\RecetasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response; //Para Response

class DefaultController extends Controller
{
    public function indexAction($id)
    {
        return $this->render('acanalesRecetasBundle:Default:index.html.twig', array('name' => $id));
    }
	public function listAction($nombre)
    {
		$nombre=str_replace('-',' ',$nombre); //Quita guiones del nombre
        return new Response('<html><body><ul><li>Receta de <b>'.$nombre.'</b></li></ul></body></html>');
    }
}
