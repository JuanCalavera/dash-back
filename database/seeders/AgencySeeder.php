<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\AgencySettings\BudgetType;
use App\Models\AgencySettings\DrawType;
use App\Models\AgencySettings\Theme;
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

        $themes = [
            'Anuncio em jornal', 'Anuncio legal', 'Anuncio revista', 'App', 'Arte gráfica',
            'Branding', 'Campanha', 'Desenho', 'Marketing Político', 'Mídia em veículos'
        ];

        Theme::factory()
            ->count(sizeof($themes))
            ->sequence(fn ($sequence) => ['title' => $themes[$sequence->index]])
            ->create();

        $drawTypes = [
            'Charge', 'Ilustração', 'Mascote', 'Quadrinhos', 'Storyboard(por quadro)'
        ];

        DrawType::factory()
            ->count(sizeof($drawTypes))
            ->sequence(fn ($sequence) => ['title' => $drawTypes[$sequence->index]])
            ->create();

        $user = new User([
            'cnpj' => '44.536.219/0001-85',
            'name' => 'test',
            'password' => Hash::make('12345678')
        ]);

        $user->agency_id = $agency->id;
        $user->save();
    }
}
