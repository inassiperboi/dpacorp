<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\Informasi;
use App\Models\SeoSetting;
use Illuminate\View\View;

class InformasiPublicController extends Controller
{
    public function index(): View
    {
        $company = CompanyProfile::getInstance();
        $seo = SeoSetting::getInstance();
        $items = Informasi::orderByDesc('created_at')->get();

        return view('public.informasi.index', compact('company', 'seo', 'items'));
    }

    public function show(string $slug): View
    {
        $company = CompanyProfile::getInstance();
        $seo = SeoSetting::getInstance();
        $informasi = Informasi::where('slug', $slug)->firstOrFail();

        return view('public.informasi.show', compact('company', 'seo', 'informasi'));
    }
}
