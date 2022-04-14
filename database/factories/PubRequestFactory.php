<?php

namespace Database\Factories;

use App\Models\Agency;
use App\Models\AgencySettings\DrawType;
use App\Models\AgencySettings\PubType;
use App\Models\PubRequest\PubRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PubRequest>
 */
class PubRequestFactory extends Factory
{
    protected $model = PubRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'deliver_date' => $this->faker->dateTimeBetween('now', '+1 years'),
            'size' => '1920x1080',
            'description' => $this->faker->text(),
            'agency_id' => Agency::where('name', 'like', 'Dash')->first()->id,
            'user_id'  => User::where('name', 'like', 'test')->first()->id,
            'pub_type_id' => PubType::all()->random(),
            'draw_type_id' => DrawType::all()->random(),
            'exhibition_description' => $this->faker->text(),
        ];
    }
}
