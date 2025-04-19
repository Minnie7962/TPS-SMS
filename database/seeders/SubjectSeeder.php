<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\MyClass;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        $school = School::first();
        
        // Define the subjects
        $subjectNames = [
            'Khmer',
            'Math',
            'Science',
            'Social',
            'English',
            'PE',
        ];
        
        // Define short names
        $shortNames = [
            'Khmer' => 'KHM',
            'Math' => 'MAT',
            'Science' => 'SCI',
            'Social' => 'SOC',
            'English' => 'ENG',
            'PE' => 'PE',
        ];
        
        // Get all classes except administrative spaces
        $classes = MyClass::whereNotIn('name', ['Office1', 'Office2', 'Library'])->get();
        
        // Create subjects for each class
        foreach ($classes as $class) {
            foreach ($subjectNames as $subjectName) {
                Subject::create([
                    'name' => $subjectName,
                    'short_name' => $shortNames[$subjectName],
                    'school_id' => $school->id,
                    'my_class_id' => $class->id,
                ]);
            }
        }
    }
}