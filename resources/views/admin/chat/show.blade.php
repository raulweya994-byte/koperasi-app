@extends('layouts.app')
@section('title', 'Chat dengan ' . $user->name)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="chat-container">
                {{-- Chat Header --}}
                <div class="chat-header-box">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('admin.chat.index') }}" class="btn-back">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <div class="chat-user-avatar">
                            @if($user->anggota && $user->anggota->foto)
                                <img src="{{ asset('storage/'.$user->anggota->foto) }}" alt="{{ $user->name }}">
                            @else
                                <div class="avatar-placeholder">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <h5 class="mb-0 font-weight-bold">{{ $user->name }}</h5>
                            <p class="mb-0 text-muted" style="font-size:13px">
                                <i class="fas fa-circle text-success" style="font-size:8px"></i> Online
                            </p>
                        </div>
                    </div>
                    <div>
                        @if($user->anggota)
                        <span class="badge badge-primary" style="padding:8px 14px;border-radius:10px">
                            <i class="fas fa-id-card mr-1"></i>{{ $user->anggota->no_anggota }}
                        </span>
                        @endif
                    </div>
                </div>

                {{-- Chat Messages --}}
                <div class="chat-messages" id="chatMessages">
                    @forelse($messages as $message)
                        @if($message->pengirim_id == auth()->id())
                            {{-- Pesan dari admin (kanan) --}}
                            <div class="message-wrapper message-right" data-message-id="{{ $message->id }}">
                                <div class="message-bubble message-sent">
                                    <div class="message-actions">
                                        <button class="btn-message-action" onclick="editMessage({{ $message->id }}, '{{ addslashes($message->pesan) }}')" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn-message-action" onclick="deleteMessage({{ $message->id }})" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    <div class="message-content" id="message-content-{{ $message->id }}">
                                        {{ $message->pesan }}
                                    </div>
                                    @if($message->file)
                                    <div class="message-file">
                                        @php
                                            $extension = pathinfo($message->file, PATHINFO_EXTENSION);
                                            $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                        @endphp
                                        
                                        @if($isImage)
                                            {{-- Preview Gambar --}}
                                            <div class="file-image-preview">
                                                <a href="{{ asset('storage/'.$message->file) }}" target="_blank" data-lightbox="chat-{{ $message->id }}">
                                                    <img src="{{ asset('storage/'.$message->file) }}" alt="Image" class="chat-image">
                                                    <div class="image-overlay">
                                                        <i class="fas fa-search-plus"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        @else
                                            {{-- File Dokumen --}}
                                            <a href="{{ asset('storage/'.$message->file) }}" target="_blank" class="file-document">
                                                <div class="file-icon">
                                                    @if(in_array($extension, ['pdf']))
                                                        <i class="fas fa-file-pdf"></i>
                                                    @elseif(in_array($extension, ['doc', 'docx']))
                                                        <i class="fas fa-file-word"></i>
                                                    @elseif(in_array($extension, ['xls', 'xlsx']))
                                                        <i class="fas fa-file-excel"></i>
                                                    @elseif(in_array($extension, ['zip', 'rar']))
                                                        <i class="fas fa-file-archive"></i>
                                                    @else
                                                        <i class="fas fa-file"></i>
                                                    @endif
                                                </div>
                                                <div class="file-info">
                                                    <div class="file-name">{{ basename($message->file) }}</div>
                                                    <div class="file-size">{{ number_format(Storage::disk('public')->size($message->file) / 1024, 2) }} KB</div>
                                                </div>
                                                <div class="file-download">
                                                    <i class="fas fa-download"></i>
                                                    <span>Download</span>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                    @endif
                                    <div class="message-time">
                                        {{ $message->created_at->format('H:i') }}
                                        @if($message->is_read)
                                            <i class="fas fa-check-double text-primary ml-1"></i>
                                        @else
                                            <i class="fas fa-check ml-1"></i>
                                        @endif
                                        @if($message->updated_at != $message->created_at)
                                            <span class="edited-badge">diedit</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- Pesan dari anggota (kiri) --}}
                            <div class="message-wrapper message-left">
                                <div class="message-bubble message-received">
                                    <div class="message-content">
                                        {{ $message->pesan }}
                                    </div>
                                    @if($message->file)
                                    <div class="message-file">
                                        @php
                                            $extension = pathinfo($message->file, PATHINFO_EXTENSION);
                                            $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                                        @endphp
                                        
                                        @if($isImage)
                                            {{-- Preview Gambar --}}
                                            <div class="file-image-preview">
                                                <a href="{{ asset('storage/'.$message->file) }}" target="_blank" data-lightbox="chat-{{ $message->id }}">
                                                    <img src="{{ asset('storage/'.$message->file) }}" alt="Image" class="chat-image">
                                                    <div class="image-overlay">
                                                        <i class="fas fa-search-plus"></i>
                                                    </div>
                                                </a>
                                            </div>
                                        @else
                                            {{-- File Dokumen --}}
                                            <div class="file-document-wrapper">
                                                <div class="file-document-card">
                                                    <div class="file-icon">
                                                        @if(in_array($extension, ['pdf']))
                                                            <i class="fas fa-file-pdf"></i>
                                                        @elseif(in_array($extension, ['doc', 'docx']))
                                                            <i class="fas fa-file-word"></i>
                                                        @elseif(in_array($extension, ['xls', 'xlsx']))
                                                            <i class="fas fa-file-excel"></i>
                                                        @elseif(in_array($extension, ['zip', 'rar']))
                                                            <i class="fas fa-file-archive"></i>
                                                        @else
                                                            <i class="fas fa-file"></i>
                                                        @endif
                                                    </div>
                                                    <div class="file-info">
                                                        <div class="file-name">{{ basename($message->file) }}</div>
                                                        <div class="file-size">{{ number_format(Storage::disk('public')->size($message->file) / 1024, 2) }} KB</div>
                                                    </div>
                                                </div>
                                                <div class="file-actions">
                                                    <a href="{{ route('admin.chat.download', $message->id) }}" class="file-action-btn download-btn">
                                                        <i class="fas fa-download mr-1"></i>Download
                                                    </a>
                                                    @if(in_array($extension, ['pdf']))
                                                    <a href="{{ asset('storage/'.$message->file) }}" target="_blank" class="file-action-btn view-btn">
                                                        <i class="fas fa-eye mr-1"></i>Lihat
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    @endif
                                    <div class="message-time">
                                        {{ $message->created_at->format('H:i') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="empty-chat">
                            <i class="fas fa-comments"></i>
                            <p>Belum ada pesan. Mulai percakapan!</p>
                        </div>
                    @endforelse
                </div>

                {{-- Chat Input --}}
                <div class="chat-input-box">
                    <form id="chatForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="penerima_id" value="{{ $user->id }}">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label for="fileInput" class="btn-attach">
                                    <i class="fas fa-paperclip"></i>
                                    <input type="file" id="fileInput" name="file" style="display:none" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                </label>
                            </div>
                            <textarea class="form-control chat-input" name="pesan" id="pesanInput" placeholder="Ketik pesan..." rows="1"></textarea>
                            <div class="input-group-append">
                                <button type="submit" class="btn-send">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                        <div id="filePreview" class="mt-2" style="display:none"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal untuk View Gambar --}}
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="background:transparent;border:none">
            <div class="modal-body p-0" style="position:relative">
                <button type="button" class="close-modal" onclick="$('#imageModal').modal('hide')">
                    <i class="fas fa-times"></i>
                </button>
                <img id="modalImage" src="" alt="Image" style="width:100%;height:auto;border-radius:12px;max-height:80vh;object-fit:contain">
                <div class="modal-actions">
                    <a id="downloadImageBtn" href="" class="modal-action-btn download-modal-btn">
                        <i class="fas fa-download mr-2"></i>Download Gambar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.chat-container {
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    overflow: hidden;
    height: calc(100vh - 140px);
    display: flex;
    flex-direction: column;
}

