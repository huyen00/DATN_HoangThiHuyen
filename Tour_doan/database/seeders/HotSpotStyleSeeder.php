<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Artisan;
use App\Models\CategoryHotspot;

class HotSpotStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $category = CategoryHotspot::create([
            'name' => 'skin_hotspotstyle',
            'description' => 'default',
        ]);

        $category = CategoryHotspot::create([
            'name' => 'skin_hotspotstyle_move',
            'description' => 'move',
        ]);

        $category = CategoryHotspot::create([
            'name' => 'skin_hotspotstyle_ani',
            'description' => 'circle animation',
        ]);

        $category = CategoryHotspot::create([
            'name' => 'hs_flycam',
            'description' => 'flycam',
        ]);

        $category = CategoryHotspot::create([
            'name' => 'hotspot_ide',
            'description' => 'ide',
        ]);
    }
}
