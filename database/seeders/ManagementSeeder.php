<?php

namespace Database\Seeders;

use App\Models\ManagementMember;
use Illuminate\Database\Seeder;

class ManagementSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            ['nama' => 'Prof. Dr. Ardianto',           'jabatan' => 'Komisaris Utama',                          'urutan' => 1],
            ['nama' => 'Prof. Dr. Koko Srimulyo',      'jabatan' => 'Komisaris',                                'urutan' => 2],
            ['nama' => 'Edho Prasetyo Harnanto',       'jabatan' => 'Komisaris',                                'urutan' => 3],
            ['nama' => 'Heri Suprijanto',               'jabatan' => 'Direktur Utama',                           'urutan' => 4],
            ['nama' => 'Arif Fatchurahman',             'jabatan' => 'Direktur Keuangan & SDM',                  'urutan' => 5],
            ['nama' => 'Hendro Yudi Harianto',          'jabatan' => 'Direktur Operasional & Pemasaran',         'urutan' => 6],
        ];

        foreach ($members as $m) {
            ManagementMember::create(array_merge($m, ['is_active' => true]));
        }
    }
}
