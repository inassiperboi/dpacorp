<?php

namespace Database\Seeders;

use App\Models\Subsidiary;
use App\Models\SubsidiaryService;
use Illuminate\Database\Seeder;

class SubsidiarySeeder extends Seeder
{
    public function run(): void
    {
        $subsidiaries = [
            [
                'data' => [
                    'nama'              => 'PT Airlangga Global Traveling',
                    'slug'              => 'airlangga-global-traveling',
                    'deskripsi_singkat' => 'Biro perjalanan wisata terpercaya milik DPA Corp yang menyediakan layanan tiket pesawat, paket wisata domestik & internasional, hotel, MICE, serta penyelenggaraan Umroh & Haji.',
                    'deskripsi_lengkap' => 'PT Airlangga Global Traveling adalah anak perusahaan DPA Corp yang bergerak di bidang jasa perjalanan wisata. Melayani kebutuhan perjalanan civitas akademika Universitas Airlangga, instansi pemerintah, dan masyarakat umum dengan layanan profesional, harga kompetitif, dan jaminan kepuasan pelanggan.',
                    'alamat'            => 'Jl. Dr. Soetomo No.59-61, Surabaya, Jawa Timur',
                    'website_url'       => 'https://www.airlanggatravel.com',
                    'instagram'         => '@airlanggatravel',
                    'order'             => 1,
                    'is_active'         => true,
                    'meta_title'        => 'PT Airlangga Global Traveling — Biro Perjalanan Wisata DPA Corp',
                    'meta_description'  => 'Biro perjalanan wisata resmi Universitas Airlangga. Tiket pesawat, hotel, wisata domestik & internasional, MICE, Umroh & Haji.',
                ],
                'services' => [
                    ['nama_layanan' => 'Tiket Pesawat', 'icon' => '✈️', 'order' => 1],
                    ['nama_layanan' => 'Hotel & Penginapan', 'icon' => '🏨', 'order' => 2],
                    ['nama_layanan' => 'Paket Wisata Domestik', 'icon' => '🏝️', 'order' => 3],
                    ['nama_layanan' => 'Paket Wisata Internasional', 'icon' => '🌏', 'order' => 4],
                    ['nama_layanan' => 'MICE & Event', 'icon' => '🎪', 'order' => 5],
                    ['nama_layanan' => 'Umroh & Haji', 'icon' => '🕌', 'order' => 6],
                ],
            ],
            [
                'data' => [
                    'nama'              => 'Inovasi Bioproduk Indonesia (Inobi)',
                    'slug'              => 'inovasi-bioproduk-indonesia',
                    'deskripsi_singkat' => 'Perusahaan berbasis riset yang mengkomersialisasikan produk bioteknologi dan herbal unggulan hasil penelitian Universitas Airlangga, termasuk produk Meditea.',
                    'deskripsi_lengkap' => 'Inovasi Bioproduk Indonesia (Inobi) adalah anak perusahaan DPA Corp yang fokus pada komersialisasi hasil riset bioteknologi dan produk herbal Universitas Airlangga. Inobi berkomitmen untuk menghadirkan produk-produk berbasis bukti ilmiah yang memberikan manfaat nyata bagi kesehatan masyarakat.',
                    'alamat'            => 'Universitas Airlangga, Surabaya, Jawa Timur',
                    'website_url'       => null, // belum punya website
                    'order'             => 2,
                    'is_active'         => true,
                    'meta_title'        => 'Inovasi Bioproduk Indonesia (Inobi) — DPA Corp',
                    'meta_description'  => 'Komersialisasi produk bioteknologi dan herbal berbasis riset Universitas Airlangga.',
                ],
                'services' => [
                    ['nama_layanan' => 'Produk Herbal Meditea', 'icon' => '🌿', 'order' => 1],
                    ['nama_layanan' => 'Riset & Pengembangan Bioproduct', 'icon' => '🔬', 'order' => 2],
                    ['nama_layanan' => 'Konsultasi Bioteknologi', 'icon' => '🧬', 'order' => 3],
                    ['nama_layanan' => 'Produksi Suplemen Herbal', 'icon' => '💊', 'order' => 4],
                ],
            ],
            [
                'data' => [
                    'nama'              => 'PT Airlangga Univ Konsultan',
                    'slug'              => 'airlangga-univ-konsultan',
                    'deskripsi_singkat' => 'Perusahaan konsultansi manajemen yang didukung oleh jaringan akademisi dan praktisi Universitas Airlangga untuk memberikan solusi bisnis, riset pasar, dan pengembangan organisasi.',
                    'deskripsi_lengkap' => 'PT Airlangga Univ Konsultan memanfaatkan keahlian para dosen dan peneliti Universitas Airlangga untuk memberikan layanan konsultansi manajemen, riset, dan pengembangan bisnis kepada berbagai klien korporat, BUMN, dan pemerintah daerah.',
                    'alamat'            => 'Kampus UNAIR, Surabaya, Jawa Timur',
                    'website_url'       => null,
                    'order'             => 3,
                    'is_active'         => true,
                ],
                'services' => [
                    ['nama_layanan' => 'Konsultansi Manajemen', 'icon' => '📊', 'order' => 1],
                    ['nama_layanan' => 'Riset Pasar & Survei', 'icon' => '📈', 'order' => 2],
                    ['nama_layanan' => 'Pengembangan SDM & Training', 'icon' => '👥', 'order' => 3],
                    ['nama_layanan' => 'Studi Kelayakan Bisnis', 'icon' => '📋', 'order' => 4],
                ],
            ],
            [
                'data' => [
                    'nama'              => 'PT Dharma Putra Adigraha',
                    'slug'              => 'dharma-putra-adigraha',
                    'deskripsi_singkat' => 'Unit usaha properti dan pengelolaan aset DPA Corp yang mengelola gedung, ruang sewa, kantin, dan fasilitas fisik di lingkungan Universitas Airlangga.',
                    'deskripsi_lengkap' => 'PT Dharma Putra Adigraha adalah anak perusahaan DPA Corp yang bergerak di bidang pengelolaan properti dan real estate, termasuk ruang kantor, fasilitas kampus, kantin, dan berbagai aset fisik milik Universitas Airlangga.',
                    'alamat'            => 'Jl. Dr. Soetomo No.59-61, Surabaya, Jawa Timur',
                    'website_url'       => null,
                    'order'             => 4,
                    'is_active'         => true,
                ],
                'services' => [
                    ['nama_layanan' => 'Pengelolaan Gedung & Aset', 'icon' => '🏢', 'order' => 1],
                    ['nama_layanan' => 'Sewa Ruang & Fasilitas', 'icon' => '🏠', 'order' => 2],
                    ['nama_layanan' => 'Kantin & Food Court', 'icon' => '🍽️', 'order' => 3],
                    ['nama_layanan' => 'Bakery & Pastry', 'icon' => '🥐', 'order' => 4],
                    ['nama_layanan' => 'Jasa Rental Kendaraan', 'icon' => '🚗', 'order' => 5],
                ],
            ],
        ];

        foreach ($subsidiaries as $item) {
            $sub = Subsidiary::create($item['data']);
            foreach ($item['services'] as $svc) {
                SubsidiaryService::create(array_merge($svc, ['subsidiary_id' => $sub->id]));
            }
        }
    }
}
