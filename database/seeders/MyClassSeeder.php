<?php

namespace Database\Seeders;

use App\Models\ClassGroup;
use App\Models\MyClass;
use Illuminate\Database\Seeder;

class MyClassSeeder extends Seeder
{
    public function run()
    {
        // Clear existing classes first
        MyClass::query()->delete();
        
        // Define the 10 classes with explicit IDs
        $classes = [
            // Regular classrooms for educational purposes (7)
            ['id' => 1, 'name' => 'Kindergarten', 'class_group_id' => 2], // Kindergarten
            ['id' => 2, 'name' => 'Class1', 'class_group_id' => 3], // Grade 1
            ['id' => 3, 'name' => 'Class2', 'class_group_id' => 4], // Grade 2
            ['id' => 4, 'name' => 'Class3', 'class_group_id' => 5], // Grade 3
            ['id' => 5, 'name' => 'Class4', 'class_group_id' => 6], // Grade 4
            ['id' => 6, 'name' => 'Class5', 'class_group_id' => 7], // Grade 5
            ['id' => 7, 'name' => 'Class6', 'class_group_id' => 8], // Grade 6
            
            // Administrative and support spaces (3)
            ['id' => 8, 'name' => 'Office1', 'class_group_id' => 1], // Administrative
            ['id' => 9, 'name' => 'Office2', 'class_group_id' => 1], // Administrative
            ['id' => 10, 'name' => 'Library', 'class_group_id' => 1], // Administrative
        ];
        
        // Insert all classes
        foreach ($classes as $class) {
            MyClass::create($class);
        }
    }
}