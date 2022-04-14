<?php

namespace Database\Factories;

use App\Models\AgencySettings\PubSubType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PubSubType>
 */
class PubSubTypeFactory extends Factory
{
    protected $model = PubSubType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => 'Tipo ' . random_int(0, 15),
            // 'agency_id'  => Agency::where('name', 'like', 'Dash')->first()->id,
        ];
    }
}
