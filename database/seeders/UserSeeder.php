<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Clear existing users (be cautious in production)
        DB::table('users')->delete();

        // Create super admin
        $superAdmin = User::firstOrCreate([
            'id'                => 1,
            'name'              => 'Sok Sopha',
            'email'             => 'super@tamat.edu.kh',
            'password'          => Hash::make('password'),
            'school_id'         => 1,
            'address'           => 'super admin street',
            'birthday'          => '2000-04-22',
            'nationality'       => 'Khmer',
            'state'             => 'Banteay Meanchey',
            'city'              => 'Poipet',
            'email_verified_at' => now(),
            'gender'            => 'Female',
            'blood_group'       => 'O+',
        ]);

        $superAdmin->assignRole('super-admin');
        $superAdmin->save();

        // Create admin
        $admin = User::firstOrCreate([
            'id'                => 2,
            'name'              => 'Hor Lyhour',
            'email'             => 'admin@tamat.edu.kh',
            'password'          => Hash::make('password'),
            'school_id'         => 1,
            'address'           => 'admin street',
            'birthday'          => '1998-04-22',
            'nationality'       => 'Khmer',
            'state'             => 'Banteay Meanchey',
            'city'              => 'Serei Saophoan',
            'email_verified_at' => now(),
            'gender'            => 'Male',
            'blood_group'       => 'O+',
        ]);

        $admin->assignRole('admin');

        // Create 9 teachers (4 male, 5 female)
        $teachers = [
            // Male teachers
            [
                'name' => 'Bora Hem',
                'email' => 'bora.hem@tamat.edu.kh',
                'gender' => 'Male',
                'blood_group' => 'O+',
            ],
            [
                'name' => 'Sopheap Kim',
                'email' => 'sopheap.kim@tamat.edu.kh',
                'gender' => 'Male',
                'blood_group' => 'O+',
            ],
            [
                'name' => 'Visal Meas',
                'email' => 'visal.meas@tamat.edu.kh',
                'gender' => 'Male',
                'blood_group' => 'O+',
            ],
            [
                'name' => 'Ratanak Prak',
                'email' => 'ratanak.prak@tamat.edu.kh',
                'gender' => 'Male',
                'blood_group' => 'O+',
            ],
            // Female teachers
            [
                'name' => 'Chanthy Sok',
                'email' => 'chanthy.sok@tamat.edu.kh',
                'gender' => 'Female',
                'blood_group' => 'O+',
            ],
            [
                'name' => 'Bopha Chheang',
                'email' => 'bopha.chheang@tamat.edu.kh',
                'gender' => 'Female',
                'blood_group' => 'O+',
            ],
            [
                'name' => 'Kunthea Ly',
                'email' => 'kunthea.ly@tamat.edu.kh',
                'gender' => 'Female',
                'blood_group' => 'O+',
            ],
            [
                'name' => 'Srey Neang',
                'email' => 'srey.neang@tamat.edu.kh',
                'gender' => 'Female',
                'blood_group' => 'O+',
            ],
            [
                'name' => 'Sophea Pich',
                'email' => 'sophea.pich@tamat.edu.kh',
                'gender' => 'Female',
                'blood_group' => 'O+',
            ],
        ];

        $faker = Faker::create();

        foreach ($teachers as $teacherData) {
            // Use firstOrCreate to avoid duplicate entries
            $user = User::firstOrCreate(
                ['email' => $teacherData['email']],
                [
                    'name' => $teacherData['name'],
                    'password' => Hash::make('password'),
                    'school_id' => 1,
                    'address' => 'Cambodia, Banteay Meanchey',
                    'birthday' => $faker->date('Y-m-d', '-30 years'),
                    'nationality' => 'Khmer',
                    'state' => 'Banteay Meanchey',
                    'city' => $faker->randomElement(['Poipet', 'Serei Saophoan', 'Svay Chek']),
                    'email_verified_at' => now(),
                    'gender' => $teacherData['gender'],
                    'blood_group' => $teacherData['blood_group'], // Include blood_group
                    'phone' => '0' . $faker->numberBetween(10, 99) . ' ' . $faker->numberBetween(100, 999) . ' ' . $faker->numberBetween(100, 999),
                ]
            );

            $user->assignRole('teacher');

            // Create teacher record if it doesn't exist
            $user->teacherRecord()->firstOrCreate(
                ['user_id' => $user->id]
            );
        }

        $this->command->info('Users seeded successfully.');
    }
}