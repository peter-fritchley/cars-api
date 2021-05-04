<?php

namespace Database\Seeders;

use App\Models\Colour;
use Illuminate\Database\Seeder;

class ColourSeeder extends Seeder
{
    public function run()
    {
        foreach (['red', 'blue', 'white', 'black'] as $colourName) {
            $colour = (new Colour())
                ->setName($colourName);
            
            $colour->save();
        }
    }
}