@extends('public.layouts.app')

@section('meta-title', 'Berita & Informasi — DPA Corp')
@section('meta-description', 'Berita terbaru dan informasi resmi PT Dharma Putra Airlangga dalam satu halaman publik.')

@section('content')

<div class="breadcrumb-bar">
    <ol class="breadcrumb-list">
        <li><a href="{{ url('/') }}">Beranda</a></li>
        <li>Berita & Informasi</li>
    </ol>
</div>

@include('public.partials.hero-video', [
    'label' => 'Publikasi DPA Corp',
    'title' => 'Berita & Informasi',
    'description' => 'Semua publikasi penting kami dikumpulkan dalam satu halaman. Berita tampil di atas, informasi ada di bawah.',
    'maxWidth' => '760px',
])

<section style="padding:36px 5% 0;background:linear-gradient(180deg,#f8fbff 0%,#ffffff 100%);">
    <div style="max-width:1180px;margin:0 auto;display:flex;flex-wrap:wrap;gap:12px;align-items:center;justify-content:center;">
        <a href="#berita" class="btn-pub btn-pub-primary" style="padding:10px 18px;">Berita</a>
        <a href="#informasi" class="btn-pub btn-pub-outline" style="padding:10px 18px;">Informasi</a>
    </div>
</section>

<section style="padding:28px 5% 0;background:#fff;">
    <div style="max-width:1180px;margin:0 auto;">
        <div class="card-pub" style="padding:18px 18px 14px;background:linear-gradient(180deg,#ffffff 0%,#f8fbff 100%);">
            <div style="display:grid;grid-template-columns:minmax(0,1fr) 220px;gap:12px;align-items:end;">
                <div>
                    <label for="news-search" style="display:block;font-size:13px;font-weight:700;color:var(--primary);margin-bottom:8px;">Cari berita atau informasi</label>
                    <input
                        id="news-search"
                        type="search"
                        placeholder="Cari nama, teks, atau tag"
                        style="width:100%;padding:13px 14px;border:1.5px solid var(--border);border-radius:12px;font-size:14px;outline:none;"
                    >
                    <div style="font-size:12px;color:var(--text-muted);margin-top:8px;line-height:1.6;">Filter langsung saat mengetik. Pencarian akan mencocokkan judul, isi ringkas, negara, dan tag.</div>
                </div>
                <div>
                    <label for="news-sort" style="display:block;font-size:13px;font-weight:700;color:var(--primary);margin-bottom:8px;">Urutkan</label>
                    <select id="news-sort" style="width:100%;padding:13px 14px;border:1.5px solid var(--border);border-radius:12px;font-size:14px;outline:none;background:#fff;">
                        <option value="newest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="berita" style="padding:70px 5%;background:linear-gradient(180deg,#ffffff 0%,#f7fbff 100%);">
    <div style="max-width:1180px;margin:0 auto;">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:28px;">
            <div>
                <h2 class="section-title" style="margin:0;">Berita</h2>
            </div>
        </div>

        @if($beritaItems->isEmpty())
            <div data-empty-state="berita" style="text-align:center;color:var(--text-muted);padding:60px 20px;border:1px dashed var(--border);border-radius:18px;background:#fff;">
                Belum ada berita.
            </div>
        @else
            <div data-news-grid="berita" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:24px;">
                @foreach($beritaItems as $item)
                    @php
                        $newsTags = collect(preg_split('/\r\n|\r|\n/', $item->tags ?? ''))
                            ->map(fn ($tag) => trim($tag))
                            ->filter()
                            ->take(4);
                        $searchText = trim(implode(' ', array_filter([
                            $item->title,
                            $item->summary,
                            $item->country,
                            $item->tags,
                        ])));
                    @endphp

                    <a
                        href="{{ route('public.berita.show', $item->slug) }}"
                        class="card-pub"
                        data-news-card="berita"
                        data-search="{{ Str::lower($searchText) }}"
                        data-created-at="{{ optional($item->created_at)->timestamp ?? 0 }}"
                        style="text-decoration:none;color:inherit;overflow:hidden;display:block;"
                    >
                        <div style="position:relative;height:220px;background:linear-gradient(135deg,#0d1f45,#1a3a6e);overflow:hidden;">
                            @if($item->image)
                                <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" style="width:100%;height:100%;object-fit:cover;transition:transform .5s;" loading="lazy">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.7);font-size:54px;">📰</div>
                            @endif

                            <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(13,31,69,.78),rgba(13,31,69,.08));"></div>
                            <div style="position:absolute;top:16px;left:16px;background:rgba(240,184,74,.95);color:#0d1f45;padding:6px 12px;border-radius:999px;font-size:11px;font-weight:800;letter-spacing:.8px;text-transform:uppercase;">Berita</div>
                        </div>

                        <div style="padding:22px;">
                            <div style="font-size:12px;font-weight:700;color:var(--accent);text-transform:uppercase;letter-spacing:.8px;margin-bottom:8px;">{{ $item->country }}</div>
                            <h3 style="font-size:18px;font-weight:800;color:var(--primary);line-height:1.35;margin-bottom:10px;">{{ $item->title }}</h3>
                            <p style="font-size:14px;color:var(--text-muted);line-height:1.7;margin-bottom:16px;">{{ Str::limit($item->summary, 120) }}</p>

                            @if($newsTags->isNotEmpty())
                                <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:16px;">
                                    @foreach($newsTags as $tag)
                                        <span style="display:inline-flex;align-items:center;padding:5px 11px;border-radius:999px;background:#e8f1ff;color:#1a3a6e;font-size:11px;font-weight:700;">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            @endif

                            <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;">
                                <span style="font-size:12px;color:var(--text-muted);">{{ optional($item->created_at)->format('d M Y') }}</span>
                                <span style="font-size:13px;font-weight:700;color:var(--primary-light);">Baca selengkapnya →</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>

