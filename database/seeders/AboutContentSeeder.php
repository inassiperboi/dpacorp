<?php

namespace Database\Seeders;

use App\Models\HistoryTimeline;
use App\Models\LegalDocument;
use App\Models\KbliItem;
use Illuminate\Database\Seeder;

class AboutContentSeeder extends Seeder
{
    public function run(): void
    {
        // ─── History Timeline ─────────────────────────────────
        $timelines = [
            ['year' => '2006', 'title' => 'UNAIR Sebagai PTNBH', 'description' => 'Universitas Airlangga ditetapkan sebagai Perguruan Tinggi Negeri Berbadan Hukum (PTNBH) berdasarkan Peraturan Pemerintah, membuka peluang untuk mengelola unit bisnis secara mandiri.', 'order' => 1],
            ['year' => '2009', 'title' => 'Pendirian DPA Corp', 'description' => 'PT Dharma Putra Airlangga didirikan sebagai holding company milik Universitas Airlangga untuk mengintegrasikan potensi akademis dengan dunia bisnis dan industri.', 'order' => 2],
            ['year' => '2012', 'title' => 'Ekspansi Anak Perusahaan', 'description' => 'DPA Corp mulai mengembangkan entitas bisnis di sektor perjalanan dan wisata melalui PT Airlangga Global Traveling.', 'order' => 3],
            ['year' => '2015', 'title' => 'Inovasi Bioproduct', 'description' => 'Lahirnya Inovasi Bioproduk Indonesia (Inobi) sebagai wujud komitmen DPA Corp dalam komersialisasi riset herbal dan bioproduct unggulan Universitas Airlangga.', 'order' => 4],
            ['year' => '2020', 'title' => 'Transformasi Digital & Holding Diperkuat', 'description' => 'DPA Corp melakukan transformasi digital di seluruh unit bisnis dan memperkuat struktur holding untuk meningkatkan sinergi antar anak perusahaan.', 'order' => 5],
        ];

        foreach ($timelines as $tl) {
            HistoryTimeline::create($tl);
        }

        // ─── Legal Documents ──────────────────────────────────
        $legals = [
            ['jenis' => 'akta_pendirian', 'label' => 'Akta Pendirian',      'nomor' => '---', 'notaris' => 'Notaris Surabaya', 'keterangan' => 'Akta pendirian PT Dharma Putra Airlangga', 'order' => 1],
            ['jenis' => 'sk_kemenkumham', 'label' => 'SK Kemenkumham',      'nomor' => '---', 'keterangan' => 'Surat Keputusan Menteri Hukum dan HAM RI', 'order' => 2],
            ['jenis' => 'npwp',           'label' => 'NPWP Perusahaan',     'nomor' => '---', 'keterangan' => 'Nomor Pokok Wajib Pajak', 'order' => 3],
            ['jenis' => 'nib',            'label' => 'NIB (Nomor Induk Berusaha)', 'nomor' => '---', 'keterangan' => 'Diterbitkan melalui OSS', 'order' => 4],
        ];

        foreach ($legals as $doc) {
            LegalDocument::create($doc);
        }

        // ─── KBLI Items ───────────────────────────────────────
        $kbliList = [
            ['kode_kbli' => '79110', 'judul_kbli' => 'Agen Perjalanan Wisata', 'order' => 1],
            ['kode_kbli' => '79120', 'judul_kbli' => 'Agen Perjalanan Wisata Lainnya', 'order' => 2],
            ['kode_kbli' => '46441', 'judul_kbli' => 'Perdagangan Besar Alat Laboratorium, Farmasi dan Kedokteran', 'order' => 3],
            ['kode_kbli' => '70200', 'judul_kbli' => 'Aktivitas Konsultansi Manajemen', 'order' => 4],
            ['kode_kbli' => '68100', 'judul_kbli' => 'Real Estat yang Dimiliki Sendiri atau Disewa', 'order' => 5],
            ['kode_kbli' => '56101', 'judul_kbli' => 'Restoran dan Kantin', 'order' => 6],
            ['kode_kbli' => '49410', 'judul_kbli' => 'Angkutan Bermotor untuk Barang Umum', 'order' => 7],
        ];

        foreach ($kbliList as $kbli) {
            KbliItem::create($kbli);
        }
    }
}
