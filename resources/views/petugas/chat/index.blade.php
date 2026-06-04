@extends('layouts.app')
@section('title', 'Chat dengan Anggota')

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none;background:linear-gradient(135deg,#06b6d4,#0891b2)">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center text-white">
                        <div style="width:70px;height:70px;background:rgba(255,255,255,0.2);border-radius:16px;display:flex;align-items:center;justify-content:center;margin-right:20px">
                            <i class="fas fa-comments fa-2x"></i>
                        </div>
                        <div>
                            <h3 class="mb-1 font-weight-bold">Chat & Komunikasi</h3>
                            <p class="mb-0" style="opacity:0.9">Hubungi admin, pimpinan, atau anggota untuk komunikasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Chat List --}}
    <div class="row">
        {{-- Admin & Pimpinan Section --}}
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-header" style="background:linear-gradient(135deg,#ef4444,#dc2626);border-radius:16px 16px 0 0;border:none;padding:20px">
                    <h5 class="mb-0 font-weight-bold text-white">
                        <i class="fas fa-user-shield mr-2"></i>Admin & Pimpinan
                    </h5>
                    <small class="text-white" style="opacity:0.9">Hubungi admin atau pimpinan untuk keperluan penting</small>
                </div>
                <div class="card-body p-0">
                    @if($adminPimpinan->count() > 0)
                        <div class="chat-list">
                            @foreach($adminPimpinan as $user)
                            <div class="chat-item admin-pimpinan-item" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}" data-user-role="{{ $user->role }}">
                                <div class="chat-avatar">
                                    @if($user->profile_photo)
                                        <img src="{{ asset('storage/'.$user->profile_photo) }}" alt="{{ $user->name }}">
                                    @else
                                        <div class="avatar-placeholder" style="background: linear-gradient(135deg, {{ $user->role == 'admin' ? '#ef4444, #dc2626' : '#8b5cf6, #7c3aed' }})">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    @if($user->unread_count > 0)
                                    <span class="online-badge"></span>
                                    @endif
                                </div>
                                <div class="chat-info">
                                    <div class="chat-header">
                                        <div>
                                            <h6 class="chat-name" style="color: {{ $user->role == 'admin' ? '#ef4444' : '#8b5cf6' }}">{{ $user->name }}</h6>
                                            <span class="badge badge-{{ $user->role == 'admin' ? 'danger' : 'primary' }}" style="font-size: 10px; padding: 3px 8px;">
                                                <i class="fas {{ $user->role == 'admin' ? 'fa-user-shield' : 'fa-user-tie' }} mr-1"></i>{{ strtoupper($user->role) }}
                                            </span>
                                        </div>
                                        @if($user->last_message)
                                        <span class="chat-time">
                                            {{ $user->last_message->created_at->diffForHumans() }}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="chat-preview">
                                        <p class="chat-message">
                                            @if($user->last_message)
                                                @if($user->last_message->pengirim_id == auth()->id())
                                                    <i class="fas fa-reply mr-1"></i>
                                                @endif
                                                {{ Str::limit($user->last_message->pesan, 50) }}
                                            @else
                                                <em class="text-muted">Klik untuk memulai percakapan</em>
                                            @endif
                                        </p>
                                        @if($user->unread_count > 0)
                                        <span class="unread-badge">{{ $user->unread_count }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state-small">
                            <i class="fas fa-user-shield"></i>
                            <p>Tidak ada admin atau pimpinan</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Anggota Section --}}
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-header" style="background:linear-gradient(135deg,#06b6d4,#0891b2);border-radius:16px 16px 0 0;border:none;padding:20px">
                    <h5 class="mb-0 font-weight-bold text-white">
                        <i class="fas fa-users mr-2"></i>Daftar Anggota
                        @if($totalUnread > 0)
                        <span class="badge badge-warning ml-2">{{ $totalUnread }} Pesan Baru</span>
                        @endif
                    </h5>
                    <small class="text-white" style="opacity:0.9">Pilih anggota yang ingin Anda hubungi</small>
                </div>
                <div class="card-body p-0">
                    @if($conversations->count() > 0)
                        <div class="chat-list">
                            @foreach($conversations as $user)
                            <div class="chat-item" data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}" data-user-role="{{ $user->role }}">
                                <div class="chat-avatar">
                                    @if($user->profile_photo)
                                        <img src="{{ asset('storage/'.$user->profile_photo) }}" alt="{{ $user->name }}">
                                    @else
                                        <div class="avatar-placeholder" style="background: linear-gradient(135deg, #06b6d4, #0891b2)">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    @if($user->unread_count > 0)
                                    <span class="online-badge"></span>
                                    @endif
                                </div>
                                <div class="chat-info">
                                    <div class="chat-header">
                                        <div>
                                            <h6 class="chat-name">{{ $user->name }}</h6>
                                            @if($user->anggota_info)
                                            <span class="badge badge-success" style="font-size: 10px; padding: 3px 8px;">
                                                ANGGOTA - {{ strtoupper($user->anggota_info->status) }}
                                            </span>
                                            @else
                                            <span class="badge badge-secondary" style="font-size: 10px; padding: 3px 8px;">
                                                {{ strtoupper($user->role) }}
                                            </span>
                                            @endif
                                        </div>
                                        @if($user->last_message)
                                        <span class="chat-time">
                                            {{ $user->last_message->created_at->diffForHumans() }}
                                        </span>
                                        @endif
                                    </div>
                                    <div class="chat-preview">
                                        <p class="chat-message">
                                            @if($user->last_message)
                                                @if($user->last_message->pengirim_id == auth()->id())
                                                    <i class="fas fa-reply mr-1"></i>
                                                @endif
                                                {{ Str::limit($user->last_message->pesan, 50) }}
                                            @else
                                                <em class="text-muted">Klik untuk memulai percakapan</em>
                                            @endif
                                        </p>
                                        @if($user->unread_count > 0)
                                        <span class="unread-badge">{{ $user->unread_count }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state-small">
                            <i class="fas fa-users-slash"></i>
                            <p>Tidak ada anggota</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Chat Modal --}}
