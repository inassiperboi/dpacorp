<?php $__env->startSection('meta-title', 'Kontak Kami — DPA Corp'); ?>
<?php $__env->startSection('meta-description', 'Hubungi PT Dharma Putra Airlangga — alamat, telepon, email, dan form kontak online.'); ?>

<?php $__env->startSection('content'); ?>

<div class="breadcrumb-bar">
    <ol class="breadcrumb-list">
        <li><a href="<?php echo e(url('/')); ?>">Beranda</a></li>
        <li>Kontak</li>
    </ol>
</div>

<section style="background:linear-gradient(135deg,#0d1f45,#1a3a6e);padding:70px 5%;text-align:center;">
    <div class="section-label" style="color:#f0b84a;">Kami Siap Membantu</div>
    <h1 style="font-family:'Poppins',sans-serif;font-size:42px;font-weight:800;color:#fff;margin-bottom:14px;">Hubungi Kami</h1>
    <p style="font-size:16px;color:rgba(255,255,255,.75);max-width:540px;margin:0 auto;line-height:1.7;">
        Kirim pesan kepada kami dan tim akan segera merespons pertanyaan Anda.
    </p>
</section>

<section style="padding:80px 5%;">
    <div style="max-width:1100px;margin:0 auto;display:grid;grid-template-columns:1fr 1.4fr;gap:40px;align-items:start;">

        
        <div style="display:flex;flex-direction:column;gap:20px;">
            <div class="card-pub" style="padding:28px;">
                <h2 style="font-size:20px;font-weight:700;color:var(--primary);margin-bottom:24px;">Informasi Kontak</h2>
                <?php if($company->alamat): ?>
                <div style="display:flex;gap:14px;margin-bottom:20px;align-items:flex-start;">
                    <div style="width:42px;height:42px;background:#e0f2fe;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;">📍</div>
                    <div>
                        <div style="font-weight:600;font-size:14px;margin-bottom:4px;">Alamat</div>
                        <div style="font-size:13.5px;color:var(--text-muted);line-height:1.6;"><?php echo e($company->alamat); ?><?php echo e($company->kota ? ', '.$company->kota : ''); ?><?php echo e($company->kode_pos ? ' '.$company->kode_pos : ''); ?></div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if($company->telepon): ?>
                <div style="display:flex;gap:14px;margin-bottom:20px;align-items:flex-start;">
                    <div style="width:42px;height:42px;background:#dcfce7;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;">📞</div>
                    <div>
                        <div style="font-weight:600;font-size:14px;margin-bottom:4px;">Telepon</div>
                        <a href="tel:<?php echo e($company->telepon); ?>" style="font-size:13.5px;color:var(--primary-light);text-decoration:none;"><?php echo e($company->telepon); ?></a>
                        <?php if($company->whatsapp): ?>
                            <br><a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/','',$company->whatsapp)); ?>" target="_blank" style="font-size:13.5px;color:var(--primary-light);text-decoration:none;"><?php echo e($company->whatsapp); ?> (WA)</a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
                <?php if($company->email): ?>
                <div style="display:flex;gap:14px;margin-bottom:20px;align-items:flex-start;">
                    <div style="width:42px;height:42px;background:#fef3c7;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;">✉️</div>
                    <div>
                        <div style="font-weight:600;font-size:14px;margin-bottom:4px;">Email</div>
                        <a href="mailto:<?php echo e($company->email); ?>" style="font-size:13.5px;color:var(--primary-light);text-decoration:none;"><?php echo e($company->email); ?></a>
                    </div>
                </div>
                <?php endif; ?>
                <?php if($company->jam_operasional): ?>
                <div style="display:flex;gap:14px;align-items:flex-start;">
                    <div style="width:42px;height:42px;background:#f3e8ff;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0;">🕐</div>
                    <div>
                        <div style="font-weight:600;font-size:14px;margin-bottom:4px;">Jam Operasional</div>
                        <div style="font-size:13.5px;color:var(--text-muted);"><?php echo e($company->jam_operasional); ?></div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            
            <?php if($company->instagram || $company->tiktok || $company->youtube): ?>
            <div class="card-pub" style="padding:24px;">
                <h3 style="font-size:15px;font-weight:700;color:var(--primary);margin-bottom:16px;">Media Sosial</h3>
                <div style="display:flex;flex-direction:column;gap:10px;">
                    <?php if($company->instagram): ?>
                        <a href="https://instagram.com/<?php echo e(ltrim($company->instagram,'@')); ?>" target="_blank" rel="noopener" style="display:flex;align-items:center;gap:10px;font-size:14px;text-decoration:none;color:var(--text);padding:8px;border-radius:8px;transition:background .2s;" onmouseover="this.style.background='#f0f4ff'" onmouseout="this.style.background='transparent'">
                            📷 <span><?php echo e($company->instagram); ?></span>
                        </a>
                    <?php endif; ?>
                    <?php if($company->tiktok): ?>
                        <a href="https://tiktok.com/{{ ltrim($company->tiktok,'@') }}" target="_blank" rel="noopener" style="display:flex;align-items:center;gap:10px;font-size:14px;text-decoration:none;color:var(--text);padding:8px;border-radius:8px;transition:background .2s;" onmouseover="this.style.background='#f0f4ff'" onmouseout="this.style.background='transparent'">
                            🎵 <span><?php echo e($company->tiktok); ?></span>
                        </a>
                    <?php endif; ?>
                    <?php if($company->youtube): ?>
                        <a href="<?php echo e($company->youtube); ?>" target="_blank" rel="noopener" style="display:flex;align-items:center;gap:10px;font-size:14px;text-decoration:none;color:var(--text);padding:8px;border-radius:8px;transition:background .2s;" onmouseover="this.style.background='#f0f4ff'" onmouseout="this.style.background='transparent'">
                            ▶️ <span>YouTube</span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            
            <?php if($company->lat && $company->lng): ?>
            <div style="border-radius:14px;overflow:hidden;height:200px;">
                <iframe
                    src="https://maps.google.com/maps?q=<?php echo e($company->lat); ?>,<?php echo e($company->lng); ?>&z=16&output=embed"
                    width="100%" height="200" style="border:0;" allowfullscreen loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" title="Lokasi DPA Corp"></iframe>
            </div>
            <?php endif; ?>
        </div>

        
        <div class="card-pub" style="padding:32px;">
            <h2 style="font-size:20px;font-weight:700;color:var(--primary);margin-bottom:6px;">Kirim Pesan</h2>
            <p style="font-size:13.5px;color:var(--text-muted);margin-bottom:28px;">Isi form di bawah ini dan kami akan membalas secepatnya.</p>

            <form action="<?php echo e(route('public.kontak.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                
                <input type="text" name="website" style="display:none;" tabindex="-1" autocomplete="off">

                <div style="margin-bottom:20px;">
                    <label style="display:block;font-size:13px;font-weight:600;margin-bottom:7px;">Nama Lengkap <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="nama" value="<?php echo e(old('nama')); ?>"
                           style="width:100%;padding:12px 14px;border:1.5px solid var(--border);border-radius:10px;font-size:14px;outline:none;transition:border .2s;font-family:'Inter',sans-serif;"
                           placeholder="Masukkan nama lengkap Anda" required
                           onfocus="this.style.borderColor='#1a3a6e'" onblur="this.style.borderColor='var(--border)'">
                </div>

                <div style="margin-bottom:20px;">
                    <label style="display:block;font-size:13px;font-weight:600;margin-bottom:7px;">Email <span style="color:#ef4444;">*</span></label>
                    <input type="email" name="email" value="<?php echo e(old('email')); ?>"
                           style="width:100%;padding:12px 14px;border:1.5px solid var(--border);border-radius:10px;font-size:14px;outline:none;transition:border .2s;font-family:'Inter',sans-serif;"
                           placeholder="email@anda.com" required
                           onfocus="this.style.borderColor='#1a3a6e'" onblur="this.style.borderColor='var(--border)'">
                </div>

                <div style="margin-bottom:28px;">
                    <label style="display:block;font-size:13px;font-weight:600;margin-bottom:7px;">Pesan <span style="color:#ef4444;">*</span></label>
                    <textarea name="pesan" rows="6"
                              style="width:100%;padding:12px 14px;border:1.5px solid var(--border);border-radius:10px;font-size:14px;outline:none;transition:border .2s;resize:vertical;font-family:'Inter',sans-serif;"
                              placeholder="Tulis pesan atau pertanyaan Anda di sini..." required
                              onfocus="this.style.borderColor='#1a3a6e'" onblur="this.style.borderColor='var(--border)'"><?php echo e(old('pesan')); ?></textarea>
                </div>

                <button type="submit" class="btn-pub btn-pub-primary" style="width:100%;justify-content:center;font-size:15px;padding:14px;">
                    📬 Kirim Pesan
                </button>
            </form>
        </div>
    </div>
</section>


<script type="application/ld+json">
{
    "<?php $__contextArgs = [];
if (context()->has($__contextArgs[0])) :
if (isset($value)) { $__contextPrevious[] = $value; }
$value = context()->get($__contextArgs[0]); ?>": "https://schema.org",
    "@type": "LocalBusiness",
    "name": "<?php echo e($company->nama_resmi); ?>",
    "url": "<?php echo e(url('/')); ?>",
    "telephone": "<?php echo e($company->telepon ?? ''); ?>",
    "email": "<?php echo e($company->email ?? ''); ?>",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "<?php echo e($company->alamat ?? ''); ?>",
        "addressLocality": "<?php echo e($company->kota ?? ''); ?>",
        "addressRegion": "<?php echo e($company->provinsi ?? ''); ?>",
        "postalCode": "<?php echo e($company->kode_pos ?? ''); ?>",
        "addressCountry": "ID"
    }
    <?php if($company->lat && $company->lng): ?>
    ,"geo": {
        "@type": "GeoCoordinates",
        "latitude": <?php echo e($company->lat); ?>,
        "longitude": <?php echo e($company->lng); ?>

    }
    <?php endif; ?>
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('public.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\dpacorp\resources\views/public/kontak.blade.php ENDPATH**/ ?>