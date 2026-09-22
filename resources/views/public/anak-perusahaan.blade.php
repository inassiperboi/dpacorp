@extends('public.layouts.app')
@section('meta-title', 'Anak Perusahaan — DPA Corp')
@section('meta-description', 'Empat anak perusahaan PT Dharma Putra Airlangga di bidang perjalanan wisata, bioproduct, konsultasi, dan properti.')

@section('content')

{{-- Breadcrumb --}}
<div class="breadcrumb-bar">
    <ol class="breadcrumb-list">
        <li><a href="{{ url('/') }}">Beranda</a></li>
        <li>Anak Perusahaan</li>
    </ol>
</div>

{{-- Header --}}
@include('public.partials.hero-video', [
    'label' => 'Grup Bisnis DPA Corp',
    'title' => 'Anak Perusahaan',
    'description' => 'Setiap anak perusahaan beroperasi secara mandiri dengan website dan tim tersendiri, di bawah payung holding DPA Corp.',
])

{{-- Grid --}}
<section style="padding:80px 5%;">
    <div style="max-width:1200px;margin:0 auto;">
        @if($subsidiaries->isEmpty())
            <div style="text-align:center;padding:60px;color:var(--text-muted);">
                Belum ada data anak perusahaan.
            </div>
        @else
        <div class="subsidiaries-grid">
            @foreach($subsidiaries as $sub)
                @include('public.partials.subsidiary-card', ['sub' => $sub, 'showLegal' => true, 'showContacts' => true])
            @endforeach
        </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
function showSubsidiaryModal(nama, deskripsi) {
    Swal.fire({
        title: nama,
        text: deskripsi || 'Website sedang dalam pengembangan. Hubungi kami untuk informasi lebih lanjut.',
        icon: 'info',
        confirmButtonColor: '#1a3a6e',
        confirmButtonText: 'Tutup',
    });
}
</script>
@endpush
@endsection
