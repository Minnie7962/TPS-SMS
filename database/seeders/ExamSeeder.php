<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\Exam;
use App\Models\ExamSlot;
use App\Models\School;
use App\Models\Semester;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    public function run()
    {
        $school = School::first();
        
        // Create exams for each semester of each academic year
        foreach (AcademicYear::all() as $academicYear) {
            $semesters = Semester::where('academic_year_id', $academicYear->id)->get();
            
            foreach ($semesters as $semester) {
                // Create mid-term and final exams for each semester
                $examTypes = [
                    [
                        'name' => 'Mid-term Examination',
                        'month_offset' => 2, // 2 months into semester
                    ],
                    [
                        'name' => 'Final Examination',
                        'month_offset' => 5, // 5 months into semester
                    ],
                ];
                
                foreach ($examTypes as $examType) {
                    // Calculate dates based on academic year
                    $yearStart = $academicYear->start_year;
                    
                    // First semester: September to January
                    // Second semester: February to June
                    $startMonth = ($semester->name === 'First Semester') ? 9 : 2;
                    $startMonth += $examType['month_offset'];
                    
                    // Adjust if month goes beyond December
                    $year = $yearStart;
                    if ($startMonth > 12) {
                        $startMonth -= 12;
                        $year += 1;
                    }
                    
                    $startDate = Carbon::createFromDate($year, $startMonth, 15);
                    $endDate = $startDate->copy()->addDays(10);
                    
                    // Create exam
                    $exam = Exam::create([
                        'name' => $examType['name'] . ' ' . $semester->name . ' ' . $academicYear->start_year . '-' . $academicYear->stop_year,
                        'description' => $examType['name'] . ' for ' . $semester->name . ' of Academic Year ' . $academicYear->start_year . '-' . $academicYear->stop_year,
                        'semester_id' => $semester->id,
                        'start_date' => $startDate->format('Y-m-d'),
                        'stop_date' => $endDate->format('Y-m-d'),
                        'active' => false,
                        'publish_result' => false,
                    ]);
                    
                    // Get all class groups to create exam slots for each subject by class
                    $classGroups = \App\Models\ClassGroup::all();
                    
                    foreach ($classGroups as $classGroup) {
                        // Get classes for this class group
                        $classes = \App\Models\MyClass::where('class_group_id', $classGroup->id)
                            ->whereNotIn('name', ['Office1', 'Office2', 'Library'])
                            ->get();
                            
                        foreach ($classes as $class) {
                            // Get subjects for this class
                            $subjects = Subject::where('my_class_id', $class->id)->get();
                            
                            foreach ($subjects as $subject) {
                                ExamSlot::create([
                                    'name' => $subject->name . ' - ' . $class->name,
                                    'description' => $examType['name'] . ' for ' . $subject->name . ' in ' . $class->name,
                                    'total_marks' => 10, // As specified, full score is 10
                                    'exam_id' => $exam->id,
                                ]);
                            }
                        }
                    }
                }
                
                // Activate and publish results for past exams
                if ($academicYear->id < $school->academic_year_id) {
                    Exam::where('semester_id', $semester->id)->update([
                        'active' => true,
                        'publish_result' => true,
                    ]);
                }
            }
        }
        
        // Activate current exams
        $currentSemester = Semester::find($school->semester_id);
        if ($currentSemester) {
            $latestExam = Exam::where('semester_id', $currentSemester->id)
                ->orderBy('id', 'desc')
                ->first();
                
            if ($latestExam) {
                $latestExam->active = true;
                $latestExam->save();
            }
        }
    }
}