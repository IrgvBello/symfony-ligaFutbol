<?php

namespace acanales\equipoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'en/equipo/Real Madrid');

        $this->assertTrue($crawler->filter('html:contains("Name of team: Real Madrid")')->count() > 0);
    }
	
	public function testCrearEquipo()
    {		
		$client = static::createClient();
		$crawler = $client->request('GET', 'crear-equipo');
		
		$this->assertGreaterThan(0, $crawler->filter('h2')->count());
		
		$this->assertGreaterThan(0, $crawler->filter('.required')->count());
		
		$this->assertGreaterThan(2, $crawler->filter('input')->count());
		
		$form = $crawler->selectButton('Guardar')->form();

		// sustituye algunos valores
		$form['acanales_equipobundle_equipos[nombre]'] = 'Betis';
		$form['acanales_equipobundle_equipos[division]'] = 'primera';
		
		// envía el formulario
		$crawler = $client->submit($form);
		
	}
}
