<?php 

namespace acanales\equipoBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;

class Clasificacion{
	private $om;
	
	public function __construct(ObjectManager $om){
		//$this->repository= $om->getRepository('acanalesequipoBundle:Equipos');
		$this->om= $om;
	}
	public function ultimosClasificados($num){
		//return $this->repository->findAll();
		
		//****$repository = $this->getDoctrine()->getRepository("acanalesequipoBundle:Equipos");
		//****$equipos=$repository->findAll();
		$om = $this->om;
		$query = $om->createQuery(
			'SELECT a
			FROM acanalesequipoBundle:Equipos a')->setMaxResults($num);
		
		return $equipos = $query->getResult();
	}
}

