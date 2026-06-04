@extends('layouts.app')
@section('title', 'Chat & Pesan')
@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none;background:linear-gradient(135deg,#a04000,#f39c12)">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center text-white">
                        <div style="width:70px;height:70px;background:rgba(255,255,255,0.2);border-radius:16px;display:flex;align-items:center;justify-content:center;margin-right:20px">
                            <i class="fas fa-comments fa-2x"></i>
                        </div>
                        <div>
                            <h3 class="mb-1 font-weight-bold">Chat & Komunikasi</h3>
                            <p class="mb-0" style="opacity:0.9">Hubungi Admin atau Petugas Dinas untuk keperluan koperasi Anda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-header" style="background:linear-gradient(135deg,#a04000,#f39c12);border-radius:16px 16px 0 0;border:none;padding:20px">
                    <h5 class="mb-0 font-weight-bold text-white">
                        <i class="fas fa-headset mr-2"></i>Kontak Dinas
                        @if($totalUnread > 0)
                        <span class="badge badge-light ml-2">{{ $totalUnread }} Pesan Baru</span>
                        @endif
                    </h5>
                    <small class="text-white" style="opacity:0.9">Pilih petugas yang ingin Anda hubungi</small>
                </div>
                <div class="card-body p-0">
                    @forelse($contacts as $user)
                    <div class="chat-item d-flex align-items-center p-4" 
                         data-user-id="{{ $user->id }}" 
                         data-user-name="{{ $user->name }}"
                         data-user-role="{{ $user->role }}"
                         style="border-bottom:1px solid #e5e7eb;cursor:pointer;transition:all 0.3s">
                        <div style="width:55px;height:55px;border-radius:50%;background:linear-gradient(135deg,#a04000,#f39c12);display:flex;align-items:center;justify-content:center;color:white;font-size:20px;font-weight:700;margin-right:16px;flex-shrink:0;position:relative">
                            {{ strtoupper(substr($user->name,0,1)) }}
                            @if($user->unread_count > 0)
                            <span style="position:absolute;top:-3px;right:-3px;width:18px;height:18px;background:#ef4444;border-radius:50%;border:2px solid white;display:flex;align-items:center;justify-content:center;font-size:9px">{{ $user->unread_count }}</span>
                            @endif
                        </div>
                        <div style="flex:1">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h6 class="mb-0 font-weight-bold">{{ $user->name }}</h6>
                                @if($user->last_message)
                                <small class="text-muted">{{ $user->last_message->created_at->diffForHumans() }}</small>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge badge-{{ $user->role=='admin' ? 'danger' : ($user->role=='pimpinan' ? 'primary' : 'success') }} mr-2" style="font-size:10px">
                                    {{ strtoupper($user->role) }}
                                </span>
                                <small class="text-muted">
                                    @if($user->last_message)
                                        {{ Str::limit($user->last_message->pesan, 40) }}
                                    @else
                                        <em>Klik untuk memulai percakapan</em>
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-headset fa-3x mb-3 d-block" style="opacity:.2"></i>
                        <p>Tidak ada kontak tersedia</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Chat Modal --}}
<div class="modal fade" id="chatModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;border:none;height:600px;display:flex;flex-direction:column">
            <div class="modal-header" style="background:linear-gradient(135deg,#a04000,#f39c12);color:white;border-radius:16px 16px 0 0;padding:20px">
                <div class="d-flex align-items-center">
                    <div id="chatAvatar" style="width:45px;height:45px;border-radius:50%;background:rgba(255,255,255,0.3);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;margin-right:15px;font-size:18px"></div>
                    <div>
                        <h5 class="modal-title font-weight-bold mb-0" id="chatName"></h5>
                        <small id="chatRole"></small>
                    </div>
                </div>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body p-0" style="flex:1;overflow:hidden;display:flex;flex-direction:column">
                <div id="chatMessages" style="flex:1;overflow-y:auto;padding:20px;background:#f8f9fa"></div>
                <div style="padding:20px;border-top:1px solid #e5e7eb;background:white">
                    <form id="chatForm" class="d-flex" style="gap:10px">
                        <input type="text" id="msgInput" class="form-control" placeholder="Ketik pesan..." required autocomplete="off" style="border-radius:25px;padding:12px 20px">
                        <button type="submit" id="sendBtn" class="btn" style="border-radius:25px;padding:12px 25px;background:linear-gradient(135deg,#a04000,#f39c12);color:white;border:none;white-space:nowrap">
                            <i class="fas fa-paper-plane mr-1"></i>Kirim
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
let currentUserId = null;
let isSubmitting = false;

$(document).on('click', '.chat-item', function() {
    currentUserId = $(this).data('user-id');
    const name = $(this).data('user-name');
    const role = $(this).data('user-role');
    $('#chatAvatar').text(name.charAt(0).toUpperCase());
    $('#chatName').text(name);
    $('#chatRole').html('<span class="badge badge-light">' + role.toUpperCase() + '</span>');
    loadMessages(currentUserId);
    $('#chatModal').modal('show');
});

function loadMessages(userId) {
    $.get('/koperasi-portal/chat/' + userId, function(res) {
        if (res.success) renderMessages(res.messages);
    });
}

function renderMessages(messages) {
    let html = '';
    messages.forEach(msg => {
        const isSent = msg.pengirim_id == {{ auth()->id() }};
        const time = new Date(msg.created_at).toLocaleTimeString('id-ID', {hour:'2-digit',minute:'2-digit'});
        html += `<div class="d-flex ${isSent ? 'justify-content-end' : ''} mb-3">
            <div style="max-width:60%">
                <div style="padding:12px 16px;border-radius:18px;${isSent ? 'background:linear-gradient(135deg,#a04000,#f39c12);color:white;border-bottom-right-radius:4px' : 'background:white;box-shadow:0 2px 8px rgba(0,0,0,0.08);border-bottom-left-radius:4px'}">${msg.pesan}</div>
                <small class="text-muted d-block ${isSent ? 'text-right' : ''} mt-1">${time}</small>
            </div>
        </div>`;
    });
    $('#chatMessages').html(html);
    setTimeout(() => { $('#chatMessages').scrollTop($('#chatMessages')[0].scrollHeight); }, 100);
}

$(document).on('submit', '#chatForm', function(e) {
    e.preventDefault();
    if (isSubmitting || !currentUserId) return;
    const msg = $('#msgInput').val().trim();
    if (!msg) return;
    isSubmitting = true;
    $('#sendBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
    $.ajax({
        url: '/koperasi-portal/chat',
        method: 'POST',
        data: { _token: '{{ csrf_token() }}', penerima_id: currentUserId, pesan: msg },
        success: function(res) {
            if (res.success) { $('#msgInput').val(''); loadMessages(currentUserId); }
        },
        complete: function() {
            isSubmitting = false;
            $('#sendBtn').prop('disabled', false).html('<i class="fas fa-paper-plane mr-1"></i>Kirim');
        }
    });
});

setInterval(function() {
    if (currentUserId && $('#chatModal').hasClass('show') && !isSubmitting) {
        loadMessages(currentUserId);
    }
}, 5000);
</script>
@endpush
@endsection
