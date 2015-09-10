<?php

namespace acanales\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use acanales\UserBundle\Entity\User;//Entidad user
use acanales\UserBundle\Form\UserType;//Formulario
use acanales\UserBundle\Form\UserEdit;//Formulario

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('acanalesUserBundle:Default:index.html.twig', array('name' => $name));
    }
	public function crearUsuarioAction(){

		$user = new User();
		$form=$this->createForm(new UserType(), $user);

		$request = $this->getRequest();
			$form->handleRequest($request);

			if($request->getMethod() == 'POST')
			{
				if($form->isValid())
				{
					$user->setRoles('ROLE_USER');
					$user->setSalt('');
					$user->setStatus('1');
					
					$em=$this->getDoctrine()->getManager();
					$em->persist($user);
					$em->flush();
					
				}
				return $this->redirect($this->generateURL('acanales_user_crearUsuario'));
			}
			
	     return $this->render("acanalesUserBundle:Default:crearUsuario.html.twig",array("form"=>$form->createView()));
	    }
		
	public function editarUsuarioAction($id){

      	$em = $this->getDoctrine()->getEntityManager();
		$user = $em->getRepository('acanalesUserBundle:User')->find($id);
		$form=$this->createForm(new UserEdit(), $user);

		$request = $this->getRequest();
			$form->handleRequest($request);

			if($request->getMethod() == 'POST')
			{
				if($form->isValid())
				{
					$rol = $form->get('roles')->getData();
					$user->setRoles($rol);

					
					$em=$this->getDoctrine()->getManager();
					$em->persist($user);
					$em->flush();
					
					
				}
				return $this->redirect($this->generateURL('acanales_user_gestionUsuarios'));
			}
			
	     return $this->render("acanalesUserBundle:Default:editarUsuario.html.twig",array("form"=>$form->createView()));
	    }
		
	public function gestionUsuariosAction(){

		$usuarios=array();		
		
		$usuarios = $this->getDoctrine()
        ->getRepository('acanalesUserBundle:User')
        ->findAll();

		return $this->render("acanalesUserBundle:Default:gestionUsuarios.html.twig",array("usuarios"=>$usuarios));
	}
}
