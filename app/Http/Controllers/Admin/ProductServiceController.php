<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductService;
use App\Models\ProductServiceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductServiceController extends Controller
{
    public function index()
    {
        $products = ProductService::with('images')->orderBy('order')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:255',
            'thumbnail'  => 'nullable|image|max:4096',
            'galeri.*'   => 'nullable|image|max:4096',
        ]);

        $data         = $request->except(['_token', 'thumbnail', 'galeri']);
        $data['slug'] = Str::slug($request->nama);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('products', 'public');
        }

        $product = ProductService::create($data);

        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $i => $img) {
                ProductServiceImage::create([
                    'product_service_id' => $product->id,
                    'image'              => $img->store('products/gallery', 'public'),
                    'alt_text'           => $request->input("galeri_alt.{$i}"),
                    'order'              => $i,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk/Layanan berhasil ditambahkan.');
    }

    public function edit(ProductService $product)
    {
        $product->load('images');
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, ProductService $product)
    {
        $request->validate([
            'nama'       => 'required|string|max:255',
            'thumbnail'  => 'nullable|image|max:4096',
            'galeri.*'   => 'nullable|image|max:4096',
        ]);

        $data = $request->except(['_token', '_method', 'thumbnail', 'galeri']);
        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('thumbnail')) {
            if ($product->thumbnail) Storage::disk('public')->delete($product->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('products', 'public');
        }

        $product->update($data);

        if ($request->hasFile('galeri')) {
            foreach ($request->file('galeri') as $i => $img) {
                ProductServiceImage::create([
                    'product_service_id' => $product->id,
                    'image'              => $img->store('products/gallery', 'public'),
                    'alt_text'           => $request->input("galeri_alt.{$i}"),
                    'order'              => $product->images()->count() + $i,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk/Layanan berhasil diperbarui.');
    }

    public function destroy(ProductService $product)
    {
        if ($product->thumbnail) Storage::disk('public')->delete($product->thumbnail);
        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk/Layanan berhasil dihapus.');
    }

    public function destroyImage(ProductServiceImage $image)
    {
        Storage::disk('public')->delete($image->image);
        $image->delete();
        return response()->json(['status' => 'ok']);
    }
}
