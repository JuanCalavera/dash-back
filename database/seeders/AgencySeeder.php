<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\AgencySettings\BudgetType;
use App\Models\AgencySettings\PubSubType;
use App\Models\AgencySettings\PubType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agency = Agency::create([
            'logo_path' => '',
            'theme_path' => '',
            'icon_path' => '',
            'name' => 'Dash'
        ]);

        BudgetType::factory()->create();

        $pubTypes = [
            'Anuncio em jornal', 'Anuncio legal', 'Anuncio revista', 'App', 'Arte gráfica',
            'Branding', 'Campanha', 'Desenho', 'Marketing Político', 'Mídia em veículos'
        ];

        PubType::factory()
            ->count(sizeof($pubTypes))
            ->has(PubSubType::factory()->count(5), 'subTypes')
            ->sequence(fn ($sequence) => [
                'title' => $pubTypes[$sequence->index],
                'question' => 'Que tipo de ' .  $pubTypes[$sequence->index] . '?'
            ])
            ->create();

        // $drawTypes = [
        //     'Charge', 'Ilustração', 'Mascote', 'Quadrinhos', 'Storyboard(por quadro)'
        // ];

        // PubSubType::factory()
        //     ->count(sizeof($drawTypes))
        //     ->sequence(fn ($sequence) => ['title' => $drawTypes[$sequence->index]])
        //     ->create();

        $user = new User([
            'cnpj' => '44.536.219/0001-85',
            'name' => 'test',
            'password' => Hash::make('12345678')
        ]);

        $user->agency_id = $agency->id;
        $user->save();
    }
}