.chat-header-box {
    background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
    color: white;
    padding: 20px 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 3px solid #f5a623;
}

.btn-back {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    margin-right: 15px;
    transition: all 0.3s;
}

.btn-back:hover {
    background: rgba(255,255,255,0.3);
    color: white;
}

.chat-user-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 15px;
}

.chat-user-avatar img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid rgba(255,255,255,0.3);
}

.avatar-placeholder {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background: linear-gradient(135deg, #f5a623, #f59e0b);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    font-weight: 700;
}

.chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 25px;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
}

.message-wrapper {
    display: flex;
    margin-bottom: 16px;
}

.message-left {
    justify-content: flex-start;
}

.message-right {
    justify-content: flex-end;
}

.message-bubble {
    max-width: 60%;
    padding: 12px 16px;
    border-radius: 16px;
    position: relative;
}

.message-sent {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    border-bottom-right-radius: 4px;
}

.message-sent:hover .message-actions {
    opacity: 1;
}

.message-actions {
    position: absolute;
    top: -8px;
    right: -8px;
    display: flex;
    gap: 4px;
    opacity: 0;
    transition: opacity 0.3s;
}

.btn-message-action {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    border: none;
    background: rgba(255,255,255,0.95);
    color: #1f2937;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 12px;
    transition: all 0.3s;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}

