<?php

namespace Database\Seeders;

use App\Models\ProductService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductServiceSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'nama'             => 'Rental Mobil',
                'slug'             => 'rental-mobil',
                'deskripsi_singkat'=> 'Layanan sewa kendaraan roda empat untuk kebutuhan operasional, perjalanan dinas, dan wisata dengan armada modern dan pengemudi profesional.',
                'deskripsi_lengkap'=> 'Layanan Rental Mobil DPA Corp menyediakan berbagai pilihan kendaraan mulai dari sedan, MPV, hingga bus untuk memenuhi kebutuhan transportasi perusahaan, instansi pemerintah, dan perorangan. Didukung oleh pengemudi berpengalaman dan armada yang selalu dalam kondisi prima.',
                'kategori'         => 'Transportasi',
                'order'            => 1,
            ],
            [
                'nama'             => 'Meditea — Produk Herbal',
                'slug'             => 'meditea-produk-herbal',
                'deskripsi_singkat'=> 'Produk herbal inovatif berbasis riset Universitas Airlangga, menghadirkan minuman kesehatan teh herbal premium (Meditea) yang terbukti secara ilmiah.',
                'deskripsi_lengkap'=> 'Meditea adalah produk minuman herbal yang dikembangkan dari hasil riset akademis Universitas Airlangga. Menggunakan bahan-bahan alami pilihan yang diproses dengan teknologi modern, Meditea hadir dalam berbagai varian untuk mendukung gaya hidup sehat masyarakat Indonesia.',
                'kategori'         => 'Kesehatan & Herbal',
                'order'            => 2,
            ],
            [
                'nama'             => 'Kantin & Katering',
                'slug'             => 'kantin-katering',
                'deskripsi_singkat'=> 'Layanan kantin dan katering untuk lingkungan kampus, perkantoran, dan acara korporat dengan menu bergizi, higienis, dan harga terjangkau.',
                'deskripsi_lengkap'=> 'Layanan Kantin & Katering DPA Corp hadir untuk memenuhi kebutuhan konsumsi di lingkungan kampus Universitas Airlangga dan perkantoran sekitarnya. Menyajikan makanan bergizi, higienis, dengan standar food safety yang terjamin.',
                'kategori'         => 'Food & Beverage',
                'order'            => 3,
            ],
            [
                'nama'             => 'Bakery & Pastry',
                'slug'             => 'bakery-pastry',
                'deskripsi_singkat'=> 'Produk bakery dan pastry berkualitas tinggi untuk kebutuhan konsumsi harian, hampers, dan acara khusus dengan resep premium dan bahan-bahan pilihan.',
                'deskripsi_lengkap'=> 'Unit Bakery & Pastry DPA Corp memproduksi berbagai jenis roti, kue, dan produk pastry premium. Tersedia dalam kemasan harian maupun hampers untuk keperluan korporat, event, dan perayaan.',
                'kategori'         => 'Food & Beverage',
                'order'            => 4,
            ],
        ];

        foreach ($products as $p) {
            ProductService::create(array_merge($p, ['is_active' => true]));
        }
    }
}
