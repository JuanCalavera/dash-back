<?php

namespace Database\Factories;

use App\Models\Agency;
use App\Models\AgencySettings\BudgetType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BudgetType>
 */
class BudgetTypeFactory extends Factory
{
    protected $model = BudgetType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => 'Tipo de orçamento ' . random_int(0, 10),
            'agency_id'  => Agency::where('name', 'like', 'Dash')->first()->id,
        ];
    }
}