.btn-message-action:hover {
    transform: scale(1.1);
    background: white;
}

.btn-message-action:first-child:hover {
    color: #3b82f6;
}

.btn-message-action:last-child:hover {
    color: #ef4444;
}

.edited-badge {
    font-size: 10px;
    opacity: 0.7;
    font-style: italic;
    margin-left: 4px;
}

.message-received {
    background: white;
    color: #1f2937;
    border-bottom-left-radius: 4px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.message-content {
    word-wrap: break-word;
    line-height: 1.5;
    font-size: 14px;
}

.message-file {
    margin-top: 8px;
}

.file-image-preview {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    max-width: 300px;
    cursor: pointer;
}

.file-image-preview a {
    display: block;
    position: relative;
}

.chat-image {
    width: 100%;
    height: auto;
    max-height: 300px;
    object-fit: cover;
    display: block;
    border-radius: 12px;
    transition: transform 0.3s;
    cursor: pointer;
}

.file-image-preview:hover .chat-image {
    transform: scale(1.05);
}

.image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
    border-radius: 12px;
}

.image-overlay i {
    color: white;
    font-size: 32px;
}

.file-image-preview:hover .image-overlay {
    opacity: 1;
}

.image-actions-overlay {
    position: absolute;
    bottom: 10px;
    right: 10px;
    display: flex;
    gap: 8px;
    opacity: 0;
    transition: opacity 0.3s;
}

.file-image-preview:hover .image-actions-overlay {
    opacity: 1;
}

.image-action-btn {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255,255,255,0.95);
    color: #1f2937;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    text-decoration: none;
}

.image-action-btn:hover {
    transform: scale(1.1);
    background: white;
    color: #3b82f6;
    text-decoration: none;
}

/* Modal Styles */
.close-modal {
    position: absolute;
    top: -40px;
    right: 0;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255,255,255,0.9);
    border: none;
    color: #1f2937;
    font-size: 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
    z-index: 10;
}

.close-modal:hover {
    background: white;
    transform: rotate(90deg);
}

.modal-actions {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 10;
}

.modal-action-btn {
    padding: 14px 32px;
    border-radius: 12px;
    border: none;
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    font-weight: 700;
    font-size: 15px;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
    display: flex;
    align-items: center;
    box-shadow: 0 4px 20px rgba(59,130,246,0.5);
}

.modal-action-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(59,130,246,0.7);
    color: white;
    text-decoration: none;
}

.download-modal-btn {
    background: linear-gradient(135deg, #10b981, #059669);
    box-shadow: 0 4px 20px rgba(16,185,129,0.5);
}

.download-modal-btn:hover {
    box-shadow: 0 8px 30px rgba(16,185,129,0.7);
}

.file-document {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    background: rgba(255,255,255,0.1);
    border-radius: 10px;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s;
    border: 1px solid rgba(255,255,255,0.2);
}

.message-received .file-document {
    background: #f3f4f6;
    border: 1px solid #e5e7eb;
}

.file-document:hover {
    background: rgba(255,255,255,0.2);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.message-received .file-document:hover {
    background: #e5e7eb;
}

.file-document-wrapper {
    background: rgba(255,255,255,0.1);
    border-radius: 12px;
    padding: 12px;
    border: 1px solid rgba(255,255,255,0.2);
}

.message-received .file-document-wrapper {
    background: #f3f4f6;
    border: 1px solid #e5e7eb;
}

.file-document-card {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 10px;
}

.file-actions {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.file-action-btn {
    flex: 1;
    min-width: 100px;
    padding: 8px 16px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
    border: none;
    cursor: pointer;
}

.download-btn {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
}

.download-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59,130,246,0.4);
    color: white;
    text-decoration: none;
}

.view-btn {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.view-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(16,185,129,0.4);
    color: white;
    text-decoration: none;
}

.file-icon {
    width: 48px;
    height: 48px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    flex-shrink: 0;
}

.file-icon .fa-file-pdf {
    color: #ef4444;
}

.file-icon .fa-file-word {
    color: #3b82f6;
}

.file-icon .fa-file-excel {
    color: #10b981;
}

.file-icon .fa-file-archive {
    color: #f59e0b;
}

.file-icon .fa-file {
    color: #6b7280;
}

.file-info {
    flex: 1;
    min-width: 0;
}

.file-name {
    font-weight: 600;
    font-size: 13px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 4px;
}

.file-size {
    font-size: 11px;
    opacity: 0.7;
}

.message-time {
    font-size: 11px;
    margin-top: 6px;
    opacity: 0.8;
    text-align: right;
}

.empty-chat {
    text-align: center;
    padding: 80px 20px;
    color: #9ca3af;
}

.empty-chat i {
    font-size: 64px;
    margin-bottom: 15px;
}

.chat-input-box {
    padding: 20px 25px;
    background: white;
    border-top: 2px solid #e5e7eb;
}

.chat-input {
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    padding: 12px 16px;
    resize: none;
    font-size: 14px;
    max-height: 120px;
}

.chat-input:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
}

