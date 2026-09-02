<?php $__env->startSection('meta-title', 'Tentang Kami — PT Dharma Putra Airlangga'); ?>
<?php $__env->startSection('meta-description', 'Sejarah, legalitas, dan KBLI PT Dharma Putra Airlangga (DPA Corp), holding company Universitas Airlangga yang berdiri sejak 2009.'); ?>

<?php $__env->startSection('content'); ?>
<div class="breadcrumb-bar">
    <ol class="breadcrumb-list">
        <li><a href="<?php echo e(url('/')); ?>">Beranda</a></li>
        <li>Tentang Kami</li>
    </ol>
</div>

<section style="background:linear-gradient(135deg,#0d1f45,#1a3a6e);padding:70px 5%;text-align:center;">
    <div class="section-label" style="color:#f0b84a;">Mengenal DPA Corp</div>
    <h1 style="font-family:'Poppins',sans-serif;font-size:42px;font-weight:800;color:#fff;margin-bottom:14px;">Tentang Kami</h1>
    <p style="font-size:16px;color:rgba(255,255,255,.75);max-width:600px;margin:0 auto;line-height:1.7;">
        PT Dharma Putra Airlangga adalah holding company yang lahir dari rahim Universitas Airlangga, dibangun untuk menjadi jembatan antara akademisi dan dunia bisnis.
    </p>
</section>


<section style="padding:80px 5%;">
    <div style="max-width:900px;margin:0 auto;">
        <div class="section-label">Perjalanan Kami</div>
        <h2 class="section-title">Sejarah Perusahaan</h2>
        <div style="font-size:15px;color:var(--text-muted);line-height:1.85;margin-bottom:60px;">
            PT Dharma Putra Airlangga (DPA Corp) merupakan holding company milik Universitas Airlangga yang didirikan sebagai entitas bisnis untuk mendukung implementasi status Perguruan Tinggi Negeri Berbadan Hukum (PTNBH) Universitas Airlangga. Perusahaan ini berkomitmen untuk mengintegrasikan nilai-nilai akademis dengan praktik bisnis yang beretika dan berkelanjutan.
        </div>

        
        <?php if($timelines->count()): ?>
        <div style="position:relative;padding-left:30px;">
            <div style="position:absolute;left:12px;top:0;bottom:0;width:2px;background:linear-gradient(to bottom,var(--primary),var(--accent));border-radius:2px;"></div>
            <?php $__currentLoopData = $timelines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="position:relative;margin-bottom:36px;">
                <div style="position:absolute;left:-26px;top:4px;width:16px;height:16px;background:<?php echo e($loop->first ? 'var(--accent)' : 'var(--primary)'); ?>;border-radius:50%;border:3px solid #fff;box-shadow:0 0 0 3px <?php echo e($loop->first ? 'rgba(232,160,32,.25)' : 'rgba(26,58,110,.25)'); ?>;"></div>
                <div style="background:<?php echo e($loop->first ? 'linear-gradient(135deg,#fef3c7,#fde68a)' : 'var(--bg)'); ?>;border-radius:14px;padding:20px 24px;border:1px solid <?php echo e($loop->first ? '#fde68a' : 'var(--border)'); ?>;">
                    <div style="font-size:13px;font-weight:700;color:<?php echo e($loop->first ? '#92400e' : 'var(--accent)'); ?>;text-transform:uppercase;letter-spacing:1px;margin-bottom:6px;"><?php echo e($tl->year); ?></div>
                    <div style="font-weight:700;font-size:16px;color:var(--primary);margin-bottom:6px;"><?php echo e($tl->title); ?></div>
                    <?php if($tl->description): ?>
                        <p style="font-size:13.5px;color:var(--text-muted);line-height:1.6;margin:0;"><?php echo e($tl->description); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </div>
</section>


<?php if($legals->count()): ?>
<section style="padding:60px 5%;background:var(--bg);">
    <div style="max-width:900px;margin:0 auto;">
        <div class="section-label">Legalitas</div>
        <h2 class="section-title">Data Hukum Perusahaan</h2>
        <div style="background:#fff;border-radius:16px;border:1px solid var(--border);overflow:hidden;">
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
                <thead style="background:var(--primary);">
                    <tr>
                        <th style="padding:14px 20px;text-align:left;color:#fff;font-size:13px;font-weight:600;width:200px;">Jenis Dokumen</th>
                        <th style="padding:14px 20px;text-align:left;color:#fff;font-size:13px;font-weight:600;">Nomor</th>
                        <th style="padding:14px 20px;text-align:left;color:#fff;font-size:13px;font-weight:600;">Tanggal</th>
                        <th style="padding:14px 20px;text-align:left;color:#fff;font-size:13px;font-weight:600;">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $legals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="<?php echo e($loop->even ? 'background:#f8fafc;' : ''); ?>">
                        <td style="padding:14px 20px;font-weight:600;color:var(--primary);"><?php echo e($doc->label); ?></td>
                        <td style="padding:14px 20px;color:var(--text-muted);"><?php echo e($doc->nomor ?? '—'); ?></td>
                        <td style="padding:14px 20px;color:var(--text-muted);"><?php echo e($doc->tanggal ? $doc->tanggal->format('d/m/Y') : '—'); ?></td>
                        <td style="padding:14px 20px;color:var(--text-muted);font-size:13px;"><?php echo e($doc->keterangan ?? ($doc->notaris ? 'Notaris: '.$doc->notaris : '—')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php endif; ?>


<?php if($kbliItems->count()): ?>
<section style="padding:60px 5%;">
    <div style="max-width:900px;margin:0 auto;">
        <div class="section-label">Klasifikasi Baku</div>
        <h2 class="section-title">Kode KBLI</h2>
        <div style="background:#fff;border-radius:16px;border:1px solid var(--border);overflow:hidden;">
            <table style="width:100%;border-collapse:collapse;font-size:14px;">
                <thead style="background:linear-gradient(135deg,#1a3a6e,#2952a3);">
                    <tr>
                        <th style="padding:14px 20px;text-align:left;color:#fff;font-size:13px;font-weight:600;width:160px;">Kode KBLI</th>
                        <th style="padding:14px 20px;text-align:left;color:#fff;font-size:13px;font-weight:600;">Judul Kegiatan Usaha</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $kbliItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kbli): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="<?php echo e($loop->even ? 'background:#f8fafc;' : ''); ?>">
                        <td style="padding:13px 20px;font-weight:700;color:var(--accent);font-family:monospace;font-size:15px;"><?php echo e($kbli->kode_kbli); ?></td>
                        <td style="padding:13px 20px;color:var(--text);"><?php echo e($kbli->judul_kbli); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('public.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\dpacorp\resources\views/public/tentang-kami.blade.php ENDPATH**/ ?>