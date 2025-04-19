<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\ExamRecord;
use App\Models\ExamSlot;
use App\Models\Section;
use App\Models\StudentRecord;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;

class ExamRecordSeeder extends Seeder
{
    public function run()
    {
        // Get all published exams (past exams)
        $publishedExams = Exam::where('publish_result', true)->get();
        
        foreach ($publishedExams as $exam) {
            $examSlots = ExamSlot::where('exam_id', $exam->id)->get();
            
            // Get all students
            $students = User::role('student')->get();
            
            foreach ($examSlots as $examSlot) {
                // Extract subject name from the exam slot name
                $slotNameParts = explode(' - ', $examSlot->name);
                $subjectName = $slotNameParts[0];
                $className = isset($slotNameParts[1]) ? $slotNameParts[1] : null;
                
                if (!$className) {
                    continue;
                }
                
                // Find the subject
                $subject = Subject::where('name', $subjectName)
                    ->whereHas('myClass', function($query) use ($className) {
                        $query->where('name', $className);
                    })
                    ->first();
                
                if (!$subject) {
                    continue;
                }
                
                // Find the class
                $class = \App\Models\MyClass::where('name', $className)->first();
                
                if (!$class) {
                    continue;
                }
                
                // Get sections for this class
                $sections = Section::where('my_class_id', $class->id)->get();
                
                foreach ($sections as $section) {
                    // Get students for this section
                    $sectionStudents = StudentRecord::whereHas('user')
                        ->where('my_class_id', $class->id)
                        ->where('section_id', $section->id)
                        ->get();
                    
                    foreach ($sectionStudents as $studentRecord) {
                        // Generate a random mark between 0 and 10
                        $mark = rand(0, 10);
                        
                        // Create exam record
                        ExamRecord::create([
                            'user_id' => $studentRecord->user_id,
                            'exam_slot_id' => $examSlot->id,
                            'section_id' => $section->id,
                            'subject_id' => $subject->id,
                            'student_marks' => $mark,
                        ]);
                    }
                }
            }
        }
    }
}