.btn-attach {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #f59e0b, #d97706);
    border: none;
    border-radius: 12px;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s;
    margin-right: 10px;
}

.btn-attach:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(245,158,11,0.3);
}

.btn-send {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #10b981, #059669);
    border: none;
    border-radius: 12px;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s;
    margin-left: 10px;
}

.btn-send:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(16,185,129,0.3);
}

.chat-messages::-webkit-scrollbar {
    width: 6px;
}

.chat-messages::-webkit-scrollbar-track {
    background: #f1f5f9;
}

.chat-messages::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}

@media (max-width: 768px) {
    .message-bubble {
        max-width: 80%;
    }
}
</style>

@push('scripts')
<script>
// Auto resize textarea
$('#pesanInput').on('input', function() {
    this.style.height = 'auto';
    this.style.height = (this.scrollHeight) + 'px';
});

// File preview
$('#fileInput').on('change', function() {
    if (this.files.length > 0) {
        const file = this.files[0];
        const fileName = file.name;
        const fileSize = (file.size / 1024).toFixed(2);
        const extension = fileName.split('.').pop().toLowerCase();
        const isImage = ['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(extension);
        
        let iconClass = 'fa-file';
        let iconColor = '#6b7280';
        
        if (extension === 'pdf') {
            iconClass = 'fa-file-pdf';
            iconColor = '#ef4444';
        } else if (['doc', 'docx'].includes(extension)) {
            iconClass = 'fa-file-word';
            iconColor = '#3b82f6';
        } else if (['xls', 'xlsx'].includes(extension)) {
            iconClass = 'fa-file-excel';
            iconColor = '#10b981';
        } else if (['zip', 'rar'].includes(extension)) {
            iconClass = 'fa-file-archive';
            iconColor = '#f59e0b';
        }
        
        if (isImage) {
            // Preview gambar
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#filePreview').html(`
                    <div style="display:flex;align-items:center;gap:10px;padding:10px;background:#f3f4f6;border-radius:10px;border:2px solid #e5e7eb">
                        <img src="${e.target.result}" style="width:50px;height:50px;object-fit:cover;border-radius:8px">
                        <div style="flex:1">
                            <div style="font-weight:600;font-size:13px;color:#1f2937">${fileName}</div>
                            <div style="font-size:11px;color:#6b7280">${fileSize} KB</div>
                        </div>
                        <button type="button" onclick="removeFile()" style="width:28px;height:28px;border-radius:50%;border:none;background:#ef4444;color:white;cursor:pointer;display:flex;align-items:center;justify-content:center">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `).show();
            };
            reader.readAsDataURL(file);
        } else {
            // Preview dokumen
            $('#filePreview').html(`
                <div style="display:flex;align-items:center;gap:10px;padding:10px;background:#f3f4f6;border-radius:10px;border:2px solid #e5e7eb">
                    <div style="width:50px;height:50px;border-radius:8px;background:#fff;display:flex;align-items:center;justify-content:center;font-size:24px;color:${iconColor}">
                        <i class="fas ${iconClass}"></i>
                    </div>
                    <div style="flex:1">
                        <div style="font-weight:600;font-size:13px;color:#1f2937">${fileName}</div>
                        <div style="font-size:11px;color:#6b7280">${fileSize} KB</div>
                    </div>
                    <button type="button" onclick="removeFile()" style="width:28px;height:28px;border-radius:50%;border:none;background:#ef4444;color:white;cursor:pointer;display:flex;align-items:center;justify-content:center">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `).show();
        }
    }
});

function removeFile() {
    $('#fileInput').val('');
    $('#filePreview').hide();
}

// Submit form
$('#chatForm').on('submit', function(e) {
    e.preventDefault();
    
    let formData = new FormData(this);
    let pesan = $('#pesanInput').val().trim();
    
    if (!pesan && !$('#fileInput')[0].files.length) {
        return;
    }
    
    $.ajax({
        url: '{{ route("admin.chat.store") }}',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                // Tambahkan pesan ke chat
                let message = response.data;
                let html = `
                    <div class="message-wrapper message-right">
                        <div class="message-bubble message-sent">
                            <div class="message-content">${message.pesan}</div>
                            ${message.file ? `
                                <div class="message-file">
                                    <a href="/storage/${message.file}" target="_blank">
                                        <i class="fas fa-paperclip mr-1"></i>${message.file.split('/').pop()}
                                    </a>
                                </div>
                            ` : ''}
                            <div class="message-time">
                                ${new Date().toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'})}
                                <i class="fas fa-check ml-1"></i>
                            </div>
                        </div>
                    </div>
                `;
                
                $('.empty-chat').remove();
                $('#chatMessages').append(html);
                
                // Reset form
                $('#pesanInput').val('').css('height', 'auto');
                removeFile();
                
                // Scroll to bottom
                $('#chatMessages').scrollTop($('#chatMessages')[0].scrollHeight);
            }
        },
        error: function() {
            alert('Gagal mengirim pesan');
        }
    });
});

// Auto scroll to bottom on load
$(document).ready(function() {
    $('#chatMessages').scrollTop($('#chatMessages')[0].scrollHeight);
});

// Enter to send (Shift+Enter for new line)
$('#pesanInput').on('keydown', function(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        $('#chatForm').submit();
    }
});

// Open image modal
function openImageModal(imageSrc, imageName, messageId) {
    $('#modalImage').attr('src', imageSrc);
    $('#downloadImageBtn').attr('href', `/admin/chat-file/${messageId}/download`);
    $('#imageModal').modal('show');
}

// Click image to open modal
$(document).on('click', '.chat-image', function(e) {
    e.preventDefault();
    const imageSrc = $(this).attr('src');
    const messageId = $(this).closest('[data-message-id]').data('message-id');
    if (messageId) {
        openImageModal(imageSrc, 'image', messageId);
    }
});

// Edit message
function editMessage(messageId, currentText) {
    const newText = prompt('Edit pesan:', currentText);
    
    if (newText === null || newText.trim() === '') {
        return;
    }
    
    if (newText === currentText) {
        return;
    }
    
    $.ajax({
        url: `/admin/chat/${messageId}`,
        method: 'PUT',
        data: {
            _token: '{{ csrf_token() }}',
            pesan: newText
        },
        success: function(response) {
            if (response.success) {
                // Update message content
                $(`#message-content-${messageId}`).text(newText);
                
                // Add edited badge if not exists
                const messageTime = $(`[data-message-id="${messageId}"] .message-time`);
                if (!messageTime.find('.edited-badge').length) {
                    messageTime.append('<span class="edited-badge">diedit</span>');
                }
                
                // Show success notification
                showNotification('Pesan berhasil diupdate', 'success');
            }
        },
        error: function() {
            showNotification('Gagal mengupdate pesan', 'error');
        }
    });
}

// Delete message
function deleteMessage(messageId) {
    if (!confirm('Apakah Anda yakin ingin menghapus pesan ini?')) {
        return;
    }
    
    $.ajax({
        url: `/admin/chat/${messageId}`,
        method: 'DELETE',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            if (response.success) {
                // Remove message from DOM with animation
                $(`[data-message-id="${messageId}"]`).fadeOut(300, function() {
                    $(this).remove();
                    
                    // Check if no messages left
                    if ($('#chatMessages .message-wrapper').length === 0) {
                        $('#chatMessages').html(`
                            <div class="empty-chat">
                                <i class="fas fa-comments"></i>
                                <p>Belum ada pesan. Mulai percakapan!</p>
                            </div>
                        `);
                    }
                });
                
                showNotification('Pesan berhasil dihapus', 'success');
            }
        },
        error: function() {
            showNotification('Gagal menghapus pesan', 'error');
        }
    });
}

// Show notification
function showNotification(message, type) {
    const bgColor = type === 'success' ? '#10b981' : '#ef4444';
    const notification = $(`
        <div style="position:fixed;top:20px;right:20px;background:${bgColor};color:white;padding:15px 20px;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,0.15);z-index:9999;animation:slideIn 0.3s ease-out">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} mr-2"></i>${message}
        </div>
    `);
    
    $('body').append(notification);
    
    setTimeout(() => {
        notification.fadeOut(300, function() {
            $(this).remove();
        });
    }, 3000);
}
</script>
<style>
@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}
</style>
@endpush
@endsection
