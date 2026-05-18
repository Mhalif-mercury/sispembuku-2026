<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Buku::firstOrCreate([
            'judul' => 'Laravel is King',
            'isbn' => '08513321',
            'author_id' => 1,
            'kuantitas' => 5
        ]);
    }
}
