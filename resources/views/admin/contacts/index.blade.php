@extends('admin.layouts.app')
@section('page-title', 'Pesan Masuk')
{{-- @section('breadcrumb') / Pesan Masuk@endsection --}}

@section('content')
<div class="card">
    <div class="card-header">
        <h3>📬 Pesan Masuk dari Website
            @php $unread = App\Models\ContactMessage::where('is_read', false)->count(); @endphp
            @if($unread > 0)
                <span class="badge badge-danger" style="margin-left:8px;">{{ $unread }} belum dibaca</span>
            @endif
        </h3>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Pesan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                <tr style="{{ !$msg->is_read ? 'background:#fefce8;' : '' }}">
                    <td>
                        @if(!$msg->is_read)
                            <span class="unread-dot"></span>
                        @endif
                    </td>
                    <td style="font-weight:{{ !$msg->is_read ? '700' : '400' }};">
                        <a href="{{ route('admin.contacts.show', $msg) }}" style="color:inherit;text-decoration:none;">
                            {{ $msg->nama }}
                        </a>
                    </td>
                    <td style="color:var(--text-muted);font-size:12px;">{{ $msg->email }}</td>
                    <td style="max-width:280px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;font-size:13px;">
                        {{ $msg->pesan }}
                    </td>
                    <td style="font-size:12px;color:var(--text-muted);white-space:nowrap;">{{ $msg->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.contacts.update-status', $msg) }}" method="POST">
                            @csrf @method('PATCH')
                            <select name="status" class="status-select status-select-{{ $msg->statusColor() }}"
                                    onchange="this.className = 'status-select status-select-' + (this.options[this.selectedIndex].dataset.color); this.form.submit();">
                                @foreach(\App\Models\ContactMessage::statusOptions() as $value => $opt)
                                    <option value="{{ $value }}" data-color="{{ $opt['color'] }}" {{ $msg->status === $value ? 'selected' : '' }}>
                                        {{ $opt['label'] }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted);">
                        Belum ada pesan masuk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($messages->hasPages())
    <div style="padding:16px 22px;border-top:1px solid var(--border);">
        {{ $messages->links() }}
    </div>
    @endif
</div>
@endsection
