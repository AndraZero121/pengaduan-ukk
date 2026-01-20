<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            'Ruang Kelas',
            'Laboratorium',
            'Perpustakaan',
            'Toilet',
            'Lapangan',
            'Kantin',
            'Parkir',
            'Keamanan',
            'Listrik & Air',
            'Internet',
        ];

        foreach ($items as $nama) {
            Kategori::firstOrCreate(['ket_kategori' => $nama]);
        }
    }
}
