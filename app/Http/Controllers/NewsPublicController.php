<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\CompanyProfile;
use App\Models\Informasi;
use App\Models\SeoSetting;
use Illuminate\View\View;

class NewsPublicController extends Controller
{
    public function index(): View
    {
        $company = CompanyProfile::getInstance();
        $seo = SeoSetting::getInstance();
        $beritaItems = Berita::orderByDesc('created_at')->get();
        $informasiItems = Informasi::orderByDesc('created_at')->get();

        return view('public.berita-informasi.index', compact('company', 'seo', 'beritaItems', 'informasiItems'));
    }
}
