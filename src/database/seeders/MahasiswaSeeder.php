<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::firstOrCreate([
            'nama' => 'Ilham Suparno',
            'nim' => '2024080302',
            'email' => 'ilham_suprno@gmail.com',
            'password' => '1234567810'
        ]);
    }
}
