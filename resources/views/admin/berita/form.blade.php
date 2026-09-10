@extends('admin.layouts.app')
@section('page-title', isset($berita) ? 'Edit Berita' : 'Tambah Berita')
{{-- @section('breadcrumb') / <a href="{{ route('admin.news-information.index') }}">Berita & Informasi</a> / <a href="{{ route('admin.berita.index') }}">Berita</a> / {{ isset($berita) ? 'Edit' : 'Tambah' }}@endsection --}}

@php($currentBerita = $berita ?? null)

@section('content')
<form action="{{ isset($currentBerita) ? route('admin.berita.update', $currentBerita) : route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($currentBerita)) @method('PUT') @endif

<div style="display:grid;grid-template-columns:1.4fr 1fr;gap:20px;align-items:start;">
    <div class="card">
        <div class="card-header"><h3>Konten Berita</h3><a href="{{ route('admin.berita.index') }}" class="btn btn-secondary btn-sm">← Kembali</a></div>
        <div class="card-body">
            <div class="form-group">
                <label class="form-label">Judul <span class="required">*</span></label>
                <input type="text" name="title" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" value="{{ old('title', $currentBerita->title ?? '') }}" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Slug <span class="required">*</span></label>
                <input type="text" name="slug" id="slug" class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" value="{{ old('slug', $currentBerita->slug ?? '') }}" required>
                @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Ringkasan <span class="required">*</span></label>
                <textarea name="summary" class="form-control {{ $errors->has('summary') ? 'is-invalid' : '' }}" rows="4" required>{{ old('summary', $currentBerita->summary ?? '') }}</textarea>
                @error('summary')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="form-group">
                <label class="form-label">Isi Konten <span class="required">*</span></label>
                <textarea name="content" class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" rows="12" required>{{ old('content', $currentBerita->content ?? '') }}</textarea>
                <div class="form-hint">Wajib minimal 250 kata.</div>
                @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Tags <span class="required">*</span></label>
                <div class="tag-chip-field {{ $errors->has('tags') ? 'is-invalid' : '' }}" id="berita-tags-field">
                    <div class="tag-chip-list" id="berita-tags-list"></div>
                    <input type="text" class="tag-chip-input" id="berita-tags-input" placeholder="Ketik tag lalu tekan Enter">
                    <textarea name="tags" id="berita-tags-value" hidden>{{ old('tags', $currentBerita->tags ?? '') }}</textarea>
                </div>
                <div class="form-hint">Tekan Enter untuk membuat 1 tag. Maksimal 10 tag. Klik X untuk menghapus tag.</div>
                @error('tags')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    <div style="display:flex;flex-direction:column;gap:20px;">
        <div class="card">
            <div class="card-header"><h3>Gambar</h3></div>
            <div class="card-body">
                @if($currentBerita && $currentBerita->image)
                    <img src="{{ asset('storage/'.$currentBerita->image) }}" alt="{{ $currentBerita->title }}" style="width:100%;max-height:220px;object-fit:cover;border-radius:10px;margin-bottom:12px;">
                @endif
                <div class="form-group">
                    <label class="form-label">Upload Gambar <span class="required">*</span></label>
                    <input type="file" name="image" class="form-control {{ $errors->has('image') ? 'is-invalid' : '' }}" accept="image/jpeg,image/png,image/jpg">
                    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Gambar Tambahan</label>
                    <div class="dropzone-file {{ $errors->has('image_2') ? 'is-invalid' : '' }}" id="berita-image-dropzone">
                        <input type="file" name="image_2[]" id="berita-image-input" accept="image/jpeg,image/png,image/jpg" multiple hidden>
                        <div class="dropzone-copy">
                            <strong>Tarik beberapa file gambar ke sini</strong>
                            <span>Klik untuk memilih file JPG, JPEG, atau PNG. Bisa lebih dari satu.</span>
                        </div>
                        <div class="dropzone-files" id="berita-image-files"></div>
                    </div>
                    <div class="form-hint">Opsional. Gambar tambahan akan tampil sebagai galeri di bawah judul atau sebelum isi konten.</div>
                    @error('image_2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    @error('image_2.*')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    @if($currentBerita && $currentBerita->extraImages())
                        <div style="margin-top:12px;display:grid;grid-template-columns:repeat(auto-fill,minmax(120px,1fr));gap:10px;">
                            @foreach($currentBerita->extraImages() as $image)
                                <img src="{{ asset('storage/'.$image) }}" alt="{{ $currentBerita->title }}" style="width:100%;height:90px;object-fit:cover;border-radius:10px;border:1px solid var(--border);">
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header"><h3>Metadata</h3></div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Negara <span class="required">*</span></label>
                    <input type="text" name="country" class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" value="{{ old('country', $currentBerita->country ?? '') }}" required>
                    @error('country')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div style="display:flex;gap:10px;">
            <button type="submit" class="btn btn-primary">💾 Simpan</button>
            <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </div>
</div>
</form>
@endsection

@push('styles')
<style>
    .tag-chip-field {
        min-height: 48px;
        border: 1px solid var(--border);
        border-radius: 10px;
        background: #fff;
        padding: 8px;
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        align-items: center;
    }

    .tag-chip-field.is-invalid {
        border-color: var(--danger);
        box-shadow: 0 0 0 1px rgba(239, 68, 68, 0.08);
    }

    .tag-chip-list {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .tag-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 10px;
        border-radius: 999px;
        background: rgba(26, 58, 110, 0.08);
        color: var(--primary);
        font-size: 13px;
        font-weight: 600;
        line-height: 1;
    }

    .tag-chip button {
        border: 0;
        background: rgba(26, 58, 110, 0.14);
        color: var(--primary);
        width: 20px;
        height: 20px;
        border-radius: 50%;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        line-height: 1;
    }

    .tag-chip-input {
        border: 0;
        outline: none;
        min-width: 180px;
        flex: 1 1 180px;
        padding: 8px 4px;
        font: inherit;
        color: var(--text);
        background: transparent;
    }

    .tag-chip-input::placeholder {
        color: var(--text-muted);
    }

    .dropzone-file {
        border: 1.5px dashed var(--border);
        border-radius: 14px;
        padding: 16px;
        background: #fff;
        cursor: pointer;
        transition: border-color .2s, background .2s, transform .2s;
    }

    .dropzone-file.is-invalid {
        border-color: var(--danger);
    }

    .dropzone-file.is-dragover {
        border-color: var(--primary);
        background: rgba(26, 58, 110, 0.04);
    }

    .dropzone-copy {
        display: flex;
        flex-direction: column;
        gap: 4px;
        color: var(--text);
    }

    .dropzone-copy strong {
        font-size: 14px;
        color: var(--primary);
    }

    .dropzone-copy span {
        font-size: 12px;
        color: var(--text-muted);
        line-height: 1.6;
    }

    .dropzone-files {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 12px;
    }

    .dropzone-file-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 10px;
        border-radius: 999px;
        background: rgba(26, 58, 110, 0.08);
        color: var(--primary);
        font-size: 12px;
        font-weight: 600;
    }

    .dropzone-file-chip button {
        border: 0;
        background: rgba(26, 58, 110, 0.14);
        color: var(--primary);
        width: 20px;
        height: 20px;
        border-radius: 50%;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');
    const tagsField = document.getElementById('berita-tags-field');
    const tagsList = document.getElementById('berita-tags-list');
    const tagsInput = document.getElementById('berita-tags-input');
    const tagsValue = document.getElementById('berita-tags-value');
    const imageDropzone = document.getElementById('berita-image-dropzone');
    const imageInput = document.getElementById('berita-image-input');
    const imageFiles = document.getElementById('berita-image-files');
    let slugTouched = false;
    let tags = [];
    let extraFiles = [];

    if (slugInput) {
        slugInput.addEventListener('input', function () {
            slugTouched = true;
        });
    }

    function slugify(value) {
        return value.toString().toLowerCase().trim().replace(/[^\w\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
    }

    if (titleInput && slugInput) {
        titleInput.addEventListener('input', function () {
            if (!slugTouched) {
                slugInput.value = slugify(titleInput.value);
            }
        });
    }

    function normalizeTag(value) {
        return value.toString().trim().replace(/\s+/g, ' ');
    }

    function syncTagsValue() {
        if (tagsValue) {
            tagsValue.value = tags.join('\n');
        }
    }

    function renderTags() {
        if (!tagsList) return;

        tagsList.innerHTML = '';

        tags.forEach(function (tag, index) {
            const chip = document.createElement('span');
            chip.className = 'tag-chip';
            chip.innerHTML = '<span>' + tag.replace(/</g, '&lt;').replace(/>/g, '&gt;') + '</span>';

            const button = document.createElement('button');
            button.type = 'button';
            button.setAttribute('aria-label', 'Hapus tag ' + tag);
            button.textContent = '×';
            button.addEventListener('click', function () {
                tags.splice(index, 1);
                renderTags();
                syncTagsValue();
            });

            chip.appendChild(button);
            tagsList.appendChild(chip);
        });

        if (tagsField) {
            tagsField.classList.toggle('is-empty', tags.length === 0);
        }
    }

    function addTag(value) {
        const tag = normalizeTag(value);
        if (!tag) return;

        if (tags.length >= 10) {
            return;
        }

        tags.push(tag);
        renderTags();
        syncTagsValue();
    }

    function addTagsFromText(value) {
        String(value)
            .split(/\r\n|\r|\n/)
            .map(normalizeTag)
            .filter(Boolean)
            .forEach(function (tag) {
                if (tags.length < 10) {
                    tags.push(tag);
                }
            });

        renderTags();
        syncTagsValue();
    }

    function renderExtraFiles() {
        if (!imageFiles) {
            return;
        }

        imageFiles.innerHTML = '';

        if (!extraFiles.length) {
            return;
        }

        extraFiles.forEach(function (file, index) {
            const chip = document.createElement('span');
            chip.className = 'dropzone-file-chip';
            chip.innerHTML = '<span>' + file.name.replace(/</g, '&lt;').replace(/>/g, '&gt;') + '</span>';

            const button = document.createElement('button');
            button.type = 'button';
            button.setAttribute('aria-label', 'Hapus file ' + file.name);
            button.textContent = '×';
            button.addEventListener('click', function () {
                extraFiles.splice(index, 1);
                syncExtraInput();
                renderExtraFiles();
            });

            chip.appendChild(button);
            imageFiles.appendChild(chip);
        });
    }

    function syncExtraInput() {
        if (!imageInput || typeof DataTransfer === 'undefined') {
            return;
        }

        const dataTransfer = new DataTransfer();
        extraFiles.forEach(function (file) {
            dataTransfer.items.add(file);
        });
        imageInput.files = dataTransfer.files;
    }

    function addExtraFiles(fileList) {
        Array.from(fileList || []).forEach(function (file) {
            const key = file.name + ':' + file.size + ':' + file.lastModified;

            if (extraFiles.some(function (existingFile) {
                return existingFile.name + ':' + existingFile.size + ':' + existingFile.lastModified === key;
            })) {
                return;
            }

            extraFiles.push(file);
        });

        syncExtraInput();
        renderExtraFiles();
    }

    if (tagsValue && tagsValue.value) {
        addTagsFromText(tagsValue.value);
    }

    if (tagsInput) {
        tagsInput.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                addTag(tagsInput.value);
                tagsInput.value = '';
            }

            if (event.key === 'Backspace' && !tagsInput.value && tags.length) {
                tags.pop();
                renderTags();
                syncTagsValue();
            }
        });

        tagsInput.addEventListener('paste', function (event) {
            const pastedText = event.clipboardData?.getData('text') || '';
            if (pastedText.includes('\n')) {
                event.preventDefault();
                addTagsFromText(pastedText);
                tagsInput.value = '';
            }
        });

        tagsInput.addEventListener('blur', function () {
            if (tagsInput.value.trim()) {
                addTag(tagsInput.value);
                tagsInput.value = '';
            }
        });
    }

    if (imageDropzone && imageInput) {
        imageDropzone.addEventListener('click', function (event) {
            if (event.target !== imageInput) {
                imageInput.click();
            }
        });

        imageDropzone.addEventListener('dragover', function (event) {
            event.preventDefault();
            imageDropzone.classList.add('is-dragover');
        });

        imageDropzone.addEventListener('dragleave', function () {
            imageDropzone.classList.remove('is-dragover');
        });

        imageDropzone.addEventListener('drop', function (event) {
            event.preventDefault();
            imageDropzone.classList.remove('is-dragover');
            addExtraFiles(event.dataTransfer.files);
        });

        imageInput.addEventListener('change', function () {
            addExtraFiles(imageInput.files);
            imageInput.value = '';
        });
    }
});
</script>
@endpush
