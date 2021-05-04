<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCarRequest;
use App\Http\Resources\CarResource;
use App\Models\Car;
use App\Models\Colour;
use Illuminate\Http\JsonResponse;

class CarController extends Controller
{
    public function createAction(CreateCarRequest $request)
    {
        $colourId = $request->get('colour_id');

        $colour = Colour::query()->where('id', $colourId)
            ->first();

        $buildDate = \DateTime::createFromFormat('Y-m-d', $request->get('build_date'));
        
        $car = (new Car())
            ->setMake($request->get('make'))
            ->setModelName($request->get('model'))
            ->setBuildDate($buildDate)
            ->setColour($colour);

        $car->save();

        return new JsonResponse(new CarResource($car), 201);
    }

    public function listAction()
    {
        $cars = Car::query()->paginate();
        return CarResource::collection($cars);
    }

    /**
     * @param Car $car
     * @return JsonResponse
     */
    public function findAction(Car $car)
    {
        return new JsonResponse(new CarResource($car));
    }

    public function deleteAction(Car $car)
    {
        $car->delete();

        return new JsonResponse(null, 204);
    }
}