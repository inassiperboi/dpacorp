@extends('admin.layouts.app')
@section('page-title', 'Berita')
{{-- @section('breadcrumb') / <a href="{{ route('admin.news-information.index') }}">Berita & Informasi</a> / Berita@endsection --}}

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Daftar Berita</h3>
        <a href="{{ route('admin.berita.create') }}" class="btn btn-primary btn-sm">+ Tambah Berita</a>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul</th>
                    <th>Negara</th>
                    <th>Tags</th>
                    <th>Slug</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td>
                        <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}"
                             style="height:52px;width:78px;object-fit:cover;border-radius:8px;">
                    </td>
                    <td>
                        <div style="font-weight:600;">{{ $item->title }}</div>
                        <div style="font-size:12px;color:var(--text-muted);">{{ Str::limit($item->summary, 80) }}</div>
                    </td>
                    <td>{{ $item->country }}</td>
                    <td style="max-width:180px;color:var(--text-muted);font-size:12px;">{{ Str::limit($item->tags, 60) }}</td>
                    <td style="font-family:monospace;font-size:12px;color:var(--text-muted);">{{ $item->slug }}</td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.berita.edit', $item) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('admin.berita.destroy', $item) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete(this.closest('form'), '{{ addslashes($item->title) }}')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted);">Belum ada berita.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
