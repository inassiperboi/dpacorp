```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- SEO Meta Tags --}}
    <title>
        @yield('meta-title', ($seo->default_meta_title ?? 'PT Dharma Putra Airlangga') . ' — DPA Corp')
    </title>

    <meta name="description"
          content="@yield('meta-description', $seo->default_meta_description ?? 'PT Dharma Putra Airlangga (DPA Corp) adalah holding company milik Universitas Airlangga.')">

    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:title"
          content="@yield('og-title', $seo->default_meta_title ?? 'DPA Corp')">

    <meta property="og:description"
          content="@yield('og-description', $seo->default_meta_description ?? '')">

    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <meta property="og:image"
          content="@yield('og-image', asset('images/og-default.jpg'))">

    <meta name="twitter:card" content="summary_large_image">

    {{-- Google Site Verification --}}
    @if(!empty($seo->google_site_verification))
        <meta name="google-site-verification"
              content="{{ $seo->google_site_verification }}">
    @endif

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap"
          rel="stylesheet">

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- JSON-LD Organization Schema --}}
    @if(isset($company) && $company)

        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "{{ addslashes($company->nama_resmi) }}",
            "alternateName": "{{ addslashes($company->nama_singkat ?? '') }}",
            "url": "{{ url('/') }}",
            "logo": "{{ $company->logo ? asset('storage/'.$company->logo) : '' }}",
            "contactPoint": {
                "@type": "ContactPoint",
                "telephone": "{{ addslashes($company->telepon ?? '') }}",
                "contactType": "customer service"
            }
        }
        </script>

    @endif

    {{-- Page-specific head --}}
    @stack('head')

    {{-- Google Analytics --}}
    @if(!empty($seo->google_analytics_id))

        <script async
                src="https://www.googletagmanager.com/gtag/js?id={{ $seo->google_analytics_id }}">
        </script>

        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag(
                'config',
                '{{ $seo->google_analytics_id }}'
            );
        </script>

    @endif

</head>

<body>

<!-- =========================================================
     NAVBAR
========================================================= -->

<nav class="navbar">

    <a href="{{ url('/') }}" class="navbar-brand">

        @if(isset($company) && $company && $company->logo)

            <img
                src="{{ asset('storage/'.$company->logo) }}"
                alt="{{ $company->logo_alt ?? 'Logo DPA Corp' }}"
            >

        @endif

        <span class="brand-text">
            DPA <span>Corp</span>
        </span>

    </a>


    <div class="navbar-nav" id="navMenu">

        <a href="{{ url('/') }}"
           class="nav-link {{ request()->is('/') ? 'active' : '' }}">
            Beranda
        </a>

        <a href="{{ url('/tentang-kami') }}"
           class="nav-link {{ request()->is('tentang-kami') ? 'active' : '' }}">
            Tentang Kami
        </a>

        <a href="{{ url('/visi-misi') }}"
           class="nav-link {{ request()->is('visi-misi') ? 'active' : '' }}">
            Visi &amp; Misi
        </a>

        <a href="{{ url('/struktur-manajemen') }}"
           class="nav-link {{ request()->is('struktur-manajemen') ? 'active' : '' }}">
            Manajemen
        </a>

        <a href="{{ url('/produk-layanan') }}"
           class="nav-link {{ request()->is('produk-layanan*') ? 'active' : '' }}">
            Produk &amp; Layanan
        </a>

        <a href="{{ url('/anak-perusahaan') }}"
           class="nav-link {{ request()->is('anak-perusahaan') ? 'active' : '' }}">
            Anak Perusahaan
        </a>

        <a href="{{ url('/kontak') }}"
           class="nav-link nav-cta {{ request()->is('kontak') ? 'active' : '' }}">
            Kontak
        </a>

    </div>


    <div
        class="hamburger"
        id="hamburger"
        onclick="toggleNav()"
        aria-label="Menu"
    >
        <span></span>
        <span></span>
        <span></span>
    </div>

</nav>


<!-- =========================================================
     PAGE CONTENT
========================================================= -->

<main id="main-content">

    @yield('content')

</main>


<!-- =========================================================
     FOOTER
========================================================= -->

<footer>

    <div class="footer-grid">

        {{-- Footer Brand --}}
        <div>

            <div class="footer-brand">
                DPA <span>Corp</span>
            </div>

            <p class="footer-desc">

                {{
                    (isset($company) && $company)
                    ? $company->tagline
                    : 'Holding Company Universitas Airlangga — membangun ekosistem bisnis berbasis riset dan inovasi.'
                }}

            </p>


            @if(isset($company) && $company)

                <div class="footer-socials">

                    {{-- Instagram --}}
                    @if($company->instagram)

                        <a
                            href="https://instagram.com/{{ ltrim($company->instagram, '@') }}"
                            target="_blank"
                            rel="noopener"
                            class="footer-social"
                            title="Instagram"
                        >
                            📷
                        </a>

                    @endif


                    {{-- TikTok --}}
                    @if($company->tiktok)

                        <a
                            href="https://tiktok.com/@{{ ltrim($company->tiktok, '@') }}"
                            target="_blank"
                            rel="noopener"
                            class="footer-social"
                            title="TikTok"
                        >
                            🎵
                        </a>

                    @endif


                    {{-- YouTube --}}
                    @if($company->youtube)

                        <a
                            href="{{ $company->youtube }}"
                            target="_blank"
                            rel="noopener"
                            class="footer-social"
                            title="YouTube"
                        >
                            ▶️
                        </a>

                    @endif

                </div>

            @endif

        </div>


        {{-- Navigasi --}}
        <div>

            <div class="footer-heading">
                Navigasi
            </div>

            <a href="{{ url('/') }}" class="footer-link">
                Beranda
            </a>

            <a href="{{ url('/tentang-kami') }}" class="footer-link">
                Tentang Kami
            </a>

            <a href="{{ url('/visi-misi') }}" class="footer-link">
                Visi &amp; Misi
            </a>

            <a href="{{ url('/struktur-manajemen') }}" class="footer-link">
                Struktur Manajemen
            </a>

        </div>


        {{-- Layanan --}}
        <div>

            <div class="footer-heading">
                Layanan
            </div>

            <a href="{{ url('/produk-layanan') }}" class="footer-link">
                Produk &amp; Layanan
            </a>

            <a href="{{ url('/anak-perusahaan') }}" class="footer-link">
                Anak Perusahaan
            </a>

            <a href="{{ url('/client') }}" class="footer-link">
                Client Kami
            </a>

            <a href="{{ url('/kontak') }}" class="footer-link">
                Kontak
            </a>

        </div>


        {{-- Kontak --}}
        <div>

            <div class="footer-heading">
                Kontak
            </div>


            @if(isset($company) && $company)

                {{-- Alamat --}}
                <p style="font-size:13px;margin-bottom:8px;">
                    {{ $company->alamat }}
                </p>


                {{-- Telepon --}}
                @if($company->telepon)

                    <a
                        href="tel:{{ $company->telepon }}"
                        class="footer-link"
                    >
                        📞 {{ $company->telepon }}
                    </a>

                @endif


                {{-- WhatsApp --}}
                @if($company->whatsapp)

                    <a
                        href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->whatsapp) }}"
                        target="_blank"
                        rel="noopener"
                        class="footer-link"
                    >
                        💬 WhatsApp
                    </a>

                @endif


                {{-- Email --}}
                @if($company->email)

                    <a
                        href="mailto:{{ $company->email }}"
                        class="footer-link"
                    >
                        ✉️ {{ $company->email }}
                    </a>

                @endif

            @endif

        </div>

    </div>


    {{-- Footer Bottom --}}
    <div class="footer-bottom">

        <span>
            &copy; {{ date('Y') }}
            PT Dharma Putra Airlangga.
            Hak Cipta Dilindungi.
        </span>

        <span>
            Holding Company Universitas Airlangga
        </span>

    </div>

</footer>


<!-- =========================================================
     NAVBAR JAVASCRIPT
========================================================= -->

<script>

function toggleNav() {

    const navMenu = document.getElementById('navMenu');

    if (navMenu) {
        navMenu.classList.toggle('open');
    }

}

</script>


<!-- =========================================================
     SWEETALERT FLASH MESSAGES
========================================================= -->

@php

    $flashSuccess = session('success');

    $flashError = session('error');

    $flashErrors = $errors->any()
        ? $errors->all()
        : [];

@endphp


<script>

document.addEventListener('DOMContentLoaded', function () {

    @if($flashSuccess)

        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: @json($flashSuccess),
            confirmButtonColor: '#1a3a6e',
            timer: 4000,
            timerProgressBar: true
        });

    @endif


    @if($flashError)

        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: @json($flashError),
            confirmButtonColor: '#1a3a6e'
        });

    @endif


    @if(count($flashErrors) > 0)

        Swal.fire({
            icon: 'warning',
            title: 'Periksa form Anda',
            html: @json(implode('<br>', $flashErrors)),
            confirmButtonColor: '#1a3a6e'
        });

    @endif

});

</script>


<!-- =========================================================
     PAGE-SPECIFIC SCRIPTS
========================================================= -->

@stack('scripts')

</body>
</html>
```
