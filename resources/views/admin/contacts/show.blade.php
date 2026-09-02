@extends('admin.layouts.app')
@section('page-title', 'Detail Pesan')
@section('breadcrumb') / <a href="{{ route('admin.contacts.index') }}">Pesan Masuk</a> / Detail@endsection

@section('content')
<div class="card" style="max-width:640px;">
    <div class="card-header">
        <h3>✉️ Pesan dari {{ $contactMessage->nama }}</h3>
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
    </div>
    <div class="card-body">
        <div style="display:grid;grid-template-columns:auto 1fr;gap:8px 16px;margin-bottom:20px;font-size:13.5px;">
            <span style="color:var(--text-muted);font-weight:600;">Nama</span>
            <span>{{ $contactMessage->nama }}</span>
            <span style="color:var(--text-muted);font-weight:600;">Email</span>
            <a href="mailto:{{ $contactMessage->email }}" style="color:var(--primary-light);">{{ $contactMessage->email }}</a>
            <span style="color:var(--text-muted);font-weight:600;">Tanggal</span>
            <span>{{ $contactMessage->created_at->format('d F Y, H:i') }} WIB</span>
            <span style="color:var(--text-muted);font-weight:600;">Status</span>
            <span class="badge badge-success">Sudah Dibaca</span>
        </div>
        <div style="background:#f8fafc;border-radius:10px;padding:20px;border:1px solid var(--border);font-size:14px;line-height:1.7;white-space:pre-wrap;">{{ $contactMessage->pesan }}</div>
        <div style="margin-top:20px;display:flex;gap:10px;">
            <a href="mailto:{{ $contactMessage->email }}?subject=Re: Pesan dari Website DPA Corp" class="btn btn-primary">
                📧 Balas via Email
            </a>
            <form action="{{ route('admin.contacts.destroy', $contactMessage) }}" method="POST">
                @csrf @method('DELETE')
                <button type="button" class="btn btn-danger"
                    onclick="confirmDelete(this.closest('form'), 'pesan dari {{ $contactMessage->nama }}')">Hapus Pesan</button>
            </form>
        </div>
    </div>
</div>
@endsection
