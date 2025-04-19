<?php

namespace Database\Seeders;

use App\Models\ClassGroup;
use App\Models\School;
use Illuminate\Database\Seeder;

class ClassGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing records first
        ClassGroup::query()->delete();

        $school = School::first();

        $grades = [
            ['id' => 1, 'name' => 'Administrative', 'school_id' => $school->id],
            ['id' => 2, 'name' => 'Kindergarten', 'school_id' => $school->id],
            ['id' => 3, 'name' => 'Grade 1', 'school_id' => $school->id],
            ['id' => 4, 'name' => 'Grade 2', 'school_id' => $school->id],
            ['id' => 5, 'name' => 'Grade 3', 'school_id' => $school->id],
            ['id' => 6, 'name' => 'Grade 4', 'school_id' => $school->id],
            ['id' => 7, 'name' => 'Grade 5', 'school_id' => $school->id],
            ['id' => 8, 'name' => 'Grade 6', 'school_id' => $school->id],
        ];

        foreach ($grades as $grade) {
            ClassGroup::create($grade);
        }
    }
}
