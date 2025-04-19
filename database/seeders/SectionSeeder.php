<?php

namespace Database\Seeders;

use App\Models\MyClass;
use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    public function run()
    {
        // Clear existing sections first
        Section::query()->delete();
        
        // Create sections for each class (excluding admin spaces)
        $classes = MyClass::whereNotIn('name', ['Office1', 'Office2', 'Library'])->get();
        
        $id = 1; // Start ID counter
        $sections = [];
        
        foreach ($classes as $class) {
            // Create Section A and B for each class
            $sections[] = [
                'id' => $id++,
                'name' => 'A',
                'my_class_id' => $class->id,
            ];
            
            $sections[] = [
                'id' => $id++,
                'name' => 'B',
                'my_class_id' => $class->id,
            ];
        }
        
        // Insert all sections
        foreach ($sections as $section) {
            Section::create($section);
        }
    }
}