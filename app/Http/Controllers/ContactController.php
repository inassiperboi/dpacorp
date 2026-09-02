<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\ContactMessage;
use App\Models\SeoSetting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $company = CompanyProfile::getInstance();
        $seo     = SeoSetting::getInstance();
        return view('public.kontak', compact('company', 'seo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:255',
            'email' => 'required|email',
            'pesan' => 'required|string|min:10',
            // Honeypot
            'website' => 'max:0',
        ], [
            'nama.required'  => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'pesan.required' => 'Pesan wajib diisi.',
            'pesan.min'      => 'Pesan terlalu pendek (min. 10 karakter).',
            'website.max'    => 'Terdeteksi sebagai spam.',
        ]);

        ContactMessage::create([
            'nama'  => $request->nama,
            'email' => $request->email,
            'pesan' => $request->pesan,
        ]);

        return redirect()->route('public.kontak')
            ->with('success', 'Pesan Anda berhasil terkirim. Kami akan segera menghubungi Anda!');
    }
}