<section id="informasi" style="padding:70px 5%;background:linear-gradient(180deg,#f8fafc 0%,#fff 100%);">
    <div style="max-width:1180px;margin:0 auto;">
        <div style="display:flex;align-items:flex-end;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:28px;">
            <div>
                <h2 class="section-title" style="margin:0;">Informasi</h2>
            </div>
        </div>

        @if($informasiItems->isEmpty())
            <div data-empty-state="informasi" style="text-align:center;color:var(--text-muted);padding:60px 20px;border:1px dashed var(--border);border-radius:18px;background:#fff;">
                Belum ada informasi.
            </div>
        @else
            <div data-news-grid="informasi" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:24px;">
                @foreach($informasiItems as $item)
                    @php
                        $infoTags = collect(preg_split('/\r\n|\r|\n/', $item->tags ?? ''))
                            ->map(fn ($tag) => trim($tag))
                            ->filter()
                            ->take(4);
                        $searchText = trim(implode(' ', array_filter([
                            $item->title,
                            $item->summary,
                            $item->country,
                            $item->tags,
                        ])));
                    @endphp

                    <a
                        href="{{ route('public.informasi.show', $item->slug) }}"
                        class="card-pub"
                        data-news-card="informasi"
                        data-search="{{ Str::lower($searchText) }}"
                        data-created-at="{{ optional($item->created_at)->timestamp ?? 0 }}"
                        style="text-decoration:none;color:inherit;overflow:hidden;display:block;"
                    >
                        <div style="position:relative;height:220px;background:linear-gradient(135deg,#12385f,#2d6cdf);overflow:hidden;">
                            @if($item->image)
                                <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" style="width:100%;height:100%;object-fit:cover;transition:transform .5s;" loading="lazy">
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.75);font-size:54px;">ℹ️</div>
                            @endif

                            <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(18,56,95,.76),rgba(18,56,95,.08));"></div>
                            <div style="position:absolute;top:16px;left:16px;background:rgba(255,255,255,.95);color:#12385f;padding:6px 12px;border-radius:999px;font-size:11px;font-weight:800;letter-spacing:.8px;text-transform:uppercase;">Informasi</div>
                            @if($item->extraImages())
                                <div style="position:absolute;bottom:16px;right:16px;background:rgba(240,184,74,.96);color:#12385f;padding:5px 10px;border-radius:999px;font-size:11px;font-weight:800;">+ Gambar tambahan</div>
                            @endif
                        </div>

                        <div style="padding:22px;">
                            <div style="font-size:12px;font-weight:700;color:var(--accent);text-transform:uppercase;letter-spacing:.8px;margin-bottom:8px;">{{ $item->country }}</div>
                            <h3 style="font-size:18px;font-weight:800;color:var(--primary);line-height:1.35;margin-bottom:10px;">{{ $item->title }}</h3>
                            <p style="font-size:14px;color:var(--text-muted);line-height:1.7;margin-bottom:16px;">{{ Str::limit($item->summary, 120) }}</p>

                            @if($infoTags->isNotEmpty())
                                <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:16px;">
                                    @foreach($infoTags as $tag)
                                        <span style="display:inline-flex;align-items:center;padding:5px 11px;border-radius:999px;background:#eef7ff;color:#12385f;font-size:11px;font-weight:700;">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            @endif

                            <div style="display:flex;align-items:center;justify-content:space-between;gap:12px;">
                                <span style="font-size:12px;color:var(--text-muted);">{{ optional($item->created_at)->format('d M Y') }}</span>
                                <span style="font-size:13px;font-weight:700;color:var(--primary-light);">Baca selengkapnya →</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>

