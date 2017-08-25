<?php

namespace PicoPlaca\Test;

use PHPUnit\Framework\TestCase;
use PicoPlaca\HelloPicoPlaca;
use PicoPlaca\HelloWorld;

/**
 * Class TestHelloWorld
 * @package PicoPlaca\Test
 */
class TestPicoPlaca extends TestCase
{
    public function testPhpUnit()
    {
        // New instance HelloWorld.
        $HelloWorld = new HelloPicoPlaca();

        $this->assertEquals($HelloWorld->getHelloPicoPlaca(), 'Hello Pico-Placa!');
    }
}