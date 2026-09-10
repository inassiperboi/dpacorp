<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InformasiRequest;
use App\Models\Informasi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InformasiController extends Controller
{
    public function index()
    {
        $items = Informasi::orderByDesc('created_at')->get();

        return view('admin.informasi.index', compact('items'));
    }

    public function create()
    {
        return view('admin.informasi.create');
    }

    public function store(InformasiRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug']);
        $data['tags'] = $this->normalizeTags($data['tags']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('informasi', 'public');
        }

        $data['image_2'] = $this->storeExtraImages($request->file('image_2'), 'informasi');

        Informasi::create($data);

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Informasi berhasil ditambahkan.');
    }

    public function edit(Informasi $informasi)
    {
        return view('admin.informasi.edit', compact('informasi'));
    }

    public function update(InformasiRequest $request, Informasi $informasi)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug']);
        $data['tags'] = $this->normalizeTags($data['tags']);

        if ($request->hasFile('image')) {
            if ($informasi->image) {
                Storage::disk('public')->delete($informasi->image);
            }

            $data['image'] = $request->file('image')->store('informasi', 'public');
        } else {
            $data['image'] = $informasi->image;
        }

        $existingImages = $informasi->extraImages();
        $newImages = $this->storeExtraImages($request->file('image_2'), 'informasi');
        $data['image_2'] = json_encode(array_values(array_merge($existingImages, $newImages)));

        $informasi->update($data);

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Informasi berhasil diperbarui.');
    }

    public function destroy(Informasi $informasi)
    {
        if ($informasi->image) {
            Storage::disk('public')->delete($informasi->image);
        }

        foreach ($informasi->extraImages() as $imagePath) {
            Storage::disk('public')->delete($imagePath);
        }

        $informasi->delete();

        return redirect()->route('admin.informasi.index')
            ->with('success', 'Informasi berhasil dihapus.');
    }

    private function normalizeTags(string $tags): string
    {
        return collect(preg_split('/\r\n|\r|\n/', $tags))
            ->map(fn ($tag) => trim($tag))
            ->filter()
            ->values()
            ->implode(PHP_EOL);
    }

    /**
     * @param  array<int, \Illuminate\Http\UploadedFile>|null  $files
     */
    private function storeExtraImages(?array $files, string $directory): array
    {
        return collect($files ?? [])
            ->filter()
            ->map(fn ($file) => $file->store($directory, 'public'))
            ->values()
            ->all();
    }
}
