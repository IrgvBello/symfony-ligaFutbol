<?php
namespace acanales\pruebaBundle\Tests\Model;

use acanales\pruebaBundle\Model\Calcular;

class CalcularTest extends \PHPUnit_Framework_TestCase
{
    public function testSuma()
    {
        $calc = new Calcular();
        $result = $calc->suma(30, 12);

        $this->assertEquals(42, $result);
    }
}