<section style="padding:0 5% 90px;background:#fff;">
    <div style="max-width:1180px;margin:0 auto;">
        <div class="card-pub" style="padding:28px;background:linear-gradient(135deg,#0d1f45,#1a3a6e);color:#fff;overflow:hidden;position:relative;">
            <div style="position:absolute;inset:auto -80px -80px auto;width:240px;height:240px;border-radius:50%;background:rgba(240,184,74,.14);pointer-events:none;"></div>
            <div style="position:relative;z-index:1;display:grid;grid-template-columns:1.2fr .8fr;gap:22px;align-items:center;">
                <div>
                    <div style="font-size:13px;font-weight:800;letter-spacing:.8px;text-transform:uppercase;color:#f0b84a;margin-bottom:10px;">Contact Person Tersedia</div>
                    <h3 style="font-family:'Poppins',sans-serif;font-size:28px;font-weight:800;line-height:1.2;margin-bottom:12px;">Jika ada yang perlu ditanyakan, hubungi contact person yang tersedia.</h3>
                    <p style="font-size:14px;line-height:1.8;color:rgba(255,255,255,.8);max-width:720px;">Tim kami siap membantu memberikan informasi lanjutan melalui telepon, WhatsApp, email, atau halaman kontak resmi.</p>
                </div>

                <div style="display:flex;flex-direction:column;gap:10px;">
                    @if(!empty($company->telepon))
                        <a href="tel:{{ $company->telepon }}" class="btn-pub btn-pub-accent" style="justify-content:center;">📞 {{ $company->telepon }}</a>
                    @endif
                    @if(!empty($company->whatsapp))
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->whatsapp) }}" target="_blank" rel="noopener noreferrer" class="btn-pub btn-pub-outline" style="justify-content:center;color:#fff;border-color:rgba(255,255,255,.3);">💬 WhatsApp</a>
                    @endif
                    @if(!empty($company->email))
                        <a href="mailto:{{ $company->email }}" class="btn-pub btn-pub-outline" style="justify-content:center;color:#fff;border-color:rgba(255,255,255,.3);">✉️ {{ $company->email }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    [data-news-card].is-hidden {
        display: none !important;
    }
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('news-search');
    const sortSelect = document.getElementById('news-sort');
    const sections = ['berita', 'informasi'];

    function normalize(text) {
        return (text || '').toString().trim().toLowerCase();
    }

    function applyFilterAndSort() {
        const query = normalize(searchInput ? searchInput.value : '');
        const sortValue = sortSelect ? sortSelect.value : 'newest';

        sections.forEach(function (section) {
            const grid = document.querySelector('[data-news-grid="' + section + '"]');
            const emptyState = document.querySelector('[data-empty-state="' + section + '"]');

            if (!grid) {
                return;
            }

            const cards = Array.from(grid.querySelectorAll('[data-news-card="' + section + '"]'));
            const visibleCards = [];

            cards.forEach(function (card) {
                const searchable = normalize(card.dataset.search);
                const matches = !query || searchable.includes(query);

                card.classList.toggle('is-hidden', !matches);

                if (matches) {
                    visibleCards.push(card);
                }
            });

            visibleCards.sort(function (a, b) {
                const aDate = Number(a.dataset.createdAt || 0);
                const bDate = Number(b.dataset.createdAt || 0);
                return sortValue === 'oldest' ? aDate - bDate : bDate - aDate;
            });

            visibleCards.forEach(function (card) {
                grid.appendChild(card);
            });

            if (emptyState) {
                emptyState.style.display = cards.some(function (card) {
                    return !card.classList.contains('is-hidden');
                }) ? 'none' : 'block';
            }
        });
    }

    if (searchInput) {
        searchInput.addEventListener('input', applyFilterAndSort);
    }

    if (sortSelect) {
        sortSelect.addEventListener('change', applyFilterAndSort);
    }

    applyFilterAndSort();
});
</script>
@endpush

@endsection
