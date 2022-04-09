<?php

namespace Database\Factories;

use App\Models\Agency;
use App\Models\PubPiece\PubPiece;
use App\Models\PubRequest\PubRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PubPiece>
 */
class PubPieceFactory extends Factory
{
    protected $model = PubPiece::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'was_liked' => Arr::random([true, false, null]),
            'title' => 'Peça publicitária ' . random_int(0, 100),
            'description' => $this->faker->text(),
            'agency_id'  => Agency::where('name', 'like', 'Dash')->first()->id,
            'file_url' => Arr::random([
                'https://i0.wp.com/salifex.com/wp-content/uploads/2019/02/heinz_ketchup_2.jpg?fit=660%2C900&ssl=1',
                'https://images-na.ssl-images-amazon.com/images/I/61BqmYycZNL.jpg',
                'https://cdn5.vectorstock.com/i/1000x1000/12/59/coffee-to-go-advertisement-composition-vector-20771259.jpg'
            ]),
            'file_type' => 'image/jpg',
            'user_id' => User::where('name', 'like', 'test')->first()->id,
            'pub_request_id' => PubRequest::factory()
        ];
    }
}
