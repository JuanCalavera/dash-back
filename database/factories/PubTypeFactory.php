<?php

namespace Database\Factories;

use App\Models\Agency;
use App\Models\AgencySettings\PubType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PubType>
 */
class PubTypeFactory extends Factory
{
    protected $model = PubType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name  = $this->faker->name();

        return [
            'title' => $name,
            'question' => 'Que tipo de ' .  $name . '?',
            'agency_id'  => Agency::where('name', 'like', 'Dash')->first()->id,
        ];
    }
}
