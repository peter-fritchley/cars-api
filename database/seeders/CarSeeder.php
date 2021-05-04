<?php 

namespace Database\Seeders;

use App\Models\Colour;
use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $count = 10;
        while ($count-- > 0) {
            Car::factory()
                ->for(Colour::query()->inRandomOrder()->first())
                ->create();
        }
        
    }
}