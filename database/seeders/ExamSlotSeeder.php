<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\ExamSlot;
use App\Models\Subject;
use App\Models\MyClass;
use Illuminate\Database\Seeder;

class ExamSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all exams
        $exams = Exam::all();

        foreach ($exams as $exam) {
            // Get all class groups
            $classGroups = MyClass::all();

            foreach ($classGroups as $class) {
                // Skip non-class entries like Office1, Office2, Library
                if (in_array($class->name, ['Office1', 'Office2', 'Library'])) {
                    continue;
                }

                // Get subjects for this class
                $subjects = Subject::where('my_class_id', $class->id)->get();

                foreach ($subjects as $subject) {
                    // Create exam slots for each subject
                    ExamSlot::create([
                        'name' => $subject->name . ' - ' . $class->name,
                        'description' => 'Exam slot for ' . $subject->name . ' in ' . $class->name,
                        'total_marks' => 10, // As specified, full score is 10
                        'exam_id' => $exam->id,
                    ]);
                }
            }
        }
    }
}