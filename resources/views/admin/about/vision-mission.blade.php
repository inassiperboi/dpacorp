@extends('admin.layouts.app')
@section('page-title', 'Visi & Misi')
@section('breadcrumb') / <a href="{{ route('admin.about.vision-mission') }}">Tentang Kami</a> / Visi & Misi@endsection

@section('content')
<div style="display:grid;grid-template-columns:1fr 1.2fr;gap:20px;align-items:start;">

    {{-- Visi --}}
    <div class="card">
        <div class="card-header"><h3>🎯 Visi Perusahaan</h3></div>
        <div class="card-body">
            <form action="{{ route('admin.about.vision.update') }}" method="POST">
                @csrf @method('PUT')
                <div class="form-group">
                    <label class="form-label">Isi Visi <span class="required">*</span></label>
                    <textarea name="isi_visi" class="form-control" rows="6" required
                              placeholder="Tuliskan visi perusahaan di sini...">{{ old('isi_visi', $vision->isi_visi ?? '') }}</textarea>
                    <div class="form-hint">Visi adalah cita-cita jangka panjang perusahaan.</div>
                </div>
                <button type="submit" class="btn btn-primary">💾 Simpan Visi</button>
            </form>
        </div>
    </div>

    {{-- Misi --}}
    <div style="display:flex;flex-direction:column;gap:20px;">
        <div class="card">
            <div class="card-header"><h3>+ Tambah Poin Misi</h3></div>
            <div class="card-body">
                <form action="{{ route('admin.about.mission.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Isi Misi <span class="required">*</span></label>
                        <textarea name="isi_misi" class="form-control" rows="4" required
                                  placeholder="Tuliskan satu poin misi...">{{ old('isi_misi') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="order" class="form-control"
                               value="{{ old('order', $missions->count() + 1) }}" min="1">
                    </div>
                    <button type="submit" class="btn btn-primary">+ Tambah Poin Misi</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>📋 Daftar Poin Misi</h3>
                <span class="badge badge-info">{{ $missions->count() }} poin</span>
            </div>
            @if($missions->isEmpty())
            <div style="padding:30px;text-align:center;color:var(--text-muted);">Belum ada poin misi.</div>
            @endif
            @foreach($missions as $i => $m)
            <div style="border-bottom:1px solid var(--border);padding:14px 20px;display:flex;align-items:flex-start;gap:12px;">
                <div style="width:28px;height:28px;background:var(--primary);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:12px;font-weight:700;flex-shrink:0;">{{ $i+1 }}</div>
                <div style="flex:1;font-size:13.5px;line-height:1.6;">{{ $m->isi_misi }}</div>
                <div style="display:flex;gap:4px;flex-shrink:0;">
                    <button type="button" class="btn btn-secondary btn-sm btn-icon"
                            onclick="editMisi({{ $m->id }}, '{{ addslashes($m->isi_misi) }}', {{ $m->order }})"
                            title="Edit">✏️</button>
                    <form action="{{ route('admin.about.mission.destroy', $m) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm btn-icon"
                                onclick="confirmDelete(this.closest('form'), 'poin misi #{{ $i+1 }}')">✕</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Edit Misi Modal --}}
<div id="misiModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:1000;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:16px;width:90%;max-width:500px;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,.3);">
        <div style="padding:20px 24px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;">
            <h3 style="font-size:16px;font-weight:700;">Edit Poin Misi</h3>
            <button onclick="closeMisiModal()" style="background:none;border:none;font-size:20px;cursor:pointer;color:var(--text-muted);">✕</button>
        </div>
        <form id="misiEditForm" method="POST" style="padding:24px;">
            @csrf @method('PUT')
            <div class="form-group">
                <label class="form-label">Isi Misi</label>
                <textarea name="isi_misi" id="edit_isi_misi" class="form-control" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Urutan</label>
                <input type="number" name="order" id="edit_misi_order" class="form-control" min="1">
            </div>
            <div style="display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" onclick="closeMisiModal()" class="btn btn-secondary">Batal</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function editMisi(id, isi, order) {
    document.getElementById('edit_isi_misi').value = isi;
    document.getElementById('edit_misi_order').value = order;
    document.getElementById('misiEditForm').action = `/panel/tentang/misi/${id}`;
    document.getElementById('misiModal').style.display = 'flex';
}
function closeMisiModal() {
    document.getElementById('misiModal').style.display = 'none';
}
</script>
@endpush
