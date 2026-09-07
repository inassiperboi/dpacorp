<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    

    <title>
        <?php echo $__env->yieldContent(
            'meta-title',
            ($seo->default_meta_title ?? 'PT Dharma Putra Airlangga') . ' — DPA Corp'
        ); ?>
    </title>

    <meta
        name="description"
        content="<?php echo $__env->yieldContent(
            'meta-description',
            $seo->default_meta_description
                ?? 'PT Dharma Putra Airlangga (DPA Corp) adalah holding company milik Universitas Airlangga.'
        ); ?>"
    >

    <link rel="canonical" href="<?php echo e(url()->current()); ?>">


    

    <meta
        property="og:title"
        content="<?php echo $__env->yieldContent(
            'og-title',
            $seo->default_meta_title ?? 'DPA Corp'
        ); ?>"
    >

    <meta
        property="og:description"
        content="<?php echo $__env->yieldContent(
            'og-description',
            $seo->default_meta_description ?? ''
        ); ?>"
    >

    <meta
        property="og:url"
        content="<?php echo e(url()->current()); ?>"
    >

    <meta
        property="og:type"
        content="website"
    >

    <meta
        property="og:image"
        content="<?php echo $__env->yieldContent(
            'og-image',
            asset('images/og-default.jpg')
        ); ?>"
    >

    <meta
        name="twitter:card"
        content="summary_large_image"
    >


    

    <?php if(!empty($seo->google_site_verification)): ?>
        <meta
            name="google-site-verification"
            content="<?php echo e($seo->google_site_verification); ?>"
        >
    <?php endif; ?>


    

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap"
        rel="stylesheet"
    >


    

    <script
        src="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    </script>


    

    <?php echo app('Illuminate\Foundation\Vite')([
        'resources/css/app.css',
        'resources/js/app.js'
    ]); ?>


    

    <?php if(isset($company) && $company): ?>

        <?php
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
        ?>

        <script type="application/ld+json">
<?php echo json_encode(
    $organizationSchema,
    JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
); ?>

        </script>

    <?php endif; ?>


    

    <?php echo $__env->yieldPushContent('head'); ?>


    

    <?php if(!empty($seo->google_analytics_id)): ?>

        <script
            async
            src="https://www.googletagmanager.com/gtag/js?id=<?php echo e($seo->google_analytics_id); ?>"
        ></script>

        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag(
                'config',
                '<?php echo e($seo->google_analytics_id); ?>'
            );
        </script>

    <?php endif; ?>

</head>


