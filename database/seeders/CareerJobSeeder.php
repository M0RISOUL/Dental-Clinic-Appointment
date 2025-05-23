<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CareerJob;
class CareerJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CareerJob::create([
            'title' => 'Dentist',
            'salary' => 80000,
            'workexperience' => '3',
            'vacancy' => 2,
            'description' => 'Provide dental care, diagnose oral conditions, and perform dental procedures.',
        ]);

        CareerJob::create([
            'title' => 'Dental Assistant',
            'salary' => 30000,
            'workexperience' => '1',
            'vacancy' => 3,
            'description' => 'Assist dentists during procedures and manage patient care.',
        ]);
        
        CareerJob::create([
            'title' => 'Dental Hygienist',
            'salary' => 35000,
            'workexperience' => '2',
            'vacancy' => 2,
            'description' => 'Perform teeth cleaning, oral health checks, and patient education.',
        ]);
        
        CareerJob::create([
            'title' => 'Front Desk Officer',
            'salary' => 25000,
            'workexperience' => '1',
            'vacancy' => 2,
            'description' => 'Handle patient scheduling, records, and clinic inquiries.',
        ]);
        
        CareerJob::create([
            'title' => 'Clinic Manager',
            'salary' => 50000,
            'workexperience' => '3',
            'vacancy' => 1,
            'description' => 'Oversee daily clinic operations, staff management, and inventory.',
        ]);
        
        CareerJob::create([
            'title' => 'Orthodontist',
            'salary' => 90000,
            'workexperience' => '4',
            'vacancy' => 1,
            'description' => 'Specialize in diagnosing and correcting dental alignment issues.',
        ]);
        
        CareerJob::create([
            'title' => 'Dental Technician',
            'salary' => 40000,
            'workexperience' => '2',
            'vacancy' => 2,
            'description' => 'Create dental prosthetics like crowns, bridges, and dentures.',
        ]);
        
        CareerJob::create([
            'title' => 'Dental Receptionist',
            'salary' => 23000,
            'workexperience' => '1',
            'vacancy' => 2,
            'description' => 'Manage patient appointments, calls, and front desk operations.',
        ]);

    }
}

