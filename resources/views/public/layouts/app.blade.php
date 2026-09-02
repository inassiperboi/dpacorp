<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- SEO Meta Tags --}}
    <title>@yield('meta-title', ($seo->default_meta_title ?? 'PT Dharma Putra Airlangga') . ' — DPA Corp')</title>
    <meta name="description" content="@yield('meta-description', $seo->default_meta_description ?? 'PT Dharma Putra Airlangga (DPA Corp) adalah holding company milik Universitas Airlangga.')">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('og-title', $seo->default_meta_title ?? 'DPA Corp')">
    <meta property="og:description" content="@yield('og-description', $seo->default_meta_description ?? '')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="@yield('og-image', $seo->og_default_image ? asset('storage/'.$seo->og_default_image) : asset('images/og-default.jpg'))">
    <meta name="twitter:card" content="summary_large_image">

    {{-- Google --}}
    @if(!empty($seo->google_site_verification))
    <meta name="google-site-verification" content="{{ $seo->google_site_verification }}">
    @endif

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- JSON-LD Organization Schema --}}
    @if(isset($company))
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "{{ $company->nama_resmi }}",
        "alternateName": "{{ $company->nama_singkat }}",
        "url": "{{ url('/') }}",
        "logo": "{{ $company->logo ? asset('storage/'.$company->logo) : '' }}",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "{{ $company->telepon }}",
            "contactType": "customer service"
        },
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "{{ $company->alamat }}",
            "addressLocality": "{{ $company->kota }}",
            "addressRegion": "{{ $company->provinsi }}",
            "postalCode": "{{ $company->kode_pos }}",
            "addressCountry": "ID"
        },
        "sameAs": [
            "{{ $company->instagram ? 'https://instagram.com/'.ltrim($company->instagram,'@') : '' }}",
            "{{ $company->youtube ?? '' }}"
        ]
    }
    </script>
    @endif

    @stack('head')

    {{-- Google Analytics --}}
    @if(!empty($seo->google_analytics_id))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $seo->google_analytics_id }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $seo->google_analytics_id }}');
    </script>
    @endif

    <style>
        :root {
            --primary: #1a3a6e;
            --primary-light: #2952a3;
            --accent: #e8a020;
            --accent-light: #f0b84a;
            --text: #1e293b;
            --text-muted: #64748b;
            --bg: #f8fafc;
            --surface: #ffffff;
            --border: #e2e8f0;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; color: var(--text); background: #fff; line-height: 1.6; }

        /* ─── Navbar ───────────────────────────────── */
        .navbar {
            position: sticky; top: 0; z-index: 100;
            background: rgba(255,255,255,.95);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            padding: 0 5%;
            display: flex; align-items: center; justify-content: space-between;
            height: 68px;
        }
        .navbar-brand { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .navbar-brand img { height: 42px; }
        .navbar-brand .brand-text { font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 700; color: var(--primary); }
        .navbar-brand .brand-text span { color: var(--accent); }
        .navbar-nav { display: flex; align-items: center; gap: 4px; }
        .nav-link { padding: 8px 14px; border-radius: 8px; font-size: 14px; font-weight: 500; color: var(--text-muted); text-decoration: none; transition: all .2s; }
        .nav-link:hover, .nav-link.active { color: var(--primary); background: #f0f4ff; }
        .nav-cta { background: var(--primary); color: #fff !important; padding: 8px 20px !important; border-radius: 8px; }
        .nav-cta:hover { background: var(--primary-light) !important; }
        .hamburger { display: none; flex-direction: column; gap: 5px; cursor: pointer; padding: 8px; }
        .hamburger span { width: 24px; height: 2px; background: var(--primary); border-radius: 2px; transition: all .3s; }

        /* ─── Footer ───────────────────────────────── */
        footer {
            background: linear-gradient(135deg, #0d1f45 0%, #1a3a6e 100%);
            color: rgba(255,255,255,.8);
            padding: 60px 5% 30px;
        }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 40px; margin-bottom: 40px; }
        .footer-brand { font-family: 'Poppins',sans-serif; font-size: 22px; font-weight: 700; color: #fff; margin-bottom: 12px; }
        .footer-brand span { color: var(--accent); }
        .footer-desc { font-size: 13.5px; line-height: 1.7; max-width: 300px; }
        .footer-socials { display: flex; gap: 10px; margin-top: 16px; }
        .footer-social { width: 36px; height: 36px; border-radius: 8px; background: rgba(255,255,255,.1); display: flex; align-items: center; justify-content: center; text-decoration: none; color: #fff; font-size: 16px; transition: all .2s; }
        .footer-social:hover { background: var(--accent); }
        .footer-heading { font-size: 13px; font-weight: 700; color: #fff; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 16px; }
        .footer-link { display: block; font-size: 13px; color: rgba(255,255,255,.65); text-decoration: none; margin-bottom: 8px; transition: color .2s; }
        .footer-link:hover { color: var(--accent); }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,.1); padding-top: 20px; display: flex; justify-content: space-between; align-items: center; font-size: 12.5px; color: rgba(255,255,255,.5); flex-wrap: wrap; gap: 8px; }

        /* ─── Sections ─────────────────────────────── */
        section { padding: 80px 5%; }
        .section-label { font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: var(--accent); margin-bottom: 10px; }
        h2.section-title { font-family: 'Poppins', sans-serif; font-size: 36px; font-weight: 700; color: var(--primary); margin-bottom: 14px; line-height: 1.2; }
        .section-subtitle { font-size: 16px; color: var(--text-muted); max-width: 600px; line-height: 1.7; }

        /* ─── Breadcrumb ───────────────────────────── */
        .breadcrumb-bar { background: var(--bg); padding: 14px 5%; border-bottom: 1px solid var(--border); }
        .breadcrumb-list { display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--text-muted); list-style: none; flex-wrap: wrap; }
        .breadcrumb-list a { color: var(--primary-light); text-decoration: none; }
        .breadcrumb-list li:not(:last-child)::after { content: '/'; margin-left: 8px; opacity: .4; }

        /* ─── Buttons ──────────────────────────────── */
        .btn-pub { display: inline-flex; align-items: center; gap: 8px; padding: 13px 28px; border-radius: 10px; font-size: 15px; font-weight: 600; text-decoration: none; transition: all .2s; cursor: pointer; border: none; }
        .btn-pub-primary { background: var(--primary); color: #fff; }
        .btn-pub-primary:hover { background: var(--primary-light); transform: translateY(-2px); box-shadow: 0 8px 20px rgba(26,58,110,.25); }
        .btn-pub-outline { background: transparent; color: var(--primary); border: 2px solid var(--primary); }
        .btn-pub-outline:hover { background: var(--primary); color: #fff; }
        .btn-pub-accent { background: var(--accent); color: #fff; }
        .btn-pub-accent:hover { background: var(--accent-light); transform: translateY(-2px); }

        /* ─── Cards ────────────────────────────────── */
        .card-pub { background: var(--surface); border-radius: 16px; border: 1px solid var(--border); overflow: hidden; transition: all .3s; }
        .card-pub:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,.08); }

        /* ─── Responsive ───────────────────────────── */
        @{{media}} (max-width: 900px) {
            .navbar-nav { display: none; position: absolute; top: 68px; left: 0; right: 0; background: #fff; flex-direction: column; padding: 12px; border-bottom: 1px solid var(--border); box-shadow: 0 8px 20px rgba(0,0,0,.08); }
            .navbar-nav.open { display: flex; }
            .hamburger { display: flex; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
            section { padding: 60px 5%; }
            h2.section-title { font-size: 28px; }
        }
        @{{media}} (max-width: 600px) {
            .footer-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<!-- ─── Navbar ─────────────────────────────────────────── -->
<nav class="navbar">
    <a href="{{ url('/') }}" class="navbar-brand">
        @if(isset($company) && $company->logo)
            <img src="{{ asset('storage/'.$company->logo) }}" alt="{{ $company->logo_alt ?? 'Logo DPA Corp' }}">
        @endif
        <span class="brand-text">DPA <span>Corp</span></span>
    </a>

    <div class="navbar-nav" id="navMenu">
        <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Beranda</a>
        <a href="{{ url('/tentang-kami') }}" class="nav-link {{ request()->is('tentang-kami') ? 'active' : '' }}">Tentang Kami</a>
        <a href="{{ url('/visi-misi') }}" class="nav-link {{ request()->is('visi-misi') ? 'active' : '' }}">Visi & Misi</a>
        <a href="{{ url('/struktur-manajemen') }}" class="nav-link {{ request()->is('struktur-manajemen') ? 'active' : '' }}">Manajemen</a>
        <a href="{{ url('/produk-layanan') }}" class="nav-link {{ request()->is('produk-layanan*') ? 'active' : '' }}">Produk & Layanan</a>
        <a href="{{ url('/anak-perusahaan') }}" class="nav-link {{ request()->is('anak-perusahaan') ? 'active' : '' }}">Anak Perusahaan</a>
        <a href="{{ url('/kontak') }}" class="nav-link nav-cta {{ request()->is('kontak') ? 'active' : '' }}">Kontak</a>
    </div>

    <div class="hamburger" id="hamburger" onclick="toggleNav()" aria-label="Menu">
        <span></span><span></span><span></span>
    </div>
</nav>

<!-- ─── Page Content ───────────────────────────────────── -->
<main id="main-content">
    @yield('content')
</main>

<!-- ─── Footer ─────────────────────────────────────────── -->
<footer>
    <div class="footer-grid">
        <div>
            <div class="footer-brand">DPA <span>Corp</span></div>
            <p class="footer-desc">
                {{ isset($company) ? $company->tagline : 'Holding Company Universitas Airlangga — membangun ekosistem bisnis berbasis riset dan inovasi.' }}
            </p>
            @if(isset($company))
            <div class="footer-socials">
                @if($company->instagram)
                    <a href="https://instagram.com/{{ ltrim($company->instagram,'@') }}" target="_blank" rel="noopener" class="footer-social" title="Instagram">📷</a>
                @endif
                @if($company->tiktok)
                    <a href="https://tiktok.com/@{{ ltrim($company->tiktok,'@') }}" target="_blank" rel="noopener" class="footer-social" title="TikTok">🎵</a>
                @endif
                @if($company->youtube)
                    <a href="{{ $company->youtube }}" target="_blank" rel="noopener" class="footer-social" title="YouTube">▶️</a>
                @endif
            </div>
            @endif
        </div>
        <div>
            <div class="footer-heading">Navigasi</div>
            <a href="{{ url('/') }}" class="footer-link">Beranda</a>
            <a href="{{ url('/tentang-kami') }}" class="footer-link">Tentang Kami</a>
            <a href="{{ url('/visi-misi') }}" class="footer-link">Visi & Misi</a>
            <a href="{{ url('/struktur-manajemen') }}" class="footer-link">Struktur Manajemen</a>
        </div>
        <div>
            <div class="footer-heading">Layanan</div>
            <a href="{{ url('/produk-layanan') }}" class="footer-link">Produk & Layanan</a>
            <a href="{{ url('/anak-perusahaan') }}" class="footer-link">Anak Perusahaan</a>
            <a href="{{ url('/client') }}" class="footer-link">Client Kami</a>
            <a href="{{ url('/kontak') }}" class="footer-link">Kontak</a>
        </div>
        <div>
            <div class="footer-heading">Kontak</div>
            @if(isset($company))
                <p style="font-size:13px;margin-bottom:8px;">{{ $company->alamat }}</p>
                @if($company->telepon)
                    <a href="tel:{{ $company->telepon }}" class="footer-link">📞 {{ $company->telepon }}</a>
                @endif
                @if($company->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$company->whatsapp) }}" target="_blank" class="footer-link">💬 WhatsApp</a>
                @endif
                @if($company->email)
                    <a href="mailto:{{ $company->email }}" class="footer-link">✉️ {{ $company->email }}</a>
                @endif
            @endif
        </div>
    </div>
    <div class="footer-bottom">
        <span>© {{ date('Y') }} PT Dharma Putra Airlangga. Hak Cipta Dilindungi.</span>
        <span>Holding Company Universitas Airlangga</span>
    </div>
</footer>

<script>
function toggleNav() {
    const menu = document.getElementById('navMenu');
    menu.classList.toggle('open');
}

// Flash alerts via SweetAlert
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session("success") }}',
        confirmButtonColor: '#1a3a6e',
        timer: 4000,
        timerProgressBar: true,
    });
@endif
@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Oops!',
        text: '{{ session("error") }}',
        confirmButtonColor: '#1a3a6e',
    });
@endif
@if($errors->any())
    Swal.fire({
        icon: 'warning',
        title: 'Ada kesalahan pada form',
        html: `{!! implode('<br>', $errors->all()) !!}`,
        confirmButtonColor: '#1a3a6e',
    });
@endif
</script>

@stack('scripts')
</body>
</html>
