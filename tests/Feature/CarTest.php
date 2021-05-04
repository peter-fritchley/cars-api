<?php

namespace Tests\Feature;

use App\Models\Car;
use Tests\TestCase;
use App\Models\Colour;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CarTest extends TestCase
{
    use RefreshDatabase;

    protected static $carStructure = [
        'id',
        'make',
        'model',
        'build_date',
        'colour' => [
            'id',
            'name'
        ]
    ];

    protected function setUp(): void
    {
        parent::setUp();

        // Disable debug output so that we 
        // get the real response.
        config('app.debug', false);
    }

    public function testCarsCanBeListed()
    {
        $colour = (new Colour())
            ->setName('blue');

        $colour->save();

        // Create some cars to list.
        Car::factory()
            ->count(5)
            ->for($colour)
            ->create();
        
        $response = $this->json('GET', '/cars');

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
        $response->assertJsonStructure([
            'data' => [
                '*' => static::$carStructure
            ],
            'links',
            'meta'
        ]);
    }

    public function testACarCanBeCreated()
    {
        $colour = (new Colour())
            ->setName('green');

        $colour->save();


        $response = $this->json('POST', '/cars', [
            'make' => 'Test Car Make',
            'model' => 'Test Car Model',
            'build_date' => '2021-01-01',
            'colour_id' => $colour->getId()
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure(static::$carStructure);

        $response->assertJson([
            'make' => 'Test Car Make',
            'model' => 'Test Car Model',
            'build_date' => '2021-01-01',
            'colour' => [
                'id' => $colour->getId(),
                'name' => $colour->getName()
            ]
        ]);
    }

    public function testACarCanBeRetrieved()
    {
        $colour = (new Colour())
            ->setName('green');

        $colour->save();

        $car = Car::factory()
            ->for($colour)
            ->create();
        
        $response = $this->json('GET', sprintf('/car/%d', $car->getId()));
        
        $response->assertStatus(200);
        $response->assertJsonStructure(static::$carStructure);
        $response->assertJson([
            'make' => $car->getMake(),
            'model' => $car->getModelName(),
            'build_date' => $car->getBuildDate()->format('Y-m-d'),
            'colour' => [
                'id' => $colour->getId(),
                'name' => $colour->getName()
            ]
        ]);
    }

    public function testACarCanBeDeleted()
    {
        $colour = (new Colour())
            ->setName('black');

        $colour->save();

        $car = Car::factory()
            ->for($colour)
            ->create();

        $response = $this->delete(sprintf('/car/%d', $car->getId()));

        $response->assertStatus(204);

        $deletedCar = Car::query()
            ->where('id', '=', $car->getId())
            ->first();

        $this->assertNull($deletedCar);
    }

    public function testRetrievingANoneExistingCarReturnsCorrectResponse()
    {
        $response = $this->withExceptionHandling()
            ->json('GET', sprintf('/car/%d', 9999));

        $response->assertStatus(404);
        $response->assertJson([
            'message' => 'Car not found'
        ]);
    }

    public function testACarBuiltOver4YearsAgoCannotBeCreated()
    {
        $colour = (new Colour())
            ->setName('purple');

        $colour->save();

        $fourYearsAgo = new \DateTime('-4 Years');

        $response = $this->json('POST', '/cars', [
            'make' => 'Test Car Make',
            'model' => 'Test Car Model',
            'build_date' => $fourYearsAgo->format('Y-m-d'),
            'colour_id' => $colour->getId()
        ]);

        $response->assertStatus(422);

        $response->assertJson([
            'message' => 'The given data was invalid.'
        ]);

        $response->assertJsonValidationErrors([
            'build_date'
        ]);
    }
}
