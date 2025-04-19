<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        School::updateOrCreate(
            ['id' => 1],
            [
                'name'     => 'Tamat-Primary-School',
                'address'  => 'Svay Chek, Ta Baen, Phumi kamnab, Cambodia',
                'code'     => 'TPS-2005',
                'initials' => 'TPS',
            ]
        );
    }
}
