<?php

use Illuminate\Support\Facades\Route;

// ─── Public Controllers ───────────────────────────────────────────────────────
use App\Http\Controllers\ContactController;

// ─── Admin Controllers ────────────────────────────────────────────────────────
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\SubsidiaryController;
use App\Http\Controllers\Admin\ProductServiceController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\Admin\AboutContentController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactMessageController;

// ═══════════════════════════════════════════════════════════════════════════════
// PUBLIC ROUTES — Halaman utama website DPA Corp
// ═══════════════════════════════════════════════════════════════════════════════

Route::get('/', function () {
    $company     = \App\Models\CompanyProfile::getInstance();
    $subsidiaries = \App\Models\Subsidiary::with('services')->where('is_active', true)->orderBy('order')->get();
    $products    = \App\Models\ProductService::where('is_active', true)->orderBy('order')->take(4)->get();
    $clients     = \App\Models\Client::where('is_active', true)->orderBy('order')->get();
    $seo         = \App\Models\SeoSetting::getInstance();
    return view('public.home', compact('company', 'subsidiaries', 'products', 'clients', 'seo'));
})->name('public.home');

Route::get('/tentang-kami', function () {
    $company   = \App\Models\CompanyProfile::getInstance();
    $timelines = \App\Models\HistoryTimeline::where('is_active', true)->orderBy('order')->get();
    $legals    = \App\Models\LegalDocument::where('is_active', true)->orderBy('order')->get();
    $kbliItems = \App\Models\KbliItem::orderBy('order')->get();
    $seo       = \App\Models\SeoSetting::getInstance();
    return view('public.tentang-kami', compact('company', 'timelines', 'legals', 'kbliItems', 'seo'));
})->name('public.about');

Route::get('/visi-misi', function () {
    $company  = \App\Models\CompanyProfile::getInstance();
    $vision   = \App\Models\Vision::getInstance();
    $missions = \App\Models\MissionPoint::where('is_active', true)->orderBy('order')->get();
    $seo      = \App\Models\SeoSetting::getInstance();
    return view('public.visi-misi', compact('company', 'vision', 'missions', 'seo'));
})->name('public.vision');

Route::get('/struktur-manajemen', function () {
    $company = \App\Models\CompanyProfile::getInstance();
    $structure = \App\Models\ManagementStructure::getInstance();
    $seo     = \App\Models\SeoSetting::getInstance();
    return view('public.struktur-manajemen', compact('company', 'structure', 'seo'));
})->name('public.management');

Route::get('/produk-layanan', function () {
    $company  = \App\Models\CompanyProfile::getInstance();
    $products = \App\Models\ProductService::with('images')->where('is_active', true)->orderBy('order')->get();
    $seo      = \App\Models\SeoSetting::getInstance();
    return view('public.produk-layanan', compact('company', 'products', 'seo'));
})->name('public.products');

Route::get('/produk-layanan/{slug}', function (string $slug) {
    $company = \App\Models\CompanyProfile::getInstance();
    $product = \App\Models\ProductService::with('images')->where('slug', $slug)->where('is_active', true)->firstOrFail();
    $seo     = \App\Models\SeoSetting::getInstance();
    return view('public.produk-detail', compact('company', 'product', 'seo'));
})->name('public.product.show');

Route::get('/anak-perusahaan', function () {
    $company      = \App\Models\CompanyProfile::getInstance();
    $subsidiaries = \App\Models\Subsidiary::with('services')->where('is_active', true)->orderBy('order')->get();
    $seo          = \App\Models\SeoSetting::getInstance();
    return view('public.anak-perusahaan', compact('company', 'subsidiaries', 'seo'));
})->name('public.subsidiaries');

Route::get('/client', function () {
    $company = \App\Models\CompanyProfile::getInstance();
    $clients = \App\Models\Client::where('is_active', true)->orderBy('order')->get();
    $seo     = \App\Models\SeoSetting::getInstance();
    return view('public.client', compact('company', 'clients', 'seo'));
})->name('public.clients');

Route::get('/kontak', [ContactController::class, 'index'])->name('public.kontak');
Route::post('/kontak', [ContactController::class, 'store'])->name('public.kontak.store');

// ═══════════════════════════════════════════════════════════════════════════════
// ADMIN AUTH — Route tersembunyi (bukan /admin/login)
// URL: /cp-dpa/masuk dan /cp-dpa/keluar
// ═══════════════════════════════════════════════════════════════════════════════

