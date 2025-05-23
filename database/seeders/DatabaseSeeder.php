<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RunInProductionSeeder::class,
            SchoolSeeder::class,
            UserSeeder::class,          
            ClassGroupSeeder::class,
            MyClassSeeder::class,
            SectionSeeder::class,
            StudentSeeder::class,
            SubjectSeeder::class,
            AcademicYearSeeder::class,
            SemesterSeeder::class,
            PromotionSeeder::class,
            ExamSeeder::class,
            GradeSystemSeeder::class,
            ExamSlotSeeder::class,
            ExamRecordSeeder::class,
        ]);
    }
}
