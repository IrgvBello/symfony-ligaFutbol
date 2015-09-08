<?php
namespace acanales\equipoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\core\SecurityContext;//Formulario login


class SecurityController extends Controller{
	public function loginAction(Request $request)
	{
		$authenticationUtils = $this->get('security.authentication_utils');
	
		// get the login error if there is one
		$error = $authenticationUtils->getLastAuthenticationError();
	
		// last username entered by the user
		$lastUsername = $authenticationUtils->getLastUsername();
	
		return $this->render(
			'acanalesequipoBundle:Default:login.html.twig',
			array(
				// last username entered by the user
				'last_username' => $lastUsername,
				'error'         => $error,
			)
		);
	}
}