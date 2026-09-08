<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- =========================================================
         SEO META
    ========================================================== --}}

    <title>
        @yield(
            'meta-title',
            ($seo->default_meta_title ?? 'PT Dharma Putra Airlangga') . ' — DPA Corp'
        )
    </title>

    <meta
        name="description"
        content="@yield(
            'meta-description',
            $seo->default_meta_description
                ?? 'PT Dharma Putra Airlangga (DPA Corp) adalah holding company milik Universitas Airlangga.'
        )"
    >

    <link rel="canonical" href="{{ url()->current() }}">


    {{-- =========================================================
         OPEN GRAPH
    ========================================================== --}}

    <meta
        property="og:title"
        content="@yield(
            'og-title',
            $seo->default_meta_title ?? 'DPA Corp'
        )"
    >

    <meta
        property="og:description"
        content="@yield(
            'og-description',
            $seo->default_meta_description ?? ''
        )"
    >

    <meta
        property="og:url"
        content="{{ url()->current() }}"
    >

    <meta
        property="og:type"
        content="website"
    >

    <meta
        property="og:image"
        content="@yield(
            'og-image',
            asset('images/og-default.jpg')
        )"
    >

    <meta
        name="twitter:card"
        content="summary_large_image"
    >


    {{-- =========================================================
         GOOGLE SITE VERIFICATION
    ========================================================== --}}

    @if(!empty($seo->google_site_verification))
        <meta
            name="google-site-verification"
            content="{{ $seo->google_site_verification }}"
        >
    @endif


    {{-- =========================================================
         FONTS
    ========================================================== --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap"
        rel="stylesheet"
    >


    {{-- =========================================================
         SWEETALERT2
    ========================================================== --}}

    <script
        src="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    </script>


    {{-- =========================================================
         VITE
    ========================================================== --}}

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])


    {{-- =========================================================
         JSON-LD ORGANIZATION SCHEMA

         Menggunakan PHP array agar @context dan @type
         tidak dianggap sebagai Blade directive.
    ========================================================== --}}

    @if(isset($company) && $company)

        @php
            $organizationSchema = [
                '@context' => 'https://schema.org',

                '@type' => 'Organization',

                'name' => $company->nama_resmi,

                'alternateName' => $company->nama_singkat ?? '',

                'url' => url('/'),

                'logo' => $company->logo
                    ? asset('storage/' . $company->logo)
                    : '',

                'contactPoint' => [
                    '@type' => 'ContactPoint',
                    'telephone' => $company->telepon ?? '',
                    'contactType' => 'customer service',
                ],
            ];
        @endphp

        <script type="application/ld+json">
{!! json_encode(
    $organizationSchema,
    JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
) !!}
        </script>

    @endif


    {{-- =========================================================
         PAGE-SPECIFIC HEAD
    ========================================================== --}}

    @stack('head')


    {{-- =========================================================
         GOOGLE ANALYTICS
    ========================================================== --}}

    @if(!empty($seo->google_analytics_id))

        <script
            async
            src="https://www.googletagmanager.com/gtag/js?id={{ $seo->google_analytics_id }}"
        ></script>

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

    {{-- =========================================================
         NAVBAR
    ========================================================== --}}

    <nav class="navbar">

        {{-- Logo / Brand --}}
        <a href="{{ url('/') }}" class="navbar-brand">
    <img
        src="{{ asset('images/hero/logo.png') }}"
        alt="Logo PT Dharma Putra Airlangga"
    >
    <span class="brand-text">PT Dharma Putra Airlangga</span>
        </a>


        {{-- Navigation --}}
        <div
            class="navbar-nav"
            id="navMenu"
        >

            <a
                href="{{ url('/') }}"
                class="nav-link {{ request()->is('/') ? 'active' : '' }}"
            >
                Beranda
            </a>


            <a
                href="{{ url('/tentang-kami') }}"
                class="nav-link {{ request()->is('tentang-kami') ? 'active' : '' }}"
            >
                Tentang Kami
            </a>


            <a
                href="{{ url('/visi-misi') }}"
                class="nav-link {{ request()->is('visi-misi') ? 'active' : '' }}"
            >
                Visi &amp; Misi
            </a>


            <a
                href="{{ url('/struktur-manajemen') }}"
                class="nav-link {{ request()->is('struktur-manajemen') ? 'active' : '' }}"
            >
                Manajemen
            </a>


            <a
                href="{{ url('/produk-layanan') }}"
                class="nav-link {{ request()->is('produk-layanan*') ? 'active' : '' }}"
            >
                Produk &amp; Layanan
            </a>


            <a
                href="{{ url('/anak-perusahaan') }}"
                class="nav-link {{ request()->is('anak-perusahaan') ? 'active' : '' }}"
            >
                Anak Perusahaan
            </a>


            <a
                href="{{ url('/kontak') }}"
                class="nav-link nav-cta {{ request()->is('kontak') ? 'active' : '' }}"
            >
                Kontak
            </a>

        </div>


        {{-- Hamburger --}}
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


    {{-- =========================================================
         PAGE CONTENT
    ========================================================== --}}

    <main id="main-content">

        @yield('content')

    </main>


    {{-- =========================================================
         FOOTER
    ========================================================== --}}

    <footer>

        <div class="footer-grid">

            {{-- =================================================
                 FOOTER BRAND
            ================================================== --}}

            <div>

                <div class="footer-brand">
                    DPA <span>Corp</span>
                </div>


                <p class="footer-desc">

                    {{
                        (isset($company) && $company)
                            ? ($company->tagline ?? '')
                            : 'Holding Company Universitas Airlangga — membangun ekosistem bisnis berbasis riset dan inovasi.'
                    }}

                </p>


                {{-- Social Media --}}
                @if(isset($company) && $company)

                    <div class="footer-socials">

                        {{-- Instagram --}}
                        @if(!empty($company->instagram))

                            @php
                                $footerInstagramUrl = preg_match('/^https?:\/\//i', $company->instagram)
                                    ? $company->instagram
                                    : 'https://instagram.com/' . ltrim($company->instagram, '@');
                            @endphp

                            <a
                                href="{{ $footerInstagramUrl }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="footer-social"
                                title="Instagram"
                                aria-label="Instagram"
                            >
                                📷
                            </a>

                        @endif


                        {{-- TikTok --}}
                        @if(!empty($company->tiktok))

                            @php
                                $footerTiktokUrl = preg_match('/^https?:\/\//i', $company->tiktok)
                                    ? $company->tiktok
                                    : 'https://www.tiktok.com/@' . ltrim($company->tiktok, '@');
                            @endphp

                            <a
                                href="{{ $footerTiktokUrl }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="footer-social"
                                title="TikTok"
                                aria-label="TikTok"
                            >
                                🎵
                            </a>

                        @endif


                        {{-- YouTube --}}
                        @if(!empty($company->youtube))

                            <a
                                href="{{ $company->youtube }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="footer-social"
                                title="YouTube"
                                aria-label="YouTube"
                            >
                                ▶️
                            </a>

                        @endif

                    </div>

                @endif

            </div>


            {{-- =================================================
                 NAVIGASI
            ================================================== --}}

            <div>

                <div class="footer-heading">
                    Navigasi
                </div>


                <a
                    href="{{ url('/') }}"
                    class="footer-link"
                >
                    Beranda
                </a>


                <a
                    href="{{ url('/tentang-kami') }}"
                    class="footer-link"
                >
                    Tentang Kami
                </a>


                <a
                    href="{{ url('/visi-misi') }}"
                    class="footer-link"
                >
                    Visi &amp; Misi
                </a>


                <a
                    href="{{ url('/struktur-manajemen') }}"
                    class="footer-link"
                >
                    Struktur Manajemen
                </a>

            </div>


            {{-- =================================================
                 LAYANAN
            ================================================== --}}

            <div>

                <div class="footer-heading">
                    Layanan
                </div>


                <a
                    href="{{ url('/produk-layanan') }}"
                    class="footer-link"
                >
                    Produk &amp; Layanan
                </a>


                <a
                    href="{{ url('/anak-perusahaan') }}"
                    class="footer-link"
                >
                    Anak Perusahaan
                </a>


                {{-- <a
                    href="{{ url('/client') }}"
                    class="footer-link"
                >
                    Client Kami
                </a> --}}


                {{-- <a
                    href="{{ url('/kontak') }}"
                    class="footer-link"
                >
                    Kontak
                </a> --}}

            </div>


            {{-- =================================================
                 KONTAK
            ================================================== --}}

            <div>

                <div class="footer-heading">
                    Kontak
                </div>

                @if(isset($company) && $company)

                    {{-- Alamat dengan preview map --}}
                    @if(!empty($company->alamat))

                        @php
                            $footerAddressText = trim(($company->alamat ?? '') . ' ' . ($company->kota ?? '') . ' ' . ($company->kode_pos ?? ''));
                            $footerAddressQuery = urlencode($footerAddressText);
                            $footerMapsUrl = !empty($company->maps_url)
                                ? $company->maps_url
                                : ((!empty($company->lat) && !empty($company->lng))
                                    ? 'https://www.google.com/maps?q=' . $company->lat . ',' . $company->lng
                                    : 'https://www.google.com/maps?q=' . $footerAddressQuery);
                            $footerMapEmbed = 'https://www.google.com/maps?q=' . $footerAddressQuery . '&output=embed';
                        @endphp

                        <div class="footer-map-card">
                            <a
                                href="{{ $footerMapsUrl }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="footer-map-link"
                                aria-label="Buka lokasi di Google Maps"
                            >
                                <iframe
                                    src="{{ $footerMapEmbed }}"
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                    title="Peta lokasi {{ $company->nama_singkat ?? 'DPA Corp' }}">
                                </iframe>
                            </a>
                        </div>

                    @endif


                    {{-- Telepon --}}
                    @if(!empty($company->telepon))

                        <a
                            href="tel:{{ $company->telepon }}"
                            class="footer-link"
                        >
                            📞 {{ $company->telepon }}
                        </a>

                    @endif


                    {{-- WhatsApp --}}
                    @if(!empty($company->whatsapp))

                        <a
                            href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->whatsapp) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="footer-link"
                        >
                            💬 WhatsApp
                        </a>

                    @endif


                    {{-- Email --}}
                    @if(!empty($company->email))

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


        {{-- =================================================
             FOOTER BOTTOM
        ================================================== --}}

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


    {{-- =========================================================
         NAVBAR JAVASCRIPT
    ========================================================== --}}

    <script>

        function toggleNav() {

            const navMenu = document.getElementById('navMenu');

            if (navMenu) {
                navMenu.classList.toggle('open');
            }

        }

    </script>


    {{-- =========================================================
         SWEETALERT FLASH MESSAGES
    ========================================================== --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const flashSuccess = @json(session('success'));

            const flashError = @json(session('error'));

            const flashErrors = @json(
                $errors->any()
                    ? $errors->all()
                    : []
            );


            // Success
            if (flashSuccess) {

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: flashSuccess,
                    confirmButtonColor: '#1a3a6e',
                    timer: 4000,
                    timerProgressBar: true
                });

            }


            // Error
            if (flashError) {

                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: flashError,
                    confirmButtonColor: '#1a3a6e'
                });

            }


            // Validation errors
            if (
                Array.isArray(flashErrors) &&
                flashErrors.length > 0
            ) {

                Swal.fire({
                    icon: 'warning',
                    title: 'Periksa form Anda',
                    html: flashErrors.join('<br>'),
                    confirmButtonColor: '#1a3a6e'
                });

            }

        });

    </script>


    {{-- =========================================================
         PAGE-SPECIFIC SCRIPTS
    ========================================================== --}}

    @stack('scripts')

</body>

</html>
