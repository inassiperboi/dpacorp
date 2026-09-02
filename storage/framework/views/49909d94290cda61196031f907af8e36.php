<?php $__env->startSection('meta-title', 'Visi & Misi — DPA Corp'); ?>
<?php $__env->startSection('content'); ?>
<div class="breadcrumb-bar">
    <ol class="breadcrumb-list">
        <li><a href="<?php echo e(url('/')); ?>">Beranda</a></li>
        <li>Visi & Misi</li>
    </ol>
</div>
<section style="background:linear-gradient(135deg,#0d1f45,#1a3a6e);padding:70px 5%;text-align:center;">
    <h1 style="font-family:'Poppins',sans-serif;font-size:42px;font-weight:800;color:#fff;margin-bottom:14px;">Visi & Misi</h1>
</section>
<section style="padding:80px 5%;">
    <div style="max-width:800px;margin:0 auto;">
        <div style="background:linear-gradient(135deg,#1a3a6e,#2952a3);border-radius:20px;padding:40px;margin-bottom:48px;text-align:center;">
            <div style="font-size:13px;font-weight:700;text-transform:uppercase;letter-spacing:2px;color:rgba(255,255,255,.6);margin-bottom:16px;">Visi</div>
            <p style="font-size:20px;font-weight:600;color:#fff;line-height:1.7;font-style:italic;">"<?php echo e($vision->isi_visi ?? 'Belum diisi.'); ?>"</p>
        </div>
        <h2 style="font-family:'Poppins',sans-serif;font-size:28px;font-weight:700;color:var(--primary);margin-bottom:28px;">Misi</h2>
        <div style="display:flex;flex-direction:column;gap:14px;">
            <?php $__currentLoopData = $missions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $misi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="display:flex;gap:16px;align-items:flex-start;background:var(--bg);border-radius:14px;padding:20px 24px;border:1px solid var(--border);">
                <div style="width:36px;height:36px;background:var(--primary);border-radius:10px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:14px;flex-shrink:0;"><?php echo e($i+1); ?></div>
                <p style="font-size:15px;color:var(--text);line-height:1.7;margin:0;padding-top:4px;"><?php echo e($misi->isi_misi); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('public.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH E:\dpacorp\resources\views/public/visi-misi.blade.php ENDPATH**/ ?>