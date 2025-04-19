<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\School;
use App\Models\Semester;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $school = School::first();
        $currentAcademicYear = AcademicYear::find($school->academic_year_id);

        foreach (AcademicYear::all() as $academicYear) {
            $firstSemester = Semester::create([
                'name' => 'First Semester',
                'academic_year_id' => $academicYear->id,
                'school_id' => $school->id,
                'check_result' => $academicYear->id !== $currentAcademicYear->id,
            ]);

            $secondSemester = Semester::create([
                'name' => 'Second Semester',
                'academic_year_id' => $academicYear->id,
                'school_id' => $school->id,
                'check_result' => $academicYear->id !== $currentAcademicYear->id,
            ]);
        }

        $currentSemester = Semester::where('academic_year_id', $currentAcademicYear->id)
            ->where('name', 'First Semester')
            ->first();

        $school->semester_id = $currentSemester->id;
        $school->save();
    }
}
