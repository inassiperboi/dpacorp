@extends('admin.layouts.app')
@section('page-title', 'Produk & Layanan')
@section('breadcrumb') / Produk & Layanan@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3>📦 Daftar Produk & Layanan</h3>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">+ Tambah Produk</a>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Thumbnail</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Slug</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $prod)
                <tr>
                    <td>
                        @if($prod->thumbnail)
                            <img src="{{ asset('storage/'.$prod->thumbnail) }}" alt="{{ $prod->thumbnail_alt }}"
                                 style="height:44px;width:66px;object-fit:cover;border-radius:6px;">
                        @else
                            <div style="width:66px;height:44px;background:var(--bg);border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:20px;">📦</div>
                        @endif
                    </td>
                    <td>
                        <div style="font-weight:600;">{{ $prod->nama }}</div>
                        <div style="font-size:12px;color:var(--text-muted);">{{ Str::limit($prod->deskripsi_singkat, 50) }}</div>
                    </td>
                    <td>
                        @if($prod->kategori)
                            <span class="badge badge-info">{{ $prod->kategori }}</span>
                        @else
                            <span style="color:var(--text-muted);font-size:12px;">—</span>
                        @endif
                    </td>
                    <td style="font-family:monospace;font-size:12px;color:var(--text-muted);">{{ $prod->slug }}</td>
                    <td style="color:var(--text-muted);">{{ $prod->order }}</td>
                    <td>
                        <span class="badge {{ $prod->is_active ? 'badge-success' : 'badge-danger' }}">
                            {{ $prod->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.products.edit', $prod) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('admin.products.destroy', $prod) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="confirmDelete(this.closest('form'), '{{ addslashes($prod->nama) }}')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:40px;color:var(--text-muted);">
                        Belum ada produk. <a href="{{ route('admin.products.create') }}" style="color:var(--primary-light);">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