<body>

    

    <nav class="navbar">

        
        <a href="<?php echo e(url('/')); ?>" class="navbar-brand">
    <img
        src="<?php echo e(asset('images/hero/logo.png')); ?>"
        alt="Logo PT Dharma Putra Airlangga"
    >
    <span class="brand-text">PT Dharma Putra Airlangga</span>
        </a>


        
        <div
            class="navbar-nav"
            id="navMenu"
        >

            <a
                href="<?php echo e(url('/')); ?>"
                class="nav-link <?php echo e(request()->is('/') ? 'active' : ''); ?>"
            >
                Beranda
            </a>


            <a
                href="<?php echo e(url('/tentang-kami')); ?>"
                class="nav-link <?php echo e(request()->is('tentang-kami') ? 'active' : ''); ?>"
            >
                Tentang Kami
            </a>


            <a
                href="<?php echo e(url('/visi-misi')); ?>"
                class="nav-link <?php echo e(request()->is('visi-misi') ? 'active' : ''); ?>"
            >
                Visi &amp; Misi
            </a>


            <a
                href="<?php echo e(url('/struktur-manajemen')); ?>"
                class="nav-link <?php echo e(request()->is('struktur-manajemen') ? 'active' : ''); ?>"
            >
                Manajemen
            </a>


            <a
                href="<?php echo e(url('/produk-layanan')); ?>"
                class="nav-link <?php echo e(request()->is('produk-layanan*') ? 'active' : ''); ?>"
            >
                Produk &amp; Layanan
            </a>


            <a
                href="<?php echo e(url('/anak-perusahaan')); ?>"
                class="nav-link <?php echo e(request()->is('anak-perusahaan') ? 'active' : ''); ?>"
            >
                Anak Perusahaan
            </a>


            <a
                href="<?php echo e(url('/kontak')); ?>"
                class="nav-link nav-cta <?php echo e(request()->is('kontak') ? 'active' : ''); ?>"
            >
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


    

    <main id="main-content">

        <?php echo $__env->yieldContent('content'); ?>

    </main>


    

    <footer>

        <div class="footer-grid">

            

            <div>

                <div class="footer-brand">
                    DPA <span>Corp</span>
                </div>


                <p class="footer-desc">

                    <?php echo e((isset($company) && $company)
                            ? ($company->tagline ?? '')
                            : 'Holding Company Universitas Airlangga — membangun ekosistem bisnis berbasis riset dan inovasi.'); ?>


                </p>


                
                <?php if(isset($company) && $company): ?>

                    <div class="footer-socials">

                        
                        <?php if(!empty($company->instagram)): ?>

                            <a
                                href="https://instagram.com/<?php echo e(ltrim($company->instagram, '@')); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="footer-social"
                                title="Instagram"
                                aria-label="Instagram"
                            >
                                📷
                            </a>

                        <?php endif; ?>


                        
                        <?php if(!empty($company->tiktok)): ?>

                            <a
                                href="https://tiktok.com/{{ ltrim($company->tiktok, '@') }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="footer-social"
                                title="TikTok"
                                aria-label="TikTok"
                            >
                                🎵
                            </a>

                        <?php endif; ?>


                        
                        <?php if(!empty($company->youtube)): ?>

                            <a
                                href="<?php echo e($company->youtube); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="footer-social"
                                title="YouTube"
                                aria-label="YouTube"
                            >
                                ▶️
                            </a>

                        <?php endif; ?>

                    </div>

                <?php endif; ?>

            </div>


            

            <div>

                <div class="footer-heading">
                    Navigasi
                </div>


                <a
                    href="<?php echo e(url('/')); ?>"
                    class="footer-link"
                >
                    Beranda
                </a>


                <a
                    href="<?php echo e(url('/tentang-kami')); ?>"
                    class="footer-link"
                >
                    Tentang Kami
                </a>


                <a
                    href="<?php echo e(url('/visi-misi')); ?>"
                    class="footer-link"
                >
                    Visi &amp; Misi
                </a>


                <a
                    href="<?php echo e(url('/struktur-manajemen')); ?>"
                    class="footer-link"
                >
                    Struktur Manajemen
                </a>

            </div>


            

            <div>

                <div class="footer-heading">
                    Layanan
                </div>


                <a
                    href="<?php echo e(url('/produk-layanan')); ?>"
                    class="footer-link"
                >
                    Produk &amp; Layanan
                </a>


                <a
                    href="<?php echo e(url('/anak-perusahaan')); ?>"
                    class="footer-link"
                >
                    Anak Perusahaan
                </a>


                <a
                    href="<?php echo e(url('/client')); ?>"
                    class="footer-link"
                >
                    Client Kami
                </a>


                <a
                    href="<?php echo e(url('/kontak')); ?>"
                    class="footer-link"
                >
                    Kontak
                </a>

            </div>


            

            <div>

                <div class="footer-heading">
                    Kontak
                </div>


                <?php if(isset($company) && $company): ?>

                    
                    <?php if(!empty($company->alamat)): ?>

                        <p style="font-size:13px;margin-bottom:8px;">
                            <?php echo e($company->alamat); ?>

                        </p>

                    <?php endif; ?>


                    
                    <?php if(!empty($company->telepon)): ?>

                        <a
                            href="tel:<?php echo e($company->telepon); ?>"
                            class="footer-link"
                        >
                            📞 <?php echo e($company->telepon); ?>

                        </a>

                    <?php endif; ?>


                    
                    <?php if(!empty($company->whatsapp)): ?>

                        <a
                            href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $company->whatsapp)); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="footer-link"
                        >
                            💬 WhatsApp
                        </a>

                    <?php endif; ?>


                    
                    <?php if(!empty($company->email)): ?>

                        <a
                            href="mailto:<?php echo e($company->email); ?>"
                            class="footer-link"
                        >
                            ✉️ <?php echo e($company->email); ?>

                        </a>

                    <?php endif; ?>

                <?php endif; ?>

            </div>

        </div>


        

        <div class="footer-bottom">

            <span>
                &copy; <?php echo e(date('Y')); ?>

                PT Dharma Putra Airlangga.
                Hak Cipta Dilindungi.
            </span>


            <span>
                Holding Company Universitas Airlangga
            </span>

        </div>

    </footer>


    

    <script>

        function toggleNav() {

            const navMenu = document.getElementById('navMenu');

            if (navMenu) {
                navMenu.classList.toggle('open');
            }

        }

    </script>


    

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const flashSuccess = <?php echo json_encode(session('success'), 15, 512) ?>;

            const flashError = <?php echo json_encode(session('error'), 15, 512) ?>;

            const flashErrors = <?php echo json_encode(
                $errors->any()
                    ? $errors->all()
                    : []
            , 15, 512) ?>;


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


    

    <?php echo $__env->yieldPushContent('scripts'); ?>

</body>

</html>
<?php /**PATH E:\dpacorp\resources\views/public/layouts/app.blade.php ENDPATH**/ ?>