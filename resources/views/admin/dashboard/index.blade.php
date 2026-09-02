@extends('admin.layouts.app')

@section('page-title', 'Dashboard')
@section('breadcrumb')@endsection

@section('content')
<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card {{ $stats['pesan_belum_dibaca'] > 0 ? 'alert-card' : '' }}">
        <div class="stat-icon" style="background:#fee2e2;">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#ef4444"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
        <div class="stat-value">{{ $stats['pesan_belum_dibaca'] }}</div>
        <div class="stat-label">Pesan Belum Dibaca</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#dbeafe;">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#2563eb"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
        </div>
        <div class="stat-value">{{ $stats['produk_aktif'] }}</div>
        <div class="stat-label">Produk & Layanan Aktif</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#dcfce7;">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#16a34a"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        </div>
        <div class="stat-value">{{ $stats['anak_perusahaan'] }}</div>
        <div class="stat-label">Anak Perusahaan Aktif</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#fef3c7;">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#d97706"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>
        </div>
        <div class="stat-value">{{ $stats['manajemen'] }}</div>
        <div class="stat-label">Anggota Manajemen</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#f3e8ff;">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#9333ea"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
        <div class="stat-value">{{ $stats['total_pesan'] }}</div>
        <div class="stat-label">Total Pesan Masuk</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background:#e0f2fe;">
            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#0284c7"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
        <div class="stat-value">{{ $stats['total_user'] }}</div>
        <div class="stat-label">Total User Admin</div>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
    <!-- Recent Messages -->
    <div class="card">
        <div class="card-header">
            <h3>📬 Pesan Terbaru</h3>
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
        </div>
        <div>
            @forelse($pesan_terbaru as $msg)
            <div style="display:flex;align-items:flex-start;gap:12px;padding:14px 22px;border-bottom:1px solid var(--border);{{ !$loop->last ? '' : 'border-bottom:none;' }}">
                @if(!$msg->is_read)
                    <span class="unread-dot" style="margin-top:6px;flex-shrink:0;"></span>
                @else
                    <span style="width:8px;flex-shrink:0;"></span>
                @endif
                <div style="flex:1;min-width:0;">
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:2px;">
                        <strong style="font-size:13px;">{{ $msg->nama }}</strong>
                        <span style="font-size:11px;color:var(--text-muted);">{{ $msg->created_at->diffForHumans() }}</span>
                    </div>
                    <div style="font-size:12px;color:var(--text-muted);">{{ $msg->email }}</div>
                    <div style="font-size:13px;color:var(--text);margin-top:4px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;">{{ $msg->pesan }}</div>
                </div>
                <a href="{{ route('admin.contacts.show', $msg) }}" class="btn btn-secondary btn-sm btn-icon" title="Baca">
                    <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </a>
            </div>
            @empty
            <div style="padding:30px;text-align:center;color:var(--text-muted);font-size:13px;">
                Belum ada pesan masuk.
            </div>
            @endforelse
        </div>
    </div>

    <!-- Quick Links -->
    <div class="card">
        <div class="card-header">
            <h3>⚡ Akses Cepat</h3>
        </div>
        <div class="card-body" style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
            <a href="{{ route('admin.subsidiaries.create') }}" class="btn btn-primary" style="justify-content:center;">+ Anak Perusahaan</a>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary" style="justify-content:center;">+ Produk</a>
            <a href="{{ route('admin.management.create') }}" class="btn btn-secondary" style="justify-content:center;">+ Anggota</a>
            <a href="{{ route('admin.about.history') }}" class="btn btn-secondary" style="justify-content:center;">Edit Sejarah</a>
            <a href="{{ route('admin.about.vision-mission') }}" class="btn btn-secondary" style="justify-content:center;">Visi & Misi</a>
            <a href="{{ route('admin.company-profile.edit') }}" class="btn btn-accent" style="justify-content:center;">Profil Perusahaan</a>
        </div>

        <div class="card-header" style="margin-top:16px;">
            <h3>🌐 Halaman Publik</h3>
        </div>
        <div class="card-body" style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
            @php $pages = [['url'=>'/','label'=>'Beranda'],['url'=>'/tentang-kami','label'=>'Tentang Kami'],['url'=>'/visi-misi','label'=>'Visi & Misi'],['url'=>'/anak-perusahaan','label'=>'Anak Perusahaan'],['url'=>'/produk-layanan','label'=>'Produk & Layanan'],['url'=>'/kontak','label'=>'Kontak']]; @endphp
            @foreach($pages as $p)
            <a href="{{ url($p['url']) }}" target="_blank" class="btn btn-secondary btn-sm" style="font-size:12px;">
                ↗ {{ $p['label'] }}
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
