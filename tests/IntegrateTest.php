<?php

namespace Tohmua\IntegrationGate;

use Tohmua\IntegrationGate\Integrate;

class IntergrateTest extends \PHPUnit_Framework_TestCase
{
    public function testCantCreateInstance()
    {
        $this->setExpectedException('Exception');
        $this->assertInstanceOf('Tohmua\IntegrationGate\Integrate', new Integrate('Foo'));
    }
}