<?php

namespace Database\Seeders;

use App\Models\PubPiece\PubPiece;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PubPiecesForTestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PubPiece::factory()
            ->count(10)
            ->create();
    }
}
