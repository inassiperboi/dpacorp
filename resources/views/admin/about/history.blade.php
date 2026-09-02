@extends('admin.layouts.app')
@section('page-title', 'Sejarah & Timeline')
@section('breadcrumb') / <a href="{{ route('admin.about.history') }}">Tentang Kami</a> / Sejarah@endsection

@section('content')
<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;align-items:start;">

    {{-- Form Tambah --}}
    <div class="card">
        <div class="card-header"><h3>+ Tambah Milestone Sejarah</h3></div>
        <div class="card-body">
            <form action="{{ route('admin.about.history.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Tahun <span class="required">*</span></label>
                    <input type="text" name="year" class="form-control" placeholder="2009" required value="{{ old('year') }}">
                </div>
                <div class="form-group">
                    <label class="form-label">Judul <span class="required">*</span></label>
                    <input type="text" name="title" class="form-control" required value="{{ old('title') }}"
                           placeholder="Pendirian DPA Corp">
                </div>
                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4"
                              placeholder="Penjelasan singkat milestone ini">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Urutan</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $timelines->count() + 1) }}" min="0">
                </div>
                <button type="submit" class="btn btn-primary">+ Tambah</button>
            </form>
        </div>
    </div>

    {{-- Daftar Timeline --}}
    <div class="card">
        <div class="card-header">
            <h3>📅 Timeline Sejarah</h3>
            <span class="badge badge-info">{{ $timelines->count() }} item</span>
        </div>
        @if($timelines->isEmpty())
        <div style="padding:40px;text-align:center;color:var(--text-muted);">
            Belum ada data sejarah.
        </div>
        @endif
        @foreach($timelines as $tl)
        <div style="border-bottom:1px solid var(--border);padding:16px 20px;" id="tl-{{ $tl->id }}">
            <div style="display:flex;align-items:flex-start;gap:12px;">
                <div style="background:var(--accent);color:#fff;padding:4px 10px;border-radius:6px;font-size:13px;font-weight:700;flex-shrink:0;white-space:nowrap;">{{ $tl->year }}</div>
                <div style="flex:1;min-width:0;">
                    <div style="font-weight:600;margin-bottom:4px;">{{ $tl->title }}</div>
                    @if($tl->description)
                        <div style="font-size:12.5px;color:var(--text-muted);line-height:1.5;">{{ $tl->description }}</div>
                    @endif
                </div>
                <div style="display:flex;gap:4px;flex-shrink:0;">
                    <button type="button" class="btn btn-secondary btn-sm btn-icon"
                            onclick="editTimeline({{ $tl->id }}, '{{ addslashes($tl->year) }}', '{{ addslashes($tl->title) }}', '{{ addslashes($tl->description) }}', {{ $tl->order }})"
                            title="Edit">✏️</button>
                    <form action="{{ route('admin.about.history.destroy', $tl) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="button" class="btn btn-danger btn-sm btn-icon"
                                onclick="confirmDelete(this.closest('form'), '{{ addslashes($tl->title) }}')"
                                title="Hapus">✕</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

{{-- Modal Edit (hidden by default) --}}
<div id="editModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:1000;align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:16px;width:90%;max-width:480px;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,.3);">
        <div style="padding:20px 24px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center;">
            <h3 style="font-size:16px;font-weight:700;">Edit Timeline</h3>
            <button onclick="closeModal()" style="background:none;border:none;font-size:20px;cursor:pointer;color:var(--text-muted);">✕</button>
        </div>
        <form id="editForm" method="POST" style="padding:24px;">
            @csrf @method('PUT')
            <div class="form-group">
                <label class="form-label">Tahun</label>
                <input type="text" name="year" id="edit_year" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Judul</label>
                <input type="text" name="title" id="edit_title" class="form-control" required>
            </div>
            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" id="edit_description" class="form-control" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label class="form-label">Urutan</label>
                <input type="number" name="order" id="edit_order" class="form-control">
            </div>
            <div style="display:flex;gap:10px;">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" onclick="closeModal()" class="btn btn-secondary">Batal</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function editTimeline(id, year, title, description, order) {
    document.getElementById('edit_year').value = year;
    document.getElementById('edit_title').value = title;
    document.getElementById('edit_description').value = description;
    document.getElementById('edit_order').value = order;
    document.getElementById('editForm').action = `/panel/tentang/sejarah/${id}`;
    document.getElementById('editModal').style.display = 'flex';
}
function closeModal() {
    document.getElementById('editModal').style.display = 'none';
}
</script>
@endpush
