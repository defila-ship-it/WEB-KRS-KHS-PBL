<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            ['code' => 'IF101', 'name' => 'Pemrograman Web Lanjut', 'credits' => 3, 'study_program' => 'Sistem Informasi', 'semester' => 6, 'lecturer' => 'Dr. Ahmad, M.Kom', 'schedule' => 'Senin 08:00-10:30', 'room' => 'Lab 301'],
            ['code' => 'IF102', 'name' => 'Basis Data Terdistribusi', 'credits' => 3, 'study_program' => 'Sistem Informasi', 'semester' => 6, 'lecturer' => 'Rina Susanti, S.Kom, M.T', 'schedule' => 'Selasa 10:00-12:30', 'room' => 'Lab 302'],
            ['code' => 'IF103', 'name' => 'Jaringan Komputer', 'credits' => 2, 'study_program' => 'Sistem Informasi', 'semester' => 6, 'lecturer' => 'Budi Setiawan, M.T', 'schedule' => 'Rabu 13:00-15:30', 'room' => 'Lab 303'],
            ['code' => 'IF104', 'name' => 'Rekayasa Perangkat Lunak', 'credits' => 3, 'study_program' => 'Sistem Informasi', 'semester' => 6, 'lecturer' => 'Dr. Citra Dewi, M.Sc', 'schedule' => 'Kamis 08:00-10:30', 'room' => 'Ruang 201'],
            ['code' => 'IF105', 'name' => 'Manajemen Proyek TI', 'credits' => 2, 'study_program' => 'Sistem Informasi', 'semester' => 6, 'lecturer' => 'Eko Prasetyo, M.Kom', 'schedule' => 'Jumat 10:00-12:30', 'room' => 'Ruang 202'],
            ['code' => 'TI201', 'name' => 'Algoritma dan Struktur Data', 'credits' => 3, 'study_program' => 'Teknik Informatika', 'semester' => 4, 'lecturer' => 'Dr. Fitriani, S.Si, M.Kom', 'schedule' => 'Senin 13:00-15:30', 'room' => 'Lab 101'],
            ['code' => 'TI202', 'name' => 'Pemrograman Mobile', 'credits' => 3, 'study_program' => 'Teknik Informatika', 'semester' => 4, 'lecturer' => 'Andi Saputra, S.Kom', 'schedule' => 'Selasa 08:00-10:30', 'room' => 'Lab 102'],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}