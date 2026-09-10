<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Informasi;

class NewsInformationController extends Controller
{
    public function index()
    {
        $beritaCount = Berita::count();
        $informasiCount = Informasi::count();

        return view('admin.news-information.index', compact('beritaCount', 'informasiCount'));
    }
}
