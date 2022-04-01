<?php

namespace Database\Seeders;

use App\Models\Agency;
use App\Models\AgencySettings\BudgetType;
use App\Models\AgencySettings\DrawType;
use App\Models\AgencySettings\Theme;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::beginTransaction();

        try {
            $agency = Agency::create([
                'logo_path' => '',
                'theme_path' => '',
                'icon_path' => ''
            ]);

            $budgetType = new BudgetType(['title' => 'Tipo de orçamento']);
            $budgetType->agency_id = $agency->id;
            $budgetType->save();

            $themes = [
                'Anuncio em jornal', 'Anuncio legal', 'Anuncio revista', 'App', 'Arte gráfica',
                'Branding', 'Campanha', 'Desenho', 'Marketing Político', 'Mídia em veículos'
            ];

            foreach ($themes as $themeTitle) {
                $theme = new Theme(['title' => $themeTitle]);
                $theme->agency_id = $agency->id;
                $theme->save();
            }

            $drawTypes = [
                'charge', 'Ilustração', 'Mascote', 'Quadrinhos', 'Storyboard(por quadro)'
            ];

            foreach ($drawTypes as $type) {
                $drawType = new DrawType(['title' => $type]);
                $drawType->agency_id = $agency->id;
                $drawType->save();
            }

            $user = new User([
                'cnpj' => '44.536.219/0001-85',
                'name' => 'test',
                'password' => Hash::make('12345678')
            ]);
            $user->agency_id = $agency->id;
            $user->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