<div class="modal fade" id="chatModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius:16px;border:none;height:600px;display:flex;flex-direction:column">
            <div class="modal-header" style="background:linear-gradient(135deg,#06b6d4,#0891b2);color:white;border-radius:16px 16px 0 0;padding:20px">
                <div class="d-flex align-items-center">
                    <div id="chatUserAvatar" style="width:45px;height:45px;border-radius:50%;background:rgba(255,255,255,0.3);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;margin-right:15px;font-size:18px"></div>
                    <div>
                        <h5 class="modal-title font-weight-bold mb-0" id="chatUserName"></h5>
                        <small id="chatUserRole"></small>
                    </div>
                </div>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body p-0" style="flex:1;overflow:hidden;display:flex;flex-direction:column">
                <div id="chatMessages" style="flex:1;overflow-y:auto;padding:20px;background:#f8f9fa"></div>
                <div style="padding:20px;border-top:1px solid #e5e7eb;background:white">
                    <div id="editMode" class="chat-input-edit-mode">
                        <small><i class="fas fa-edit mr-1"></i>Edit Pesan</small>
                        <button onclick="cancelEdit()"><i class="fas fa-times"></i></button>
                    </div>
                    <form id="chatForm" class="d-flex gap-2">
                        <input type="text" id="messageInput" class="form-control" placeholder="Ketik pesan..." required autocomplete="off" style="border-radius:25px;padding:12px 20px">
                        <button type="submit" id="sendBtn" class="btn btn-info" style="border-radius:25px;padding:12px 30px;white-space:nowrap;background:linear-gradient(135deg,#06b6d4,#0891b2);border:none">
                            <i class="fas fa-paper-plane mr-1"></i>Kirim
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.chat-list {
    max-height: 600px;
    overflow-y: auto;
}

.chat-item {
    display: flex;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid #e5e7eb;
    transition: all 0.3s;
    cursor: pointer;
}

.chat-item:hover {
    background: linear-gradient(135deg, #cffafe, #a5f3fc);
    transform: translateX(5px);
}

.chat-item.admin-pimpinan-item:hover {
    background: linear-gradient(135deg, #fee2e2, #fecaca);
}

.chat-item:last-child {
    border-bottom: none;
}

.chat-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    margin-right: 16px;
    position: relative;
    flex-shrink: 0;
}

.chat-avatar img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #e5e7eb;
}

.avatar-placeholder {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
    font-weight: 700;
}

.online-badge {
    position: absolute;
    bottom: 2px;
    right: 2px;
    width: 16px;
    height: 16px;
    background: #06b6d4;
    border: 3px solid white;
    border-radius: 50%;
}

.chat-info {
    flex: 1;
    min-width: 0;
}

.chat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 6px;
}

.chat-name {
    font-weight: 700;
    color: #0891b2;
    margin: 0;
    font-size: 1rem;
}

.chat-time {
    font-size: 12px;
    color: #6b7280;
    font-weight: 600;
}