Route::prefix('cp-dpa')->name('cp.')->group(function () {
    Route::get('/masuk', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/masuk', [AuthController::class, 'login'])->name('login.post');
    Route::post('/keluar', [AuthController::class, 'logout'])->name('logout');
});

// ═══════════════════════════════════════════════════════════════════════════════
// ADMIN PANEL — Semua dilindungi middleware AdminAuth
// ═══════════════════════════════════════════════════════════════════════════════
//
// PENTING: grup ini sudah diberi ->name('admin.'), jadi SETIAP nama route di
// dalamnya otomatis diawali "admin.". Jangan tambahkan prefix "admin." lagi
// secara manual di ->name()/->names() di dalam grup ini — itu penyebab bug
// "Route [admin.subsidiaries.create] not defined" (nama asli jadi
// admin.admin.subsidiaries.create).
// ═══════════════════════════════════════════════════════════════════════════════

Route::prefix('panel')->name('admin.')->middleware(['web', 'admin.auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ── User Management (admin only) ──────────────────────────────────────────
    Route::middleware('admin.auth:admin')->group(function () {
        Route::resource('/users', UserController::class)->except(['show']);
    });

    // ── Company Profile & SEO ─────────────────────────────────────────────────
    Route::get('/profil-perusahaan', [CompanyProfileController::class, 'edit'])->name('company-profile.edit');
    Route::put('/profil-perusahaan', [CompanyProfileController::class, 'update'])->name('company-profile.update');
    Route::put('/seo-settings', [CompanyProfileController::class, 'updateSeo'])->name('seo-settings.update');

    // ── Anak Perusahaan ───────────────────────────────────────────────────────
    Route::resource('/anak-perusahaan', SubsidiaryController::class)
        ->except(['show'])
        ->names('subsidiaries')
        ->parameters(['anak-perusahaan' => 'subsidiary']);
    Route::post('/anak-perusahaan/order', [SubsidiaryController::class, 'updateOrder'])->name('subsidiaries.order');

    // ── Produk & Layanan ──────────────────────────────────────────────────────
    Route::resource('/produk-layanan', ProductServiceController::class)
        ->except(['show'])
        ->names('products')
        ->parameters(['produk-layanan' => 'product']);
    Route::delete('/produk-layanan/image/{image}', [ProductServiceController::class, 'destroyImage'])->name('products.image.destroy');

    // ── Struktur Manajemen ────────────────────────────────────────────────────
    // Route::resource('/manajemen', ManagementController::class)
    //     ->except(['show'])
    //     ->names('management')
    //     ->parameters(['manajemen' => 'management']);
    // Route::post('/manajemen/order', [ManagementController::class, 'updateOrder'])->name('management.order');
    Route::get('/manajemen', [ManagementController::class, 'edit'])->name('management.edit');
    Route::put('/manajemen', [ManagementController::class, 'update'])->name('management.update');
    // ── Konten Tentang Kami ───────────────────────────────────────────────────
    Route::get('/tentang/sejarah', [AboutContentController::class, 'historyIndex'])->name('about.history');
    Route::post('/tentang/sejarah', [AboutContentController::class, 'historyStore'])->name('about.history.store');
    Route::put('/tentang/sejarah/{timeline}', [AboutContentController::class, 'historyUpdate'])->name('about.history.update');
    Route::delete('/tentang/sejarah/{timeline}', [AboutContentController::class, 'historyDestroy'])->name('about.history.destroy');

    Route::get('/tentang/legalitas', [AboutContentController::class, 'legalIndex'])->name('about.legal');
    Route::post('/tentang/legalitas', [AboutContentController::class, 'legalStore'])->name('about.legal.store');
    Route::put('/tentang/legalitas/{legal}', [AboutContentController::class, 'legalUpdate'])->name('about.legal.update');
    Route::delete('/tentang/legalitas/{legal}', [AboutContentController::class, 'legalDestroy'])->name('about.legal.destroy');

    Route::post('/tentang/kbli', [AboutContentController::class, 'kbliStore'])->name('about.kbli.store');
    Route::put('/tentang/kbli/{kbli}', [AboutContentController::class, 'kbliUpdate'])->name('about.kbli.update');
    Route::delete('/tentang/kbli/{kbli}', [AboutContentController::class, 'kbliDestroy'])->name('about.kbli.destroy');

    Route::get('/tentang/visi-misi', [AboutContentController::class, 'visionMissionIndex'])->name('about.vision-mission');
    Route::put('/tentang/visi', [AboutContentController::class, 'visionUpdate'])->name('about.vision.update');
    Route::post('/tentang/misi', [AboutContentController::class, 'missionStore'])->name('about.mission.store');
    Route::put('/tentang/misi/{mission}', [AboutContentController::class, 'missionUpdate'])->name('about.mission.update');
    Route::delete('/tentang/misi/{mission}', [AboutContentController::class, 'missionDestroy'])->name('about.mission.destroy');

    // ── Clients ───────────────────────────────────────────────────────────────
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');

    // ── Pesan Kontak ──────────────────────────────────────────────────────────
    Route::get('/pesan', [ContactMessageController::class, 'index'])->name('contacts.index');
    Route::get('/pesan/{contactMessage}', [ContactMessageController::class, 'show'])->name('contacts.show');
    Route::delete('/pesan/{contactMessage}', [ContactMessageController::class, 'destroy'])->name('contacts.destroy');
    Route::post('/pesan/{contactMessage}/baca', [ContactMessageController::class, 'markRead'])->name('contacts.mark-read');
});
