<?php 

namespace acanales\equipoBundle\Model;

use Doctrine\Common\Persistence\ObjetManager;

class Clasificacion{
	private $repository;
	
	public function __construct(ObjetManager $om){
		$this->repository= $om->getRepository('acanalesequipoBundle:Equipos');
	}
	public function ultimosClasificados($num){
		return $this->repository->findAll();
	//	return array(); //----Si devuelve el array
	}
}

