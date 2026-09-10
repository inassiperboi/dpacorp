<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BeritaRequest;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $items = Berita::orderByDesc('created_at')->get();

        return view('admin.berita.index', compact('items'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(BeritaRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug']);
        $data['tags'] = $this->normalizeTags($data['tags']);
        $data['image'] = $request->file('image')->store('berita', 'public');

        $data['image_2'] = $this->storeExtraImages($request->file('image_2'), 'berita');

        Berita::create($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Berita $berita)
    {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(BeritaRequest $request, Berita $berita)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug']);
        $data['tags'] = $this->normalizeTags($data['tags']);

        if ($request->hasFile('image')) {
            if ($berita->image) {
                Storage::disk('public')->delete($berita->image);
            }

            $data['image'] = $request->file('image')->store('berita', 'public');
        } else {
            $data['image'] = $berita->image;
        }

        $existingImages = $berita->extraImages();
        $newImages = $this->storeExtraImages($request->file('image_2'), 'berita');
        $data['image_2'] = json_encode(array_values(array_merge($existingImages, $newImages)));

        $berita->update($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        if ($berita->image) {
            Storage::disk('public')->delete($berita->image);
        }

        foreach ($berita->extraImages() as $imagePath) {
            Storage::disk('public')->delete($imagePath);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
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