.chat-preview {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chat-message {
    margin: 0;
    color: #6b7280;
    font-size: 14px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    flex: 1;
}

.unread-badge {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 700;
    margin-left: 10px;
}

.empty-state {
    text-align: center;
    padding: 80px 20px;
}

.empty-state i {
    font-size: 64px;
    color: #d1d5db;
    margin-bottom: 20px;
}

.empty-state h5 {
    color: #1f2937;
    font-weight: 700;
    margin-bottom: 10px;
}

.empty-state p {
    color: #6b7280;
    margin-bottom: 20px;
}

.empty-state-small {
    text-align: center;
    padding: 40px 20px;
}

.empty-state-small i {
    font-size: 48px;
    color: #d1d5db;
    margin-bottom: 10px;
    display: block;
}

.empty-state-small p {
    color: #6b7280;
    margin: 0;
    font-size: 14px;
}

.chat-message-item {
    display: flex;
    margin-bottom: 15px;
    animation: fadeIn 0.3s;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.chat-message-item.sent {
    justify-content: flex-end;
}

.chat-message-wrapper {
    position: relative;
    max-width: 60%;
}

.chat-message-bubble {
    padding: 12px 16px;
    border-radius: 18px;
    font-size: 14px;
    line-height: 1.5;
    word-wrap: break-word;
}

.chat-message-item.received .chat-message-bubble {
    background: white;
    color: #2c3e50;
    border-bottom-left-radius: 4px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.chat-message-item.sent .chat-message-bubble {
    background: linear-gradient(135deg, #06b6d4, #0891b2);
    color: white;
    border-bottom-right-radius: 4px;
}

.chat-message-time {
    font-size: 11px;
    color: #7a92ab;
    margin-top: 4px;
}

.chat-message-actions {
    position: absolute;
    top: -8px;
    right: -8px;
    display: none;
    gap: 5px;
    background: white;
    border-radius: 20px;
    padding: 4px 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}

.chat-message-item.sent:hover .chat-message-actions {
    display: flex;
}

.chat-message-actions button {
    background: none;
    border: none;
    cursor: pointer;
    padding: 4px 8px;
    font-size: 12px;
    color: #7a92ab;
    transition: all 0.2s;
}

.chat-message-actions button:hover {
    color: #0891b2;
}

.chat-message-actions .btn-delete:hover {
    color: #dc3545;
}

.chat-input-edit-mode {
    background: #fff3cd;
    padding: 8px 15px;
    border-radius: 8px;
    margin-bottom: 10px;
    display: none;
    align-items: center;
    justify-content: space-between;
}

.chat-input-edit-mode.active {
    display: flex;
}

.chat-input-edit-mode small {
    color: #856404;
    font-weight: 600;
}

.chat-input-edit-mode button {
    background: none;
    border: none;
    color: #856404;
    cursor: pointer;
    padding: 0 8px;
}

@media (max-width: 768px) {
    .chat-avatar {
        width: 50px;
        height: 50px;
    }
}
</style>

@push('scripts')
<script>
let currentUserId = null;
let currentUserName = '';
let currentUserRole = '';
let editingMessageId = null;
let isSubmitting = false;

// Click chat item
$(document).on('click', '.chat-item', function() {
    currentUserId = $(this).data('user-id');
    currentUserName = $(this).data('user-name');
    currentUserRole = $(this).data('user-role');
    
    // Hilangkan badge unread pada item ini
    $(this).find('.unread-badge').fadeOut(300, function() {
        $(this).remove();
    });
    $(this).find('.online-badge').fadeOut(300, function() {
        $(this).remove();
    });
    
    cancelEdit();
    loadMessages(currentUserId);
    $('#chatModal').modal('show');
});

// Load messages
function loadMessages(userId) {
    $.ajax({
        url: `/petugas/chat/${userId}`,
        method: 'GET',
        success: function(response) {
            if (response.success) {
                renderChatModal(response.user, response.messages);
            }
        },
        error: function() {
            alert('Gagal memuat pesan');
        }
    });
}

// Render chat modal
function renderChatModal(user, messages) {
    const initial = user.name.charAt(0).toUpperCase();
    let roleLabel = 'ANGGOTA';
    let avatarColor = 'linear-gradient(135deg, #06b6d4, #0891b2)';
    let headerColor = 'linear-gradient(135deg,#06b6d4,#0891b2)';
    
    if (user.role === 'admin') {
        roleLabel = 'ADMIN';
        avatarColor = 'linear-gradient(135deg, #ef4444, #dc2626)';
        headerColor = 'linear-gradient(135deg,#ef4444,#dc2626)';
    } else if (user.role === 'pimpinan') {
        roleLabel = 'PIMPINAN';
        avatarColor = 'linear-gradient(135deg, #8b5cf6, #7c3aed)';
        headerColor = 'linear-gradient(135deg,#8b5cf6,#7c3aed)';
    } else if (user.anggota_info) {
        roleLabel = 'ANGGOTA - ' + user.anggota_info.status.toUpperCase();
    } else {
        roleLabel = user.role.toUpperCase();
    }
    
    $('#chatUserAvatar').text(initial).css('background', avatarColor);
    $('#chatUserName').text(user.name);
    $('#chatUserRole').html(`<span class="badge badge-light">${roleLabel}</span>`);
    
    // Update modal header color
    $('.modal-header').css('background', headerColor);
    
    let html = '';
    messages.forEach(msg => {
        const isSent = msg.pengirim_id == {{ Auth::id() }};
        const time = new Date(msg.created_at).toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'});
        
        html += `
            <div class="chat-message-item ${isSent ? 'sent' : 'received'}" data-message-id="${msg.id}">
                <div class="chat-message-wrapper">
                    <div class="chat-message-bubble">${escapeHtml(msg.pesan)}</div>
                    <div class="chat-message-time ${isSent ? 'text-right' : ''}">${time}</div>
                    ${isSent ? `
                    <div class="chat-message-actions">
                        <button class="btn-edit" onclick="editMessage(${msg.id}, '${escapeHtml(msg.pesan)}')">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-delete" onclick="deleteMessage(${msg.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    ` : ''}
                </div>
            </div>
        `;
    });
    
    $('#chatMessages').html(html);
    scrollToBottom();
}

// Send or update message
$(document).on('submit', '#chatForm', function(e) {
    e.preventDefault();
    
    if (isSubmitting) return;
    
    const message = $('#messageInput').val().trim();
    if (!message || !currentUserId) return;
    
    const $button = $('#sendBtn');
    const $input = $('#messageInput');
    
    isSubmitting = true;
    $button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Mengirim...');
    
    const url = editingMessageId ? `/petugas/chat/${editingMessageId}` : '/petugas/chat';
    const method = editingMessageId ? 'PUT' : 'POST';
    
    $.ajax({
        url: url,
        method: method,
        data: {
            _token: '{{ csrf_token() }}',
            penerima_id: currentUserId,
            pesan: message
        },
        success: function(response) {
            if (response.success) {
                $input.val('');
                cancelEdit();
                loadMessages(currentUserId);
            }
        },
        error: function(xhr) {
            alert('Gagal mengirim pesan: ' + (xhr.responseJSON?.message || 'Terjadi kesalahan'));
        },
        complete: function() {
            isSubmitting = false;
            $button.prop('disabled', false).html('<i class="fas fa-paper-plane mr-1"></i>Kirim');
            $input.focus();
        }
    });
});

// Edit message
function editMessage(messageId, messageText) {
    editingMessageId = messageId;
    $('#messageInput').val(messageText).focus();
    $('#editMode').addClass('active');
    $('#sendBtn').html('<i class="fas fa-check mr-1"></i>Update');
}

// Cancel edit
function cancelEdit() {
    editingMessageId = null;
    $('#messageInput').val('');
    $('#editMode').removeClass('active');
    $('#sendBtn').html('<i class="fas fa-paper-plane mr-1"></i>Kirim');
}

// Delete message
function deleteMessage(messageId) {
    if (!confirm('Hapus pesan ini?')) return;
    
    $.ajax({
        url: `/petugas/chat/${messageId}`,
        method: 'DELETE',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                loadMessages(currentUserId);
            }
        },
        error: function() {
            alert('Gagal menghapus pesan');
        }
    });
}

// Escape HTML
function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, m => map[m]);
}

// Scroll to bottom
function scrollToBottom() {
    setTimeout(() => {
        const messages = document.getElementById('chatMessages');
        if (messages) {
            messages.scrollTop = messages.scrollHeight;
        }
    }, 100);
}

// Auto refresh when modal is open
setInterval(function() {
    if (currentUserId && $('#chatModal').hasClass('show') && !isSubmitting && !editingMessageId) {
        const currentScroll = $('#chatMessages').scrollTop();
        const maxScroll = $('#chatMessages')[0]?.scrollHeight - $('#chatMessages').outerHeight();
        const isAtBottom = Math.abs(maxScroll - currentScroll) < 50;
        
        $.ajax({
            url: `/petugas/chat/${currentUserId}`,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    const currentInput = $('#messageInput').val();
                    renderChatModal(response.user, response.messages);
                    $('#messageInput').val(currentInput);
                    
                    if (isAtBottom) {
                        scrollToBottom();
                    }
                }
            }
        });
    }
}, 5000);
</script>
@endpush
@endsection
