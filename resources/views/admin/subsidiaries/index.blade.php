@extends('admin.layouts.app')
@section('page-title', 'Anak Perusahaan')
@section('breadcrumb') / Anak Perusahaan@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Daftar Anak Perusahaan</h3>
        <a href="{{ route('admin.subsidiaries.create') }}" class="btn btn-primary btn-sm">+ Tambah</a>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Nama</th>
                    <th>Website</th>
                    <th>Layanan</th>
                    <th>Status</th>
                    <th>Urutan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subsidiaries as $sub)
                <tr>
                    <td>
                        @if($sub->logo)
                            <img src="{{ Storage::url($sub->logo) }}" alt="{{ $sub->logo_alt }}" style="height:36px;width:auto;object-fit:contain;border-radius:4px;">
                        @else
                            <div style="width:36px;height:36px;background:var(--bg);border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:16px;">🏢</div>
                        @endif
                    </td>
                    <td>
                        <div style="font-weight:600;font-size:13.5px;">{{ $sub->nama }}</div>
                        <div style="font-size:11px;color:var(--text-muted);">{{ $sub->deskripsi_singkat ? Str::limit($sub->deskripsi_singkat, 50) : '—' }}</div>
                    </td>
                    <td>
                        @if($sub->website_url)
                            <a href="{{ $sub->website_url }}" target="_blank" rel="noopener" style="color:var(--primary-light);font-size:12px;text-decoration:none;">
                                🔗 {{ parse_url($sub->website_url, PHP_URL_HOST) }}
                            </a>
                        @else
                            <span style="color:var(--text-muted);font-size:12px;">— (tampilkan modal)</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;flex-wrap:wrap;gap:4px;">
                            @foreach($sub->services->take(3) as $svc)
                                <span class="badge badge-info" style="font-size:10px;">{{ $svc->nama_layanan }}</span>
                            @endforeach
                            @if($sub->services->count() > 3)
                                <span class="badge badge-gray" style="font-size:10px;">+{{ $sub->services->count() - 3 }}</span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <span class="badge {{ $sub->is_active ? 'badge-success' : 'badge-danger' }}">
                            {{ $sub->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td style="color:var(--text-muted);">{{ $sub->order }}</td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.subsidiaries.edit', $sub) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('admin.subsidiaries.destroy', $sub) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="confirmDelete(this.closest('form'), '{{ $sub->nama }}')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
