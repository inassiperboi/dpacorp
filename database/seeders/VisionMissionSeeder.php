<?php

namespace Database\Seeders;

use App\Models\Vision;
use App\Models\MissionPoint;
use Illuminate\Database\Seeder;

class VisionMissionSeeder extends Seeder
{
    public function run(): void
    {
        Vision::create([
            'isi_visi' => 'Menjadi holding company terkemuka milik perguruan tinggi yang mampu mendorong pertumbuhan ekonomi berbasis inovasi, riset, dan teknologi untuk kemaslahatan masyarakat Indonesia.',
        ]);

        $missions = [
            'Mengoptimalkan potensi sumber daya Universitas Airlangga untuk menciptakan produk dan layanan berkualitas tinggi yang berdampak nyata bagi masyarakat.',
            'Membangun ekosistem bisnis yang bersinergi antar unit usaha sehingga memberikan nilai tambah yang maksimal bagi seluruh pemangku kepentingan.',
            'Mengembangkan inovasi berbasis riset akademis sebagai landasan utama pengembangan produk dan layanan yang kompetitif di pasar nasional maupun internasional.',
            'Mengelola bisnis dengan prinsip tata kelola perusahaan yang baik (good corporate governance), transparansi, dan akuntabilitas.',
            'Mencetak wirausahawan muda berbasis pengetahuan melalui program inkubasi bisnis yang mendukung ekosistem startup di lingkungan Universitas Airlangga.',
            'Berkontribusi aktif dalam pembangunan ekonomi daerah Jawa Timur dan nasional melalui penciptaan lapangan kerja dan pengembangan UMKM.',
        ];

        foreach ($missions as $i => $misi) {
            MissionPoint::create(['isi_misi' => $misi, 'order' => $i + 1]);
        }
    }
}
