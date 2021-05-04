<?php

namespace Tests\Unit;

use App\Models\Colour;
use PHPUnit\Framework\TestCase;

class ColourTest extends TestCase
{
    public function testANameCanBeSet()
    {
        $colour = new Colour();

        $colour->setName('red');

        $this->assertSame('red', $colour->getName());
    }
}
