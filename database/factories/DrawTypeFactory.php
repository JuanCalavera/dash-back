<?php

namespace Database\Factories;

use App\Models\Agency;
use App\Models\AgencySettings\DrawType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DrawType>
 */
class DrawTypeFactory extends Factory
{
    protected $model = DrawType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => 'Tipo de desenho ' . random_int(0, 10),
            'agency_id'  => Agency::where('name', 'like', 'Dash')->first()->id,
        ];
    }
}
