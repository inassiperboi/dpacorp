@extends('admin.layouts.app')
@section('page-title', 'Struktur Manajemen')
@section('breadcrumb') / Manajemen@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Struktur Manajemen</h3>
        <a href="{{ route('admin.management.create') }}" class="btn btn-primary btn-sm">+ Tambah Anggota</a>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $m)
                <tr>
                    <td>
                        <div style="width:44px;height:44px;border-radius:50%;overflow:hidden;background:linear-gradient(135deg,#e0f2fe,#bfdbfe);display:flex;align-items:center;justify-content:center;font-size:18px;font-weight:700;color:#1a3a6e;">
                            @if($m->foto)
                                <img src="{{ asset('storage/'.$m->foto) }}" alt="{{ $m->nama }}" style="width:100%;height:100%;object-fit:cover;">
                            @else
                                {{ strtoupper(substr($m->nama, 0, 1)) }}
                            @endif
                        </div>
                    </td>
                    <td style="font-weight:600;">{{ $m->nama }}</td>
                    <td>
                        <span class="badge badge-info">{{ $m->jabatan }}</span>
                    </td>
                    <td style="color:var(--text-muted);">{{ $m->urutan }}</td>
                    <td>
                        <span class="badge {{ $m->is_active ? 'badge-success' : 'badge-danger' }}">
                            {{ $m->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.management.edit', $m) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('admin.management.destroy', $m) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="confirmDelete(this.closest('form'), '{{ addslashes($m->nama) }}')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted);">
                        Belum ada anggota manajemen.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
