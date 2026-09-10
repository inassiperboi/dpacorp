<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\CompanyProfile;
use App\Models\SeoSetting;
use Illuminate\View\View;

class BeritaPublicController extends Controller
{
    public function index(): View
    {
        $company = CompanyProfile::getInstance();
        $seo = SeoSetting::getInstance();
        $items = Berita::orderByDesc('created_at')->get();

        return view('public.berita.index', compact('company', 'seo', 'items'));
    }

    public function show(string $slug): View
    {
        $company = CompanyProfile::getInstance();
        $seo = SeoSetting::getInstance();
        $berita = Berita::where('slug', $slug)->firstOrFail();

        return view('public.berita.show', compact('company', 'seo', 'berita'));
    }
}
