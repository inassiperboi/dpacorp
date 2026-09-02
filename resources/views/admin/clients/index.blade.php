@extends('admin.layouts.app')
@section('page-title', 'Client')
@section('breadcrumb') / Client@endsection

@section('content')
<div style="display:grid;grid-template-columns:1fr 1.5fr;gap:20px;align-items:start;">

    {{-- Form Tambah --}}
    <div class="card">
        <div class="card-header"><h3>+ Tambah Client</h3></div>
        <div class="card-body">
            <form action="{{ route('admin.clients.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nama Client <span class="required">*</span></label>
                    <input type="text" name="nama" class="form-control" required value="{{ old('nama') }}"
                           placeholder="Nama perusahaan/institusi">
                </div>
                <div class="form-group">
                    <label class="form-label">Logo</label>
                    <input type="file" name="logo" class="form-control" accept="image/*">
                    <div class="form-hint">Format PNG transparan direkomendasikan.</div>
                </div>
                <div class="form-group">
                    <label class="form-label">Alt Text Logo</label>
                    <input type="text" name="logo_alt" class="form-control" value="{{ old('logo_alt') }}"
                           placeholder="Logo [Nama Client]">
                </div>
                <div class="form-group">
                    <label class="form-label">Website (opsional)</label>
                    <input type="url" name="website" class="form-control" value="{{ old('website') }}"
                           placeholder="https://www.contoh.com">
                </div>
                <div class="form-group">
                    <label class="form-label">Urutan Tampil</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $clients->count() + 1) }}" min="0">
                </div>
                <div class="form-group" style="display:flex;align-items:center;gap:10px;">
                    <label class="toggle">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <span class="toggle-slider"></span>
                    </label>
                    <label class="form-label" style="margin:0;">Tampilkan di website</label>
                </div>
                <button type="submit" class="btn btn-primary">+ Tambah Client</button>
            </form>
        </div>
    </div>

    {{-- Daftar Client --}}
    <div class="card">
        <div class="card-header">
            <h3>💼 Daftar Client</h3>
            <span class="badge badge-info">{{ $clients->count() }} client</span>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Nama</th>
                        <th>Website</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $c)
                    <tr>
                        <td>
                            @if($c->logo)
                                <img src="{{ asset('storage/'.$c->logo) }}" alt="{{ $c->logo_alt }}"
                                     style="height:32px;width:auto;max-width:80px;object-fit:contain;">
                            @else
                                <span style="font-size:18px;">🏢</span>
                            @endif
                        </td>
                        <td style="font-weight:600;">{{ $c->nama }}</td>
                        <td>
                            @if($c->website)
                                <a href="{{ $c->website }}" target="_blank" style="font-size:12px;color:var(--primary-light);">↗ Link</a>
                            @else
                                <span style="color:var(--text-muted);font-size:12px;">—</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $c->is_active ? 'badge-success' : 'badge-danger' }}">
                                {{ $c->is_active ? 'Aktif' : 'Off' }}
                            </span>
                        </td>
                        <td>
                            <form action="{{ route('admin.clients.destroy', $c) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm"
                                        onclick="confirmDelete(this.closest('form'), '{{ addslashes($c->nama) }}')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align:center;padding:30px;color:var(--text-muted);">Belum ada client.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
