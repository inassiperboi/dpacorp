@extends('admin.layouts.app')
@section('page-title', 'Legalitas & KBLI')
@section('breadcrumb') / <a href="{{ route('admin.about.legal') }}">Tentang Kami</a> / Legalitas@endsection

@section('content')
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

    {{-- Dokumen Legalitas --}}
    <div style="display:flex;flex-direction:column;gap:20px;">
        <div class="card">
            <div class="card-header"><h3>📄 Tambah Dokumen Legal</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.about.legal.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Jenis Dokumen <span class="required">*</span></label>
                        <input type="text" name="label" class="form-control" required value="{{ old('label') }}"
                               placeholder="Contoh: Akta Pendirian, NPWP, NIB">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jenis (kode internal)</label>
                        <select name="jenis" class="form-control form-select">
                            <option value="akta_pendirian">Akta Pendirian</option>
                            <option value="akta_perubahan">Akta Perubahan</option>
                            <option value="sk_kemenkumham">SK Kemenkumham</option>
                            <option value="npwp">NPWP</option>
                            <option value="nib">NIB</option>
                            <option value="siup">SIUP</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nomor Dokumen</label>
                        <input type="text" name="nomor" class="form-control" value="{{ old('nomor') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Notaris</label>
                        <input type="text" name="notaris" class="form-control" value="{{ old('notaris') }}" placeholder="Nama notaris (jika ada)">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="2"
                                  placeholder="Keterangan tambahan">{{ old('keterangan') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', $legals->count() + 1) }}" min="0">
                    </div>
                    <button type="submit" class="btn btn-primary">+ Tambah Dokumen</button>
                </form>
            </div>
        </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:20px;">
        <div class="card">
            <div class="card-header">
                <h3>📋 Daftar Dokumen Legal</h3>
                <span class="badge badge-info">{{ $legals->count() }} dokumen</span>
            </div>
            @if($legals->isEmpty())
            <div style="padding:30px;text-align:center;color:var(--text-muted);">Belum ada dokumen.</div>
            @endif
            @foreach($legals as $doc)
            <div style="border-bottom:1px solid var(--border);padding:14px 20px;display:flex;align-items:flex-start;gap:12px;">
                <div style="flex:1;min-width:0;">
                    <div style="font-weight:600;font-size:13.5px;">{{ $doc->label }}</div>
                    @if($doc->nomor)<div style="font-size:12px;color:var(--text-muted);">No: {{ $doc->nomor }}</div>@endif
                    @if($doc->tanggal)<div style="font-size:12px;color:var(--text-muted);">Tgl: {{ $doc->tanggal->format('d/m/Y') }}</div>@endif
                    @if($doc->notaris)<div style="font-size:12px;color:var(--text-muted);">Notaris: {{ $doc->notaris }}</div>@endif
                    @if($doc->keterangan)<div style="font-size:12px;color:var(--text-muted);">{{ $doc->keterangan }}</div>@endif
                </div>
                <form action="{{ route('admin.about.legal.destroy', $doc) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm btn-icon"
                            onclick="confirmDelete(this.closest('form'), '{{ addslashes($doc->label) }}')">✕</button>
                </form>
            </div>
            @endforeach
        </div>

        {{-- KBLI --}}
        <div class="card">
            <div class="card-header"><h3>🏷️ Tambah Kode KBLI</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.about.kbli.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Kode KBLI <span class="required">*</span></label>
                        <input type="text" name="kode_kbli" class="form-control" required value="{{ old('kode_kbli') }}"
                               placeholder="79110" style="font-family:monospace;">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Judul Kegiatan Usaha <span class="required">*</span></label>
                        <input type="text" name="judul_kbli" class="form-control" required value="{{ old('judul_kbli') }}"
                               placeholder="Agen Perjalanan Wisata">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', $kbliItems->count() + 1) }}" min="0">
                    </div>
                    <button type="submit" class="btn btn-primary">+ Tambah KBLI</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>📊 Daftar Kode KBLI</h3>
                <span class="badge badge-info">{{ $kbliItems->count() }} kode</span>
            </div>
            @foreach($kbliItems as $kbli)
            <div style="border-bottom:1px solid var(--border);padding:12px 20px;display:flex;align-items:center;gap:12px;">
                <div style="font-family:monospace;font-size:15px;font-weight:700;color:var(--accent);flex-shrink:0;width:60px;">{{ $kbli->kode_kbli }}</div>
                <div style="flex:1;font-size:13.5px;">{{ $kbli->judul_kbli }}</div>
                <form action="{{ route('admin.about.kbli.destroy', $kbli) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm btn-icon"
                            onclick="confirmDelete(this.closest('form'), '{{ addslashes($kbli->kode_kbli) }}')">✕</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
