<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ManagementMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManagementController extends Controller
{
    public function index()
    {
        $members = ManagementMember::orderBy('urutan')->get();
        return view('admin.management.index', compact('members'));
    }

    public function create()
    {
        return view('admin.management.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto'    => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['_token', 'foto']);
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('management', 'public');
        }

        ManagementMember::create($data);

        return redirect()->route('admin.management.index')
            ->with('success', 'Anggota manajemen berhasil ditambahkan.');
    }

    public function edit(ManagementMember $management)
    {
        $member = $management;
        return view('admin.management.edit', compact('member'));
    }

    public function update(Request $request, ManagementMember $management)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto'    => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['_token', '_method', 'foto']);
        if ($request->hasFile('foto')) {
            if ($management->foto) Storage::disk('public')->delete($management->foto);
            $data['foto'] = $request->file('foto')->store('management', 'public');
        }

        $management->update($data);

        return redirect()->route('admin.management.index')
            ->with('success', 'Anggota manajemen berhasil diperbarui.');
    }

    public function destroy(ManagementMember $management)
    {
        if ($management->foto) Storage::disk('public')->delete($management->foto);
        $management->delete();

        return redirect()->route('admin.management.index')
            ->with('success', 'Anggota manajemen berhasil dihapus.');
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->order as $item) {
            ManagementMember::where('id', $item['id'])->update(['urutan' => $item['order']]);
        }
        return response()->json(['status' => 'ok']);
    }
}
