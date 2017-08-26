<?php

namespace PicoPlaca\Test;

use PHPUnit\Framework\TestCase;
use PicoPlaca\Vehicle\Car;

/**
 * Class TestHelloWorld
 * @package PicoPlaca\Test
 */
class TestCar extends TestCase
{
    /**
     * @return Car
     */
    public function getNewInstanceCar()
    {
        // New instance Car.
        $Car = new Car();
        // Setting string placa random.
        $Car->setPlaca($this->providerGeneratePlaca()[0][0]);

        return $Car;
    }

    /**
     * @return array
     */
    public function providerGeneratePlaca()
    {
        $placas = [];

        // Generate 4 string for test.
        for ($p = 0; $p <= 4; $p++) {
            // Parts of the placa.
            $string = '';
            $number = rand(100, 9999);

            // Cacharaters availables for second part placa.
            $characters = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
            $size = rand(3, 4);

            // Generate caracters random.
            for ($i = 0; $i < $size; $i++) {
                $string .= $characters[rand(0, count($characters) - 1)];
            }

            // Concat Values and insert the placa on the matriz.
            $placas[] = [$string . '-' . $number];
        }

        return $placas;
    }

    public function testPlacaIsString()
    {
        $Car = $this->getNewInstanceCar();

        $this->assertTrue(is_string($Car->getPlaca()));
    }

    /**
     * @dataProvider providerGeneratePlaca
     */
    public function testValidateRegex($randomPlaca)
    {
        $Car = $this->getNewInstanceCar();

        $this->assertRegExp($Car->getRegexPlaca(), $randomPlaca);
    }

    public function testValidatePlaca()
    {
        $Car = $this->getNewInstanceCar();

        $this->assertTrue($Car->validatePlaca());
    }
}