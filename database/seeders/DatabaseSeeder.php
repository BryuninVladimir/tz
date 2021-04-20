<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->delete();

        Item::create(['name' => 'Sword', 'type' => 'weapon', 'weight'=> 5]);
        Item::create(['name' => 'Axe', 'type' => 'weapon', 'weight'=> 3]);
        Item::create(['name' => 'Bow', 'type' => 'weapon', 'weight'=> 3]);

        Item::create(['name' => 'Iron Helmet', 'type' => 'helmet', 'weight'=> 2]);
        Item::create(['name' => 'Steel Helmet', 'type' => 'helmet', 'weight'=> 2]);
        Item::create(['name' => 'Hat', 'type' => 'helmet', 'weight'=> 1]);

        Item::create(['name' => 'Iron breastplate', 'type' => 'chest', 'weight'=> 3]);
        Item::create(['name' => 'Steel breastplate', 'type' => 'chest', 'weight'=> 3]);
        Item::create(['name' => 'Cloth', 'type' => 'chest', 'weight'=> 1]);

        Item::create(['name' => 'Trash', 'type' => 'misc', 'weight'=> 1]);
        Item::create(['name' => 'Loot', 'type' => 'misc', 'weight'=> 1]);
        Item::create(['name' => 'Garbage', 'type' => 'misc', 'weight'=> 1]);
    }
}
