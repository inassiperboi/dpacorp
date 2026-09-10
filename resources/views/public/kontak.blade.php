@extends('public.layouts.app')

@section('meta-title', 'Kontak Kami — DPA Corp')

@section('meta-description', 'Hubungi PT Dharma Putra Airlangga — alamat, telepon, email, dan form kontak online.')

@section('content')

<div class="breadcrumb-bar">
    <ol class="breadcrumb-list">
        <li>
            <a href="{{ url('/') }}">Beranda</a>
        </li>
        <li>Kontak</li>
    </ol>
</div>

<section style="
    background:linear-gradient(135deg,#0d1f45,#1a3a6e);
    padding:70px 5%;
    text-align:center;
">

    <div class="section-label" style="color:#f0b84a;">
        Kami Siap Membantu
    </div>

    <h1 style="
        font-family:'Poppins',sans-serif;
        font-size:42px;
        font-weight:800;
        color:#fff;
        margin:0 0 14px 0;
        line-height:1.2;
    ">
        Hubungi Kami
    </h1>

    <p style="
        font-size:16px;
        color:rgba(255,255,255,.75);
        max-width:540px;
        margin:0 auto;
        line-height:1.7;
    ">
        Kirim pesan kepada kami dan tim akan segera merespons pertanyaan Anda.
    </p>

</section>


<section style="padding:80px 5%;">

    <div style="
        max-width:1100px;
        margin:0 auto;
        display:grid;
        grid-template-columns:1fr 1.4fr;
        gap:40px;
        align-items:start;
    ">


        {{-- ================= BAGIAN INFORMASI KONTAK ================= --}}

        <div style="
            display:flex;
            flex-direction:column;
            gap:20px;
        ">

            <div class="card-pub" style="padding:28px;">

                <h2 style="
                    font-size:20px;
                    font-weight:700;
                    color:var(--primary);
                    margin:0 0 24px 0;
                    line-height:1.3;
                ">
                    Informasi Kontak
                </h2>


                {{-- ================= ALAMAT ================= --}}

                @if($company->alamat)

                    @php
                        $contactMapsQuery = trim(
                            ($company->alamat ?? '') . ' ' .
                            ($company->kota ?? '') . ' ' .
                            ($company->kode_pos ?? '')
                        );

                        $contactMapsUrl = !empty($company->maps_url)
                            ? $company->maps_url
                            : (
                                !empty($company->lat) && !empty($company->lng)
                                    ? 'https://www.google.com/maps?q=' . $company->lat . ',' . $company->lng
                                    : 'https://www.google.com/maps?q=' . urlencode($contactMapsQuery)
                            );

                        $contactMapEmbedUrl =
                            'https://www.google.com/maps?q=' .
                            urlencode($contactMapsQuery) .
                            '&z=15&output=embed';
                    @endphp

                    <div style="
                        display:flex;
                        gap:14px;
                        margin:0 0 20px 0;
                        align-items:flex-start;
                    ">

                        <div style="
                            width:42px;
                            height:42px;
                            background:#e0f2fe;
                            border-radius:10px;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            font-size:18px;
                            flex-shrink:0;
                        ">
                            📍
                        </div>

                        <div style="
                            flex:1;
                            min-width:0;
                        ">

                            <div style="
                                font-weight:600;
                                font-size:14px;
                                margin:0 0 4px 0;
                                line-height:1.4;
                            ">
                                Alamat
                            </div>

                            <a
                                href="{{ $contactMapsUrl }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                style="
                                    font-size:13.5px;
                                    color:var(--primary-light);
                                    line-height:1.6;
                                    text-decoration:none;
                                    display:inline-block;
                                "
                            >{{ $company->alamat }}@if($company->kota), {{ $company->kota }}@endif @if($company->kode_pos) {{ $company->kode_pos }}@endif</a>

                        </div>

                    </div>


                    {{-- MAP --}}

                    <div style="
                        margin:0 0 20px 0;
                        border-radius:12px;
                        overflow:hidden;
                        border:1px solid #dfeaf7;
                        background:#f8fbff;
                    ">

                        <iframe
                            src="{{ $contactMapEmbedUrl }}"
                            width="100%"
                            height="180"
                            style="border:0;display:block;"
                            loading="lazy"
                            allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Lokasi {{ $company->nama_resmi ?? 'DPA Corp' }}"
                        ></iframe>

                    </div>

                @endif


                {{-- ================= TELEPON ================= --}}

                @if($company->telepon)

                    <div style="
                        display:flex;
                        gap:14px;
                        margin:0 0 20px 0;
                        align-items:flex-start;
                    ">

                        <div style="
                            width:42px;
                            height:42px;
                            background:#dcfce7;
                            border-radius:10px;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            font-size:18px;
                            flex-shrink:0;
                        ">
                            📞
                        </div>

                        <div style="
                            flex:1;
                            min-width:0;
                        ">

                            <div style="
                                font-weight:600;
                                font-size:14px;
                                margin:0 0 4px 0;
                                line-height:1.4;
                            ">
                                Telepon
                            </div>

                            <a
                                href="tel:{{ $company->telepon }}"
                                style="
                                    font-size:13.5px;
                                    color:var(--primary-light);
                                    text-decoration:none;
                                    line-height:1.5;
                                "
                            >{{ $company->telepon }}</a>

                            @if($company->whatsapp)
                                <br>

                                <a
                                    href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->whatsapp) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    style="
                                        font-size:13.5px;
                                        color:var(--primary-light);
                                        text-decoration:none;
                                        line-height:1.5;
                                    "
                                >{{ $company->whatsapp }} (WA)</a>
                            @endif

                        </div>

                    </div>

                @endif


                {{-- ================= EMAIL ================= --}}

                @if($company->email)

                    <div style="
                        display:flex;
                        gap:14px;
                        margin:0 0 20px 0;
                        align-items:flex-start;
                    ">

                        <div style="
                            width:42px;
                            height:42px;
                            background:#fef3c7;
                            border-radius:10px;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            font-size:18px;
                            flex-shrink:0;
                        ">
                            ✉️
                        </div>

                        <div style="
                            flex:1;
                            min-width:0;
                        ">

                            <div style="
                                font-weight:600;
                                font-size:14px;
                                margin:0 0 4px 0;
                                line-height:1.4;
                            ">
                                Email
                            </div>

                            <a
                                href="mailto:{{ $company->email }}"
                                style="
                                    font-size:13.5px;
                                    color:var(--primary-light);
                                    text-decoration:none;
                                    line-height:1.5;
                                "
                            >{{ $company->email }}</a>

                        </div>

                    </div>

                @endif


                {{-- ================= JAM OPERASIONAL ================= --}}

                @if($company->jam_operasional)

                    <div style="
                        display:flex;
                        gap:14px;
                        margin:0;
                        align-items:flex-start;
                    ">

                        <div style="
                            width:42px;
                            height:42px;
                            background:#f3e8ff;
                            border-radius:10px;
                            display:flex;
                            align-items:center;
                            justify-content:center;
                            font-size:18px;
                            flex-shrink:0;
                        ">
                            🕐
                        </div>

                        <div style="
                            flex:1;
                            min-width:0;
                        ">

                            <div style="
                                font-weight:600;
                                font-size:14px;
                                margin:0 0 4px 0;
                                line-height:1.4;
                            ">Jam Operasional</div>

                            <div style="
                                font-size:13.5px;
                                color:var(--text-muted);
                                white-space:pre-line;
                                line-height:1.5;
                                margin:0;
                                padding:0;
                            ">{{ trim($company->jam_operasional) }}</div>

                        </div>

                    </div>

                @endif

            </div>

        </div>


        {{-- ================= FORM KONTAK ================= --}}

        <div class="card-pub" style="padding:32px;">

            <h2 style="
                font-size:20px;
                font-weight:700;
                color:var(--primary);
                margin:0 0 6px 0;
                line-height:1.3;
            ">
                Kirim Pesan
            </h2>

            <p style="
                font-size:13.5px;
                color:var(--text-muted);
                margin:0 0 28px 0;
                line-height:1.5;
            ">
                Isi form di bawah ini dan kami akan membalas secepatnya.
            </p>


            <form
                action="{{ route('public.kontak.store') }}"
                method="POST"
            >

                @csrf


                {{-- HONEYPOT --}}

                <input
                    type="text"
                    name="website"
                    style="display:none;"
                    tabindex="-1"
                    autocomplete="off"
                >


                {{-- NAMA --}}

                <div style="margin-bottom:20px;">

                    <label style="
                        display:block;
                        font-size:13px;
                        font-weight:600;
                        margin:0 0 7px 0;
                    ">
                        Nama Lengkap
                        <span style="color:#ef4444;">*</span>
                    </label>

                    <input
                        type="text"
                        name="nama"
                        value="{{ old('nama') }}"
                        style="
                            width:100%;
                            padding:12px 14px;
                            border:1.5px solid var(--border);
                            border-radius:10px;
                            font-size:14px;
                            outline:none;
                            transition:border .2s;
                            font-family:'Inter',sans-serif;
                            box-sizing:border-box;
                        "
                        placeholder="Masukkan nama lengkap Anda"
                        required
                        onfocus="this.style.borderColor='#1a3a6e'"
                        onblur="this.style.borderColor='var(--border)'"
                    >

                </div>


                {{-- EMAIL --}}

                <div style="margin-bottom:20px;">

                    <label style="
                        display:block;
                        font-size:13px;
                        font-weight:600;
                        margin:0 0 7px 0;
                    ">
                        Email
                        <span style="color:#ef4444;">*</span>
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        style="
                            width:100%;
                            padding:12px 14px;
                            border:1.5px solid var(--border);
                            border-radius:10px;
                            font-size:14px;
                            outline:none;
                            transition:border .2s;
                            font-family:'Inter',sans-serif;
                            box-sizing:border-box;
                        "
                        placeholder="email@anda.com"
                        required
                        onfocus="this.style.borderColor='#1a3a6e'"
                        onblur="this.style.borderColor='var(--border)'"
                    >

                </div>


                {{-- PESAN --}}

                <div style="margin-bottom:28px;">

                    <label style="
                        display:block;
                        font-size:13px;
                        font-weight:600;
                        margin:0 0 7px 0;
                    ">
                        Pesan
                        <span style="color:#ef4444;">*</span>
                    </label>

                    <textarea
                        name="pesan"
                        rows="6"
                        style="
                            width:100%;
                            padding:12px 14px;
                            border:1.5px solid var(--border);
                            border-radius:10px;
                            font-size:14px;
                            outline:none;
                            transition:border .2s;
                            resize:vertical;
                            font-family:'Inter',sans-serif;
                            box-sizing:border-box;
                        "
                        placeholder="Tulis pesan atau pertanyaan Anda di sini..."
                        required
                        onfocus="this.style.borderColor='#1a3a6e'"
                        onblur="this.style.borderColor='var(--border)'"
                    >{{ old('pesan') }}</textarea>

                </div>


                {{-- BUTTON --}}

                <button
                    type="submit"
                    class="btn-pub btn-pub-primary"
                    style="
                        width:100%;
                        justify-content:center;
                        font-size:15px;
                        padding:14px;
                    "
                >
                    📬 Kirim Pesan
                </button>

            </form>

        </div>

    </div>

</section>


{{-- ================= SCHEMA ================= --}}

@php

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => $company->nama_resmi ?? 'DPA Corp',
        'url' => url('/'),
        'telephone' => $company->telepon ?? '',
        'email' => $company->email ?? '',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $company->alamat ?? '',
            'addressLocality' => $company->kota ?? '',
            'addressRegion' => $company->provinsi ?? '',
            'postalCode' => $company->kode_pos ?? '',
            'addressCountry' => 'ID',
        ],
    ];

    if ($company->lat && $company->lng) {

        $schema['geo'] = [
            '@type' => 'GeoCoordinates',
            'latitude' => (float) $company->lat,
            'longitude' => (float) $company->lng,
        ];

    }

@endphp


<script type="application/ld+json">
{!! json_encode(
    $schema,
    JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
) !!}
</script>

@endsection
