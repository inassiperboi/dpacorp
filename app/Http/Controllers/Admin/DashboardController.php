<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\ContactMessage;
use App\Models\ManagementMember;
use App\Models\ProductService;
use App\Models\Subsidiary;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'pesan_belum_dibaca'  => ContactMessage::where('is_read', false)->count(),
            'total_pesan'         => ContactMessage::count(),
            'produk_aktif'        => ProductService::where('is_active', true)->count(),
            'anak_perusahaan'     => Subsidiary::where('is_active', true)->count(),
            'manajemen'           => ManagementMember::where('is_active', true)->count(),
            'total_user'          => User::count(),
        ];

        $pesan_terbaru = ContactMessage::latest()->take(5)->get();
        $company       = CompanyProfile::getInstance();

        return view('admin.dashboard.index', compact('stats', 'pesan_terbaru', 'company'));
    }
}
