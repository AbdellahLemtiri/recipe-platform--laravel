<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    public function run(): void 
    {
        $categories = [
            ['name' => 'Tajines & Plats Mijotés 🥘', 'created_at' => Carbon::now()],
            ['name' => 'Couscous & Tradition 🏺', 'created_at' => Carbon::now()],
            ['name' => 'Entrées & Salades 🥗', 'created_at' => Carbon::now()],
            ['name' => 'Pâtisserie Marocaine 🥟', 'created_at' => Carbon::now()],
            ['name' => 'Boissons & Thés 🍵', 'created_at' => Carbon::now()],
            ['name' => 'Boulangerie (Msemen/Harcha) 🥖', 'created_at' => Carbon::now()],
            ['name' => 'Plats Express ⚡', 'created_at' => Carbon::now()],
        ];
        DB::table('categories')->insert($categories);
    }
}