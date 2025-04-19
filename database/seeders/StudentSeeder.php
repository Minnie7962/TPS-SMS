<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\School;
use App\Models\Section;
use App\Models\MyClass;
use App\Models\ClassGroup;
use App\Models\StudentRecord;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    private array $maleFirstNames = ['Chea', 'Dara', 'Kosal', 'Rotha', 'Sopheak', 'Visal', 'Veasna', 'Bunrong', 'Bora', 'Sokha'];
    private array $femaleFirstNames = ['Bopha', 'Chantrea', 'Kunthea', 'Mony', 'Sokha', 'Srey', 'Theary', 'Phally', 'Rothana', 'Chanry'];
    private array $lastNames = ['Sok', 'Chhay', 'Kim', 'Meas', 'Prak', 'Sun', 'Tep', 'Vann', 'Yong', 'Rith'];

    public function run()
    {
        // Soft cleanup without truncating the entire users table
        DB::beginTransaction();
        try {
            // Delete existing student records
            StudentRecord::query()->delete();

            // Delete users with student role
            User::whereHas('roles', function ($query) {
                $query->where('name', 'student');
            })->delete();
            
            $school = School::first();
            if (!$school) {
                $this->command->error("No school found. Please seed the schools table first.");
                return;
            }

            $classGroups = ClassGroup::all();
            $classes = MyClass::whereNotIn('name', ['Office1', 'Office2', 'Library'])->get();
            $sections = Section::all();

            if ($classGroups->isEmpty()) {
                $this->command->error("No class groups found. Please seed the class_groups table first.");
                return;
            }

            if ($classes->isEmpty()) {
                $this->command->error("No classes found. Please seed the my_classes table first.");
                return;
            }

            if ($sections->isEmpty()) {
                $this->command->error("No sections found. Please seed the sections table first.");
                return;
            }

            $genders = ['Male', 'Female'];
            $phonePrefixes = ['012', '015', '077', '078', '089', '092', '097'];
            $bloodGroups = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];

            $locations = [
                'Poipet, Cambodia',
                'Siem Reap, Cambodia',
                'Battambang, Cambodia',
                'Banteay Meanchey, Cambodia',
                'Kampong Cham, Cambodia',
                'Kampot, Cambodia',
                'Sihanoukville, Cambodia'
            ];

            $classDistribution = [
                'Kindergarten' => 35,
                'Grade 1' => 40,
                'Grade 2' => 40,
                'Grade 3' => 35,
                'Grade 4' => 35,
                'Grade 5' => 35,
                'Grade 6' => 30,
            ];

            $studentCount = 0;

            foreach ($classDistribution as $classGroupName => $count) {
                $classGroup = ClassGroup::where('name', $classGroupName)->first();
                if (!$classGroup) {
                    $this->command->error("Class group '$classGroupName' not found.");
                    continue;
                }

                $classesInGroup = MyClass::where('class_group_id', $classGroup->id)
                    ->whereNotIn('name', ['Office1', 'Office2', 'Library'])
                    ->get();

                if ($classesInGroup->isEmpty()) {
                    $this->command->error("No classes found for class group '$classGroupName'.");
                    continue;
                }

                $maleCount = (int)($count / 2);
                $femaleCount = $count - $maleCount;

                for ($i = 0; $i < $maleCount; $i++) {
                    $this->createStudent(
                        $school, $classGroup, $classesInGroup->random(), $sections->random(),
                        'Male', $this->maleFirstNames[array_rand($this->maleFirstNames)], 
                        $this->lastNames[array_rand($this->lastNames)], $phonePrefixes,
                        $studentCount++, $locations, $bloodGroups
                    );
                }

                for ($i = 0; $i < $femaleCount; $i++) {
                    $this->createStudent(
                        $school, $classGroup, $classesInGroup->random(), $sections->random(),
                        'Female', $this->femaleFirstNames[array_rand($this->femaleFirstNames)], 
                        $this->lastNames[array_rand($this->lastNames)], $phonePrefixes,
                        $studentCount++, $locations, $bloodGroups
                    );
                }
            }

            DB::commit();
            $this->command->info("250 student records seeded successfully.");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error("Seeding failed: " . $e->getMessage());
        }
    }

    private function createStudent($school, $classGroup, $class, $section, $gender, $firstName, $lastName, $phonePrefixes, $index, $locations, $bloodGroups)
    {
        $fullName = "$firstName $lastName";
        $email = strtolower($firstName . '.' . $lastName . Str::random(3) . '@student.tamat.edu.kh');

        $ageOffset = strpos($classGroup->name, 'Kindergarten') !== false ? 6 : (6 + (int)filter_var($classGroup->name, FILTER_SANITIZE_NUMBER_INT));
        $birthDate = Carbon::now()->subYears($ageOffset)->subMonths(rand(0, 11))->subDays(rand(0, 30))->format('Y-m-d');

        $contactNumber = $phonePrefixes[array_rand($phonePrefixes)] . rand(100000, 999999);

        // First check if this email already exists
        $existingUser = User::where('email', $email)->first();
        if ($existingUser) {
            // Generate a new unique email
            $email = strtolower($firstName . '.' . $lastName . Str::random(5) . '@student.tamat.edu.kh');
        }

        $user = User::create([
            'name' => $fullName,
            'email' => $email,
            'password' => Hash::make('password'),
            'school_id' => $school->id,
            'address' => $locations[array_rand($locations)],
            'birthday' => $birthDate,
            'nationality' => 'Khmer',
            'state' => 'Banteay Meanchey',
            'city' => 'Svay Chek',
            'email_verified_at' => now(),
            'gender' => $gender,
            'phone' => $contactNumber,
            'blood_group' => $bloodGroups[array_rand($bloodGroups)], // Added blood_group field
        ]);

        $user->assignRole('student');

        $parentFirstNames = ['Sarith', 'Sok', 'Chan', 'Phan', 'Rath', 'Sokheng', 'Veasna', 'Bopha', 'Srey', 'Theary'];
        $parentLastNames = ['Dara', 'Sok', 'Kim', 'Meas', 'Prak', 'Sun', 'Tep', 'Vann', 'Yong', 'Rith'];

        $fatherFullName = $parentFirstNames[array_rand($parentFirstNames)] . ' ' . $parentLastNames[array_rand($parentLastNames)];
        $fatherPhone = $phonePrefixes[array_rand($phonePrefixes)] . rand(100000, 999999);
        $fatherAddress = $locations[array_rand($locations)];

        $motherFullName = $parentFirstNames[array_rand($parentFirstNames)] . ' ' . $parentLastNames[array_rand($parentLastNames)];
        $motherPhone = $phonePrefixes[array_rand($phonePrefixes)] . rand(100000, 999999);
        $motherAddress = $locations[array_rand($locations)];

        $emergencyContactName = $parentFirstNames[array_rand($parentFirstNames)] . ' ' . $parentLastNames[array_rand($parentLastNames)];
        $emergencyContactNumber = $phonePrefixes[array_rand($phonePrefixes)] . rand(100000, 999999);
        $emergencyContactAddress = $locations[array_rand($locations)];

        StudentRecord::create([
            'user_id' => $user->id,
            'admission_number' => 'TPS' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
            'admission_date' => Carbon::createFromDate(Carbon::parse($birthDate)->year + 6, 9, rand(1, 15))->format('Y-m-d'),
            'my_class_id' => $class->id,
            'section_id' => $section->id,
            'is_graduated' => false,
            'father_full_name' => $fatherFullName,
            'father_phone_number' => $fatherPhone,
            'father_address' => $fatherAddress,
            'mother_full_name' => $motherFullName,
            'mother_phone_number' => $motherPhone,
            'mother_address' => $motherAddress,
            'emergency_contact_name' => $emergencyContactName,
            'emergency_contact_number' => $emergencyContactNumber,
            'emergency_contact_address' => $emergencyContactAddress,
            'emergency_contact_relationship' => 'Family',
        ]);
    }
}