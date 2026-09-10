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
                href="{{ route('public.news.index') }}"
                class="nav-link {{ request()->is('berita-informasi*') || request()->is('berita*') || request()->is('informasi*') ? 'active' : '' }}"
            >
                Berita &amp; Informasi
            </a>


            <a
                href="{{ url('/anak-perusahaan') }}"
                class="nav-link {{ request()->is('anak-perusahaan') ? 'active' : '' }}"
            >
                Anak Perusahaan
            </a>


            {{-- <a
                href="{{ url('/kontak') }}"
                class="nav-link nav-cta {{ request()->is('kontak') ? 'active' : '' }}"
            >
                Kontak
            </a> --}}

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

            <div id="footer-contact">

                <a href="{{ url('/') }}" class="footer-brand">
                    <img
                        src="{{ asset('images/hero/logo.png') }}"
                        alt="Logo PT Dharma Putra Airlangga"
                        width="46"
                        height="46"
                    >
                    <span class="footer-brand-text">PT Dharma Putra Airlangga</span>
                </a>


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
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2.5" y="2.5" width="19" height="19" rx="5.5" stroke="currentColor" stroke-width="1.8"/>
                                    <circle cx="12" cy="12" r="4.3" stroke="currentColor" stroke-width="1.8"/>
                                    <circle cx="17.4" cy="6.6" r="1.15" fill="currentColor"/>
                                </svg>
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
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.8 3.5c.5 1.9 1.8 3.2 3.7 3.4v2.7c-1.4.1-2.7-.3-3.7-1v6.1c0 3-2.4 5.3-5.3 5.3-3 0-5.3-2.4-5.3-5.3 0-3 2.4-5.3 5.3-5.3.3 0 .6 0 .9.1v2.8a2.6 2.6 0 00-.9-.2 2.6 2.6 0 100 5.2c1.4 0 2.6-1.1 2.6-2.6V3.5h2.7z" fill="currentColor"/>
                                </svg>
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
                                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="2.5" y="5.5" width="19" height="13" rx="4" stroke="currentColor" stroke-width="1.8"/>
                                    <path d="M10.3 9.6l4.6 2.4-4.6 2.4V9.6z" fill="currentColor"/>
                                </svg>
                            </a>

                        @endif

                    </div>

                @endif

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


                    {{-- Nomor WhatsApp --}}
                    @if(!empty($company->whatsapp))

                        <a
                            href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->whatsapp) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="footer-link footer-link-icon"
                        >
                            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2.5a9.5 9.5 0 00-8.2 14.3L2.5 21.5l4.8-1.3A9.5 9.5 0 1012 2.5z" stroke="currentColor" stroke-width="1.6"/>
                                <path d="M8.3 8.6c.2-.5.4-.5.6-.5h.5c.2 0 .4 0 .5.4.2.4.6 1.5.7 1.6.1.1.1.3 0 .5-.1.2-.2.3-.3.4-.1.2-.3.3-.1.6.2.4.9 1.4 1.9 2.3 1.3 1.1 2.2 1.5 2.5 1.6.3.1.4.1.6-.1.2-.2.7-.8.9-1 .2-.2.4-.2.6-.1l1.9.9c.2.1.4.2.4.4 0 .2 0 1.2-.4 1.6-.4.5-1.8 1.1-2.5 1.1-.7 0-2.1-.2-4.1-1.7-2.4-1.9-3.7-4.1-3.9-4.5-.2-.4-1.2-1.8-1.2-3.4 0-1.6.9-2.4 1.1-2.6z" fill="currentColor"/>
                            </svg>
                            {{ $company->whatsapp }}
                        </a>

                    @endif


                    {{-- Email --}}
                    @if(!empty($company->email))

                        <a
                            href="mailto:{{ $company->email }}"
                            class="footer-link footer-link-icon"
                        >
                            <svg viewBox="0 0 24 24" width="15" height="15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="2.5" y="4.5" width="19" height="15" rx="2.5" stroke="currentColor" stroke-width="1.6"/>
                                <path d="M3.5 6l8.5 6.5L20.5 6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            {{ $company->email }}
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
