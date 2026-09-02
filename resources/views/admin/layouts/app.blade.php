<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') — DPA Corp</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --sidebar-w: 260px;
            --primary: #1a3a6e;
            --primary-light: #2952a3;
            --accent: #e8a020;
            --accent-light: #f0b84a;
            --bg: #f4f6fb;
            --surface: #ffffff;
            --text: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --danger: #ef4444;
            --success: #22c55e;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); display: flex; min-height: 100vh; }

        /* ─── Sidebar ─────────────────────────────────── */
        .sidebar {
            width: var(--sidebar-w); min-height: 100vh; background: var(--primary);
            display: flex; flex-direction: column; position: fixed; left: 0; top: 0; bottom: 0; z-index: 100;
            transition: transform 0.3s ease;
        }
        .sidebar-logo { padding: 24px 20px; border-bottom: 1px solid rgba(255,255,255,.1); }
        .sidebar-logo img { height: 36px; }
        .sidebar-logo .brand { font-size: 18px; font-weight: 700; color: #fff; letter-spacing: .5px; }
        .sidebar-logo .brand span { color: var(--accent); }
        .sidebar-nav { flex: 1; overflow-y: auto; padding: 12px 0; }
        .nav-group { padding: 16px 16px 4px; font-size: 10px; font-weight: 600; text-transform: uppercase; letter-spacing: 1.2px; color: rgba(255,255,255,.4); }
        .nav-item { display: flex; align-items: center; gap: 10px; padding: 10px 20px; color: rgba(255,255,255,.75); font-size: 13.5px; font-weight: 500; text-decoration: none; transition: all .2s; border-left: 3px solid transparent; }
        .nav-item:hover { background: rgba(255,255,255,.08); color: #fff; border-left-color: rgba(255,255,255,.3); }
        .nav-item.active { background: rgba(255,255,255,.12); color: #fff; border-left-color: var(--accent); }
        .nav-item svg { width: 18px; height: 18px; flex-shrink: 0; opacity: .8; }
        .nav-item.active svg { opacity: 1; }
        .sidebar-footer { padding: 16px; border-top: 1px solid rgba(255,255,255,.1); }
        .sidebar-footer .user-info { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; }
        .sidebar-footer .avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--accent); display: flex; align-items: center; justify-content: center; font-weight: 700; color: #fff; font-size: 14px; flex-shrink: 0; }
        .sidebar-footer .user-name { font-size: 13px; font-weight: 600; color: #fff; }
        .sidebar-footer .user-role { font-size: 11px; color: rgba(255,255,255,.5); text-transform: capitalize; }
        .btn-logout { width: 100%; background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.15); color: rgba(255,255,255,.8); padding: 8px; border-radius: 8px; font-size: 13px; cursor: pointer; transition: all .2s; }
        .btn-logout:hover { background: rgba(239,68,68,.2); border-color: rgba(239,68,68,.4); color: #fff; }

        /* ─── Main Content ────────────────────────────── */
        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }
        .topbar { background: var(--surface); border-bottom: 1px solid var(--border); padding: 14px 28px; display: flex; align-items: center; justify-content: space-between; gap: 16px; position: sticky; top: 0; z-index: 50; }
        .topbar .page-title { font-size: 17px; font-weight: 600; color: var(--text); }
        .topbar .breadcrumb { font-size: 12px; color: var(--text-muted); }
        .topbar .breadcrumb a { color: var(--primary-light); text-decoration: none; }
        .content { flex: 1; padding: 28px; }

        /* ─── Cards ──────────────────────────────────── */
        .card { background: var(--surface); border-radius: 14px; border: 1px solid var(--border); overflow: hidden; }
        .card-header { padding: 18px 22px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
        .card-header h3 { font-size: 15px; font-weight: 600; }
        .card-body { padding: 22px; }

        /* ─── Stats Widgets ──────────────────────────── */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(190px, 1fr)); gap: 16px; margin-bottom: 28px; }
        .stat-card { background: var(--surface); border-radius: 14px; padding: 20px; border: 1px solid var(--border); display: flex; flex-direction: column; gap: 8px; }
        .stat-card .stat-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; }
        .stat-card .stat-value { font-size: 28px; font-weight: 700; color: var(--text); }
        .stat-card .stat-label { font-size: 12px; color: var(--text-muted); font-weight: 500; }
        .stat-card.alert-card { border-left: 4px solid var(--danger); }

        /* ─── Tables ─────────────────────────────────── */
        .table-wrapper { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
        th { background: #f8fafc; font-weight: 600; padding: 11px 14px; text-align: left; color: var(--text-muted); font-size: 11.5px; text-transform: uppercase; letter-spacing: .5px; border-bottom: 1px solid var(--border); }
        td { padding: 12px 14px; border-bottom: 1px solid var(--border); vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f8fafc; }

        /* ─── Buttons ────────────────────────────────── */
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer; border: none; text-decoration: none; transition: all .2s; }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-light); }
        .btn-accent { background: var(--accent); color: #fff; }
        .btn-accent:hover { background: var(--accent-light); }
        .btn-danger { background: var(--danger); color: #fff; }
        .btn-danger:hover { background: #dc2626; }
        .btn-secondary { background: #f1f5f9; color: var(--text); border: 1px solid var(--border); }
        .btn-secondary:hover { background: var(--border); }
        .btn-sm { padding: 5px 10px; font-size: 12px; }
        .btn-icon { padding: 6px; border-radius: 6px; }

        /* ─── Forms ──────────────────────────────────── */
        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: 13px; font-weight: 500; margin-bottom: 6px; color: var(--text); }
        .form-label .required { color: var(--danger); margin-left: 2px; }
        .form-control { width: 100%; padding: 9px 12px; border: 1.5px solid var(--border); border-radius: 8px; font-size: 13.5px; color: var(--text); background: #fff; outline: none; transition: border .2s; }
        .form-control:focus { border-color: var(--primary-light); box-shadow: 0 0 0 3px rgba(41,82,163,.1); }
        .form-control.is-invalid { border-color: var(--danger); }
        .form-select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 10px center; background-size: 16px; padding-right: 34px; }
        textarea.form-control { resize: vertical; min-height: 100px; }
        .form-hint { font-size: 11.5px; color: var(--text-muted); margin-top: 4px; }
        .invalid-feedback { font-size: 11.5px; color: var(--danger); margin-top: 4px; }

        /* ─── Badges ─────────────────────────────────── */
        .badge { display: inline-flex; align-items: center; padding: 3px 9px; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .badge-success { background: #dcfce7; color: #166534; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-info { background: #dbeafe; color: #1e40af; }
        .badge-gray { background: #f1f5f9; color: var(--text-muted); }

        /* ─── Toggle Switch ──────────────────────────── */
        .toggle { position: relative; display: inline-block; width: 40px; height: 22px; }
        .toggle input { opacity: 0; width: 0; height: 0; }
        .toggle-slider { position: absolute; cursor: pointer; inset: 0; background: #cbd5e1; border-radius: 22px; transition: .2s; }
        .toggle-slider:before { content: ''; position: absolute; width: 16px; height: 16px; left: 3px; top: 3px; background: #fff; border-radius: 50%; transition: .2s; }
        .toggle input:checked + .toggle-slider { background: var(--success); }
        .toggle input:checked + .toggle-slider:before { transform: translateX(18px); }

        /* ─── Alert flash ────────────────────────────── */
        .flash { display: none; }

        /* ─── Unread indicator ────────────────────────── */
        .unread-dot { width: 8px; height: 8px; background: var(--danger); border-radius: 50%; display: inline-block; }

        /* ─── Responsive ─────────────────────────────── */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main { margin-left: 0; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- ─── Sidebar ──────────────────────────────────────────── -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <div class="brand">DPA <span>Corp</span></div>
        <div style="font-size:11px;color:rgba(255,255,255,.4);margin-top:2px;">Admin Panel</div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-group">Utama</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            Dashboard
        </a>

        <div class="nav-group">Konten</div>
        <a href="{{ route('admin.company-profile.edit') }}" class="nav-item {{ request()->routeIs('admin.company-profile*') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            Profil Perusahaan
        </a>
        <a href="{{ route('admin.about.history') }}" class="nav-item {{ request()->routeIs('admin.about.history*') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Sejarah & Timeline
        </a>
        <a href="{{ route('admin.about.legal') }}" class="nav-item {{ request()->routeIs('admin.about.legal*') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Legalitas & KBLI
        </a>
        <a href="{{ route('admin.about.vision-mission') }}" class="nav-item {{ request()->routeIs('admin.about.vision*') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            Visi & Misi
        </a>
        <a href="{{ route('admin.management.index') }}" class="nav-item {{ request()->routeIs('admin.management*') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>
            Struktur Manajemen
        </a>
        <a href="{{ route('admin.products.index') }}" class="nav-item {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            Produk & Layanan
        </a>
        <a href="{{ route('admin.subsidiaries.index') }}" class="nav-item {{ request()->routeIs('admin.subsidiaries*') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            Anak Perusahaan
        </a>
        <a href="{{ route('admin.clients.index') }}" class="nav-item {{ request()->routeIs('admin.clients*') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            Client
        </a>

        <div class="nav-group">Komunikasi</div>
        <a href="{{ route('admin.contacts.index') }}" class="nav-item {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Pesan Masuk
            @php $unread = \App\Models\ContactMessage::where('is_read', false)->count(); @endphp
            @if($unread > 0)
                <span class="badge badge-danger" style="margin-left:auto;">{{ $unread }}</span>
            @endif
        </a>

        @if(auth()->user()->isAdmin())
        <div class="nav-group">Sistem</div>
        <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            Kelola User
        </a>
        @endif
    </nav>

    <div class="sidebar-footer">
        <div class="user-info">
            <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div class="user-name">{{ auth()->user()->name }}</div>
                <div class="user-role">{{ auth()->user()->role }}</div>
            </div>
        </div>
        <form action="{{ route('cp.logout') }}" method="POST">
            @csrf
            <button type="button" class="btn-logout" onclick="confirmLogout(this.closest('form'))">
                🚪 Keluar
            </button>
        </form>
    </div>
</aside>

<!-- ─── Main Content ─────────────────────────────────────── -->
<div class="main">
    <div class="topbar">
        <div>
            <div class="page-title">@yield('page-title', 'Dashboard')</div>
            <div class="breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Home</a>
                @yield('breadcrumb')
            </div>
        </div>
        <div style="display:flex;align-items:center;gap:10px;">
            <a href="{{ url('/') }}" target="_blank" class="btn btn-secondary btn-sm">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                Lihat Website
            </a>
        </div>
    </div>

    <div class="content">
        @yield('content')
    </div>
</div>

<script>
// SweetAlert untuk logout
function confirmLogout(form) {
    Swal.fire({
        title: 'Keluar dari Admin Panel?',
        text: 'Anda akan diarahkan ke halaman login.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#1a3a6e',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Keluar',
        cancelButtonText: 'Batal',
        borderRadius: '14px',
    }).then((result) => {
        if (result.isConfirmed) form.submit();
    });
}

// SweetAlert untuk delete
function confirmDelete(form, itemName) {
    Swal.fire({
        title: 'Hapus Data?',
        html: `Data <strong>${itemName}</strong> akan dihapus permanen dan tidak dapat dikembalikan.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
    }).then((result) => {
        if (result.isConfirmed) form.submit();
    });
}

// Flash messages via SweetAlert
@if(session('success'))
    Swal.fire({
        toast: true,
        position: 'center',
        icon: 'success',
        title: '{{ session("success") }}',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        customClass: { popup: 'swal-toast-popup' }
    });
@endif
@if(session('error'))
    Swal.fire({
        toast: true,
        position: 'center',
        icon: 'error',
        title: '{{ session("error") }}',
        showConfirmButton: true,
        confirmButtonColor: '#1a3a6e',
    });
@endif

// Mobile sidebar toggle
const sidebar = document.getElementById('sidebar');
</script>

<style>
.swal-toast-popup { border-radius: 12px !important; font-family: 'Inter', sans-serif !important; }
</style>

@stack('scripts')
</body>
</html>
