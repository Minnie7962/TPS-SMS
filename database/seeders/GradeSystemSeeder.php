<?php

namespace Database\Seeders;

use App\Models\ClassGroup;
use App\Models\GradeSystem;
use Illuminate\Database\Seeder;

class GradeSystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all class groups
        $classGroups = ClassGroup::all();
        
        // Create the three grade classifications for each class group
        foreach ($classGroups as $classGroup) {
            // Very Good (8-10)
            GradeSystem::create([
                'name' => 'Very Good',
                'remark' => 'Excellent performance',
                'grade_from' => '8',
                'grade_till' => '10',
                'class_group_id' => $classGroup->id,
            ]);
            
            // Good (5-7.9)
            GradeSystem::create([
                'name' => 'Good',
                'remark' => 'Satisfactory performance',
                'grade_from' => '5',
                'grade_till' => '7.9',
                'class_group_id' => $classGroup->id,
            ]);
            
            // Not Good (0-4.9)
            GradeSystem::create([
                'name' => 'Not Good',
                'remark' => 'Needs improvement',
                'grade_from' => '0',
                'grade_till' => '4.9',
                'class_group_id' => $classGroup->id,
            ]);
        }
    }
}
