<?php

namespace Database\Seeders;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswaData = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@repschool.test',
                'nis' => '1234567890',
                'kelas' => 'XII-RPL-1',
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti@repschool.test',
                'nis' => '1234567891',
                'kelas' => 'XII-RPL-2',
            ],
        ];

        foreach ($siswaData as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('siswa123'),
                    'role' => 'siswa',
                ]
            );

            Siswa::firstOrCreate(
                ['nis' => $data['nis']],
                [
                    'user_id' => $user->id,
                    'kelas' => $data['kelas'],
                ]
            );
        }
    }
}
