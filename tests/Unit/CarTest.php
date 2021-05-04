<?php

namespace Tests\Unit;

use App\Models\Car;
use PHPUnit\Framework\TestCase;

class CarTest extends TestCase
{
    public function testAMakeCanBeSet()
    {
        $car = new Car();

        $car->setMake('Jaguar');

        $this->assertSame('Jaguar', $car->getMake());
    }

    public function testAModelCanBeSet()
    {
        $car = new Car();
        $car->setModelName('XJR');

        $this->assertSame('XJR', $car->getModelName());
    }

    public function testABuildDateCanBeSet()
    {
        $buildDate = new \DateTime();

        $car = new Car();
        $car->setBuildDate($buildDate);

        $this->assertSame($buildDate->format('Y-m-d'), $car->getBuildDate()->format('Y-m-d'));
    }
}
