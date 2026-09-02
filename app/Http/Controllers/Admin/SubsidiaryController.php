<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subsidiary;
use App\Models\SubsidiaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SubsidiaryController extends Controller
{
    public function index()
    {
        $subsidiaries = Subsidiary::with('services')->orderBy('order')->get();
        return view('admin.subsidiaries.index', compact('subsidiaries'));
    }

    public function create()
    {
        return view('admin.subsidiaries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'         => 'required|string|max:255',
            'website_url'  => 'nullable|url',
            'logo'         => 'nullable|image|max:2048',
            'cover_image'  => 'nullable|image|max:4096',
            'email'        => 'nullable|email',
        ]);

        $data = $request->except(['_token', 'logo', 'cover_image', 'services']);
        $data['slug'] = Str::slug($request->nama);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('subsidiaries', 'public');
        }
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('subsidiaries', 'public');
        }

        $subsidiary = Subsidiary::create($data);

        // Simpan layanan
        if ($request->filled('services')) {
            foreach ($request->services as $i => $svc) {
                if (! empty($svc['nama_layanan'])) {
                    SubsidiaryService::create([
                        'subsidiary_id' => $subsidiary->id,
                        'nama_layanan'  => $svc['nama_layanan'],
                        'icon'          => $svc['icon'] ?? null,
                        'order'         => $i,
                    ]);
                }
            }
        }

        return redirect()->route('admin.subsidiaries.index')
            ->with('success', 'Anak perusahaan berhasil ditambahkan.');
    }

    public function edit(Subsidiary $subsidiary)
    {
        $subsidiary->load('services');
        return view('admin.subsidiaries.edit', compact('subsidiary'));
    }

    public function update(Request $request, Subsidiary $subsidiary)
    {
        $request->validate([
            'nama'         => 'required|string|max:255',
            'website_url'  => 'nullable|url',
            'logo'         => 'nullable|image|max:2048',
            'cover_image'  => 'nullable|image|max:4096',
            'email'        => 'nullable|email',
        ]);

        $data = $request->except(['_token', '_method', 'logo', 'cover_image', 'services']);

        if ($request->hasFile('logo')) {
            if ($subsidiary->logo) Storage::disk('public')->delete($subsidiary->logo);
            $data['logo'] = $request->file('logo')->store('subsidiaries', 'public');
        }
        if ($request->hasFile('cover_image')) {
            if ($subsidiary->cover_image) Storage::disk('public')->delete($subsidiary->cover_image);
            $data['cover_image'] = $request->file('cover_image')->store('subsidiaries', 'public');
        }

        $subsidiary->update($data);

        // Update layanan
        $subsidiary->services()->delete();
        if ($request->filled('services')) {
            foreach ($request->services as $i => $svc) {
                if (! empty($svc['nama_layanan'])) {
                    SubsidiaryService::create([
                        'subsidiary_id' => $subsidiary->id,
                        'nama_layanan'  => $svc['nama_layanan'],
                        'icon'          => $svc['icon'] ?? null,
                        'order'         => $i,
                    ]);
                }
            }
        }

        return redirect()->route('admin.subsidiaries.index')
            ->with('success', 'Anak perusahaan berhasil diperbarui.');
    }

    public function destroy(Subsidiary $subsidiary)
    {
        if ($subsidiary->logo) Storage::disk('public')->delete($subsidiary->logo);
        if ($subsidiary->cover_image) Storage::disk('public')->delete($subsidiary->cover_image);
        $subsidiary->delete();

        return redirect()->route('admin.subsidiaries.index')
            ->with('success', 'Anak perusahaan berhasil dihapus.');
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->order as $item) {
            Subsidiary::where('id', $item['id'])->update(['order' => $item['order']]);
        }
        return response()->json(['status' => 'ok']);
    }
}
