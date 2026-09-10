<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ManagementStructure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManagementController extends Controller
{
    public function edit()
    {
        $structure = ManagementStructure::getInstance();
        return view('admin.management.edit', compact('structure'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|max:4096',
        ]);

        $structure = ManagementStructure::getInstance();

        if ($request->hasFile('image')) {
            if ($structure->image) {
                Storage::disk('public')->delete($structure->image);
            }
            $structure->image = $request->file('image')->store('management', 'public');
        }

        $structure->image_alt = $request->image_alt;
        $structure->save();

        return redirect()->route('admin.management.edit')
            ->with('success', 'Gambar struktur manajemen berhasil diperbarui.');
    }
}
