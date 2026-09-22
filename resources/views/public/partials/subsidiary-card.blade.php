@props(['sub', 'showLegal' => false, 'showContacts' => false])

<div class="subsidiary-card">
    {{-- Cover / Header Banner --}}
    <div class="subsidiary-card-banner">
        @if($sub->cover_image)
            <img src="{{ asset('storage/'.$sub->cover_image) }}" alt="{{ $sub->cover_alt ?? $sub->nama }}" class="subsidiary-card-cover" loading="lazy">
        @else
            <div class="subsidiary-card-pattern"></div>
        @endif
        <div class="subsidiary-card-overlay"></div>
    </div>

    {{-- Floating Logo Avatar --}}
    <div class="subsidiary-logo-avatar">
        @if($sub->logo)
            <img src="{{ asset('storage/'.$sub->logo) }}" alt="{{ $sub->logo_alt ?? $sub->nama }}" loading="lazy">
        @else
            <div class="subsidiary-logo-fallback">
                <span>{{ strtoupper(substr($sub->nama, 0, 2)) }}</span>
            </div>
        @endif
    </div>

    {{-- Card Body --}}
    <div class="subsidiary-card-body">
        <h3 class="subsidiary-card-title">{{ $sub->nama }}</h3>

        @if($sub->alamat)
            <div class="subsidiary-card-location">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                <span>{{ Str::limit($sub->alamat, 45) }}</span>
            </div>
        @endif

        <p class="subsidiary-card-desc">
            {{ $sub->deskripsi_singkat ?? $sub->deskripsi_lengkap ?? 'Anak perusahaan PT Dharma Putra Airlangga.' }}
        </p>

        {{-- Service Badges --}}
        <div class="subsidiary-card-services">
            @if($sub->services->count())
                @foreach($sub->services->take(4) as $svc)
                    <span class="subsidiary-service-chip">
                        @if($svc->icon) <span class="chip-icon">{{ $svc->icon }}</span> @endif
                        <span>{{ $svc->nama_layanan }}</span>
                    </span>
                @endforeach
                @if($sub->services->count() > 4)
                    <span class="subsidiary-service-chip subsidiary-service-chip-more">+{{ $sub->services->count() - 4 }}</span>
                @endif
            @else
                <span class="subsidiary-service-chip subsidiary-service-chip-default">
                    <span>🏢 Unit Bisnis Holding</span>
                </span>
            @endif
        </div>

        {{-- Legalitas singkat (if showLegal enabled) --}}
        @if($showLegal && ($sub->tanggal_pendirian || $sub->no_akta))
            <div class="subsidiary-meta-info">
                @if($sub->tanggal_pendirian)
                    <div><strong>Berdiri:</strong> {{ $sub->tanggal_pendirian->format('Y') }}</div>
                @endif
                @if($sub->no_akta)
                    <div><strong>Akta:</strong> {{ $sub->no_akta }}</div>
                @endif
            </div>
        @endif

        {{-- Social Contacts (if showContacts enabled) --}}
        @if($showContacts && ($sub->instagram || $sub->whatsapp || $sub->email))
            <div class="subsidiary-contacts">
                @if($sub->instagram)
                    <a href="https://instagram.com/{{ ltrim($sub->instagram,'@') }}" target="_blank" rel="noopener" class="subsidiary-contact-btn subsidiary-contact-ig">📷 Instagram</a>
                @endif
                @if($sub->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/','',$sub->whatsapp) }}" target="_blank" rel="noopener" class="subsidiary-contact-btn subsidiary-contact-wa">💬 WhatsApp</a>
                @endif
                @if($sub->email)
                    <a href="mailto:{{ $sub->email }}" class="subsidiary-contact-btn subsidiary-contact-mail">✉️ Email</a>
                @endif
            </div>
        @endif

        {{-- Action Button --}}
        <div class="subsidiary-card-footer">
            @if($sub->website_url)
                <a href="{{ $sub->website_url }}" target="_blank" rel="noopener noreferrer" class="subsidiary-btn subsidiary-btn-primary">
                    <span>Kunjungi Website</span>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                </a>
            @else
                <button type="button" onclick="showSubsidiaryModal('{{ addslashes($sub->nama) }}','{{ addslashes($sub->deskripsi_singkat ?? $sub->deskripsi_lengkap) }}')" class="subsidiary-btn subsidiary-btn-outline">
                    <span>Info Lebih Lanjut</span>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                </button>
            @endif
        </div>
    </div>
</div>
