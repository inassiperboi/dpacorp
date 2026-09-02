<?php

namespace Database\Seeders;

use App\Models\CompanyProfile;
use App\Models\SeoSetting;
use Illuminate\Database\Seeder;

class CompanyProfileSeeder extends Seeder
{
    public function run(): void
    {
        CompanyProfile::create([
            'nama_resmi'      => 'PT Dharma Putra Airlangga',
            'nama_singkat'    => 'DPA Corp',
            'tagline'         => 'Membangun Ekosistem Bisnis Berbasis Inovasi dan Riset Universitas Airlangga',
            'alamat'          => 'Jl. Dr. Soetomo No.59-61',
            'kota'            => 'Surabaya',
            'provinsi'        => 'Jawa Timur',
            'kode_pos'        => '60264',
            'telepon'         => '082233117485',
            'whatsapp'        => '08212998898',
            'email'           => 'marketing@dpacorp.id',
            'jam_operasional' => 'Senin – Jumat: 08.00 – 17.00 WIB',
            'lat'             => -7.261553,
            'lng'             => 112.740793,
            'instagram'       => '@dpa.corp',
            'tiktok'          => '@dpa.corp',
        ]);

        SeoSetting::create([
            'default_meta_title'       => 'PT Dharma Putra Airlangga (DPA Corp)',
            'default_meta_description' => 'DPA Corp adalah holding company milik Universitas Airlangga yang mengelola anak perusahaan di bidang perjalanan, bioproduct, konsultasi, dan properti. Berlokasi di Surabaya, Jawa Timur.',
        ]);
    }
}
