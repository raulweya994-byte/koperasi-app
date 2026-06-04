@extends('layouts.anggota')
@section('title', 'Chat dengan Admin')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('anggota.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('anggota.chat.index') }}">Chat</a></li>
<li class="breadcrumb-item active">{{ $admin->name }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="chat-container">
                {{-- Chat Header --}}
                <div class="chat-header-box">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('anggota.chat.index') }}" class="btn-back">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>

                {{-- Chat Messages --}}
                <div class="chat-messages" id="chatMessages">
                    @forelse($messages as $message)
                        @if($message->pengirim_id == auth()->id())
                            {{-- Pesan dari anggota (kanan) --}}
                            <div class="message-wrapper message-right" data-message-id="{{ $message->id }}">
                                <div class="message-bubble message-sent">
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
                                            <div class="file-document-card">
                                                <div class="file-document-header">
                                                    <div class="file-icon-large">
                                                        @if(in_array($extension, ['pdf']))
                                                            <i class="fas fa-file-pdf"></i>
                                                        @elseif(in_array($extension, ['doc', 'docx']))
                                                            <i class="fas fa-file-word"></i>
                                                        @elseif(in_array($extension, ['xls', 'xlsx', 'csv']))
                                                            <i class="fas fa-file-excel"></i>
                                                        @elseif(in_array($extension, ['ppt', 'pptx']))
                                                            <i class="fas fa-file-powerpoint"></i>
                                                        @elseif(in_array($extension, ['zip', 'rar', '7z', 'tar', 'gz']))
                                                            <i class="fas fa-file-archive"></i>
                                                        @elseif(in_array($extension, ['txt', 'log']))
                                                            <i class="fas fa-file-alt"></i>
                                                        @elseif(in_array($extension, ['mp4', 'avi', 'mkv', 'mov', 'wmv']))
                                                            <i class="fas fa-file-video"></i>
                                                        @elseif(in_array($extension, ['mp3', 'wav', 'ogg', 'flac']))
                                                            <i class="fas fa-file-audio"></i>
                                                        @elseif(in_array($extension, ['html', 'css', 'js', 'php', 'py', 'java', 'cpp', 'c']))
                                                            <i class="fas fa-file-code"></i>
                                                        @else
                                                            <i class="fas fa-file"></i>
                                                        @endif
                                                    </div>
                                                    <div class="file-document-info">
                                                        <div class="file-document-name">{{ $message->original_filename ?? basename($message->file) }}</div>
                                                        @if(Storage::disk('public')->exists($message->file))
                                                            <div class="file-document-size">{{ number_format(Storage::disk('public')->size($message->file) / 1024, 2) }} KB</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="file-document-actions">
                                                    <a href="{{ asset('storage/'.$message->file) }}" target="_blank" class="btn-file-action btn-view">
                                                        <i class="fas fa-eye"></i>
                                                        <span>Lihat</span>
                                                    </a>
                                                    <a href="{{ asset('storage/'.$message->file) }}" download class="btn-file-action btn-download">
                                                        <i class="fas fa-download"></i>
                                                        <span>Download</span>
                                                    </a>
                                                </div>
                                            </div>
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
                                    <div class="message-actions-bottom">
                                        <button class="btn-message-action-bottom btn-edit" onclick="editMessage({{ $message->id }}, '{{ addslashes($message->pesan) }}')" title="Edit Pesan">
                                            <i class="fas fa-edit"></i>
                                            <span>Edit</span>
                                        </button>
                                        <button class="btn-message-action-bottom btn-delete" onclick="deleteMessage({{ $message->id }})" title="Hapus Pesan">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>Hapus</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- Pesan dari admin (kiri) --}}
                            <div class="message-wrapper message-left">
                                <div class="message-bubble message-received">
                                    <div class="message-content">
                                        {{ $message->pesan }}
                                    </div>
                                    @if($message->file)
                                    <div class="message-file">
                                        @php
                                            $extension = pathinfo($message->file, PATHINFO_EXTENSION);
                                            $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg']);
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
                                            <div class="file-document-card">
                                                <div class="file-document-header">
                                                    <div class="file-icon-large">
                                                        @if(in_array($extension, ['pdf']))
                                                            <i class="fas fa-file-pdf"></i>
                                                        @elseif(in_array($extension, ['doc', 'docx']))
                                                            <i class="fas fa-file-word"></i>
                                                        @elseif(in_array($extension, ['xls', 'xlsx', 'csv']))
                                                            <i class="fas fa-file-excel"></i>
                                                        @elseif(in_array($extension, ['ppt', 'pptx']))
                                                            <i class="fas fa-file-powerpoint"></i>
                                                        @elseif(in_array($extension, ['zip', 'rar', '7z', 'tar', 'gz']))
                                                            <i class="fas fa-file-archive"></i>
                                                        @elseif(in_array($extension, ['txt', 'log']))
                                                            <i class="fas fa-file-alt"></i>
                                                        @elseif(in_array($extension, ['mp4', 'avi', 'mkv', 'mov', 'wmv']))
                                                            <i class="fas fa-file-video"></i>
                                                        @elseif(in_array($extension, ['mp3', 'wav', 'ogg', 'flac']))
                                                            <i class="fas fa-file-audio"></i>
                                                        @elseif(in_array($extension, ['html', 'css', 'js', 'php', 'py', 'java', 'cpp', 'c']))
                                                            <i class="fas fa-file-code"></i>
                                                        @else
                                                            <i class="fas fa-file"></i>
                                                        @endif
                                                    </div>
                                                    <div class="file-document-info">
                                                        <div class="file-document-name">{{ $message->original_filename ?? basename($message->file) }}</div>
                                                        @if(Storage::disk('public')->exists($message->file))
                                                            <div class="file-document-size">{{ number_format(Storage::disk('public')->size($message->file) / 1024, 2) }} KB</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="file-document-actions">
                                                    <a href="{{ asset('storage/'.$message->file) }}" target="_blank" class="btn-file-action btn-view">
                                                        <i class="fas fa-eye"></i>
                                                        <span>Lihat</span>
                                                    </a>
                                                    <a href="{{ asset('storage/'.$message->file) }}" download class="btn-file-action btn-download">
                                                        <i class="fas fa-download"></i>
                                                        <span>Download</span>
                                                    </a>
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
                            <p>Belum ada pesan. Mulai percakapan dengan admin!</p>
                        </div>
                    @endforelse
                </div>

                {{-- Chat Input --}}
                <div class="chat-input-box">
                    <form id="chatForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="penerima_id" value="{{ $admin->id }}">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <label for="fileInput" class="btn-attach" title="Lampirkan File">
                                    <i class="fas fa-paperclip"></i>
                                    <input type="file" id="fileInput" name="file" style="display:none">
                                </label>
                            </div>
                            <textarea class="form-control chat-input" name="pesan" id="pesanInput" placeholder="Ketik pesan..." rows="1"></textarea>
                            <div class="input-group-append">
                                <button type="submit" class="btn-send" title="Kirim Pesan">
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

.message-actions-bottom {
    display: flex;
    gap: 8px;
    margin-top: 8px;
    padding-top: 8px;
    border-top: 1px solid rgba(255,255,255,0.2);
}

.btn-message-action-bottom {
    flex: 1;
    padding: 6px 12px;
    border: none;
    border-radius: 8px;
    background: rgba(255,255,255,0.15);
    color: white;
    font-size: 12px;
    font-weight: 500;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    cursor: pointer;
    transition: all 0.3s;
    backdrop-filter: blur(10px);
}

.btn-message-action-bottom:hover {
    background: rgba(255,255,255,0.25);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.btn-message-action-bottom i {
    font-size: 11px;
}

.btn-edit:hover {
    background: rgba(59,130,246,0.3);
}

.btn-delete:hover {
    background: rgba(239,68,68,0.3);
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
    background: rgba(0,0,0,0.5);
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

/* New File Document Card Styles */
.file-document-card {
    background: rgba(255,255,255,0.1);
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.2);
    transition: all 0.3s;
}

.message-received .file-document-card {
    background: #f9fafb;
    border: 1px solid #e5e7eb;
}

.file-document-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
}

.file-icon-large {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    flex-shrink: 0;
    background: rgba(255,255,255,0.15);
}

.message-received .file-icon-large {
    background: white;
}

.file-icon-large .fa-file-pdf {
    color: #ef4444;
}

.file-icon-large .fa-file-word {
    color: #3b82f6;
}

.file-icon-large .fa-file-excel {
    color: #10b981;
}

.file-icon-large .fa-file-powerpoint {
    color: #f59e0b;
}

.file-icon-large .fa-file-archive {
    color: #8b5cf6;
}

.file-icon-large .fa-file-alt {
    color: #6b7280;
}

.file-icon-large .fa-file-video {
    color: #ec4899;
}

.file-icon-large .fa-file-audio {
    color: #14b8a6;
}

.file-icon-large .fa-file-code {
    color: #f59e0b;
}

.file-icon-large .fa-file {
    color: #9ca3af;
}

.file-document-info {
    flex: 1;
    min-width: 0;
}

.file-document-name {
    font-weight: 600;
    font-size: 13px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 4px;
    color: white;
}

.message-received .file-document-name {
    color: #1f2937;
}

.file-document-size {
    font-size: 11px;
    opacity: 0.7;
}

.file-document-actions {
    display: flex;
    gap: 8px;
    padding: 0 12px 12px 12px;
}

.btn-file-action {
    flex: 1;
    padding: 8px 12px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 12px;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: all 0.3s;
    border: none;
}

.btn-view {
    background: rgba(59,130,246,0.2);
    color: white;
}

.message-received .btn-view {
    background: #dbeafe;
    color: #3b82f6;
}

.btn-view:hover {
    background: rgba(59,130,246,0.3);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(59,130,246,0.3);
    color: white;
}

.message-received .btn-view:hover {
    background: #bfdbfe;
    color: #2563eb;
}

.btn-download {
    background: rgba(16,185,129,0.2);
    color: white;
}

.message-received .btn-download {
    background: #d1fae5;
    color: #10b981;
}

.btn-download:hover {
    background: rgba(16,185,129,0.3);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(16,185,129,0.3);
    color: white;
}

.message-received .btn-download:hover {
    background: #a7f3d0;
    color: #059669;
}

.btn-file-action i {
    font-size: 11px;
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

/* Edit/Delete Modal */
.edit-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    backdrop-filter: blur(4px);
    animation: fadeIn 0.2s ease;
}

.edit-modal {
    background: white;
    border-radius: 16px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
    max-width: 500px;
    width: 90%;
    animation: slideUp 0.3s ease;
}

.edit-modal-header {
    padding: 20px 25px;
    border-bottom: 2px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    border-radius: 16px 16px 0 0;
}

.edit-modal-header h5 {
    margin: 0;
    font-weight: 600;
    font-size: 16px;
}

.btn-close-modal {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    border: none;
    background: rgba(255,255,255,0.2);
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
}

.btn-close-modal:hover {
    background: rgba(255,255,255,0.3);
    transform: rotate(90deg);
}

.edit-modal-body {
    padding: 25px;
}

.edit-modal-footer {
    padding: 20px 25px;
    border-top: 2px solid #e5e7eb;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes slideUp {
    from {
        transform: translateY(30px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
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
        const isImage = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg'].includes(extension);
        
        // Validasi ukuran file (max 10MB)
        if (file.size > 10 * 1024 * 1024) {
            showNotification('Ukuran file maksimal 10MB', 'error');
            $(this).val('');
            return;
        }
        
        let iconClass = 'fa-file';
        let iconColor = '#6b7280';
        
        // Icon berdasarkan tipe file
        if (extension === 'pdf') {
            iconClass = 'fa-file-pdf';
            iconColor = '#ef4444';
        } else if (['doc', 'docx'].includes(extension)) {
            iconClass = 'fa-file-word';
            iconColor = '#3b82f6';
        } else if (['xls', 'xlsx', 'csv'].includes(extension)) {
            iconClass = 'fa-file-excel';
            iconColor = '#10b981';
        } else if (['ppt', 'pptx'].includes(extension)) {
            iconClass = 'fa-file-powerpoint';
            iconColor = '#f59e0b';
        } else if (['zip', 'rar', '7z', 'tar', 'gz'].includes(extension)) {
            iconClass = 'fa-file-archive';
            iconColor = '#8b5cf6';
        } else if (['txt', 'log'].includes(extension)) {
            iconClass = 'fa-file-alt';
            iconColor = '#6b7280';
        } else if (['mp4', 'avi', 'mkv', 'mov', 'wmv'].includes(extension)) {
            iconClass = 'fa-file-video';
            iconColor = '#ec4899';
        } else if (['mp3', 'wav', 'ogg', 'flac'].includes(extension)) {
            iconClass = 'fa-file-audio';
            iconColor = '#14b8a6';
        } else if (['html', 'css', 'js', 'php', 'py', 'java', 'cpp', 'c'].includes(extension)) {
            iconClass = 'fa-file-code';
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
    let hasFile = $('#fileInput')[0].files.length > 0;
    
    // Validasi: minimal ada pesan atau file
    if (!pesan && !hasFile) {
        showNotification('Ketik pesan atau lampirkan file', 'error');
        return;
    }
    
    // Jika tidak ada pesan tapi ada file, set pesan default
    if (!pesan && hasFile) {
        formData.set('pesan', '📎 File terlampir');
    }
    
    // Disable button saat mengirim
    const $btnSend = $('.btn-send');
    $btnSend.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
    
    $.ajax({
        url: '{{ route("anggota.chat.store") }}',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                let message = response.data;
                let html = `
                    <div class="message-wrapper message-right" data-message-id="${message.id}">
                        <div class="message-bubble message-sent">
                            <div class="message-content" id="message-content-${message.id}">${message.pesan}</div>
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
                            <div class="message-actions-bottom">
                                <button class="btn-message-action-bottom btn-edit" onclick="editMessage(${message.id}, '${message.pesan.replace(/'/g, "\\'")}')" title="Edit Pesan">
                                    <i class="fas fa-edit"></i>
                                    <span>Edit</span>
                                </button>
                                <button class="btn-message-action-bottom btn-delete" onclick="deleteMessage(${message.id})" title="Hapus Pesan">
                                    <i class="fas fa-trash-alt"></i>
                                    <span>Hapus</span>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                
                $('.empty-chat').remove();
                $('#chatMessages').append(html);
                
                $('#pesanInput').val('').css('height', 'auto');
                removeFile();
                
                $('#chatMessages').scrollTop($('#chatMessages')[0].scrollHeight);
                
                showNotification('Pesan berhasil dikirim', 'success');
            }
        },
        error: function(xhr) {
            let errorMsg = 'Gagal mengirim pesan';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMsg = xhr.responseJSON.message;
            } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                errorMsg = Object.values(xhr.responseJSON.errors)[0][0];
            }
            showNotification(errorMsg, 'error');
        },
        complete: function() {
            // Enable button kembali
            $btnSend.prop('disabled', false).html('<i class="fas fa-paper-plane"></i>');
        }
    });
});

// Auto scroll to bottom
$(document).ready(function() {
    $('#chatMessages').scrollTop($('#chatMessages')[0].scrollHeight);
});

// Enter to send
$('#pesanInput').on('keydown', function(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        $('#chatForm').submit();
    }
});

// Edit message
function editMessage(messageId, currentText) {
    // Create modal for editing
    const modal = $(`
        <div class="edit-modal-overlay" id="editModal">
            <div class="edit-modal">
                <div class="edit-modal-header">
                    <h5><i class="fas fa-edit mr-2"></i>Edit Pesan</h5>
                    <button onclick="closeEditModal()" class="btn-close-modal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="edit-modal-body">
                    <textarea id="editTextarea" class="form-control" rows="4" style="border:2px solid #e5e7eb;border-radius:10px;padding:12px;font-size:14px">${currentText}</textarea>
                </div>
                <div class="edit-modal-footer">
                    <button onclick="closeEditModal()" class="btn btn-secondary" style="border-radius:8px;padding:8px 20px">
                        <i class="fas fa-times mr-1"></i>Batal
                    </button>
                    <button onclick="saveEditMessage(${messageId})" class="btn btn-primary" style="border-radius:8px;padding:8px 20px;background:linear-gradient(135deg,#3b82f6,#2563eb);border:none">
                        <i class="fas fa-save mr-1"></i>Simpan
                    </button>
                </div>
            </div>
        </div>
    `);
    
    $('body').append(modal);
    $('#editTextarea').focus();
}

function closeEditModal() {
    $('#editModal').fadeOut(200, function() {
        $(this).remove();
    });
}

function saveEditMessage(messageId) {
    const newText = $('#editTextarea').val().trim();
    
    if (newText === '') {
        showNotification('Pesan tidak boleh kosong', 'error');
        return;
    }
    
    $.ajax({
        url: `/anggota-portal/chat/${messageId}`,
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
                
                closeEditModal();
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
    // Create confirmation modal
    const modal = $(`
        <div class="edit-modal-overlay" id="deleteModal">
            <div class="edit-modal" style="max-width:400px">
                <div class="edit-modal-header" style="background:linear-gradient(135deg,#ef4444,#dc2626);color:white">
                    <h5><i class="fas fa-exclamation-triangle mr-2"></i>Konfirmasi Hapus</h5>
                    <button onclick="closeDeleteModal()" class="btn-close-modal" style="color:white">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="edit-modal-body" style="text-align:center;padding:30px 20px">
                    <i class="fas fa-trash-alt" style="font-size:48px;color:#ef4444;margin-bottom:15px"></i>
                    <p style="font-size:15px;color:#4b5563;margin:0">Apakah Anda yakin ingin menghapus pesan ini?</p>
                    <p style="font-size:13px;color:#9ca3af;margin-top:8px">Pesan yang dihapus tidak dapat dikembalikan</p>
                </div>
                <div class="edit-modal-footer">
                    <button onclick="closeDeleteModal()" class="btn btn-secondary" style="border-radius:8px;padding:8px 20px">
                        <i class="fas fa-times mr-1"></i>Batal
                    </button>
                    <button onclick="confirmDeleteMessage(${messageId})" class="btn btn-danger" style="border-radius:8px;padding:8px 20px;background:linear-gradient(135deg,#ef4444,#dc2626);border:none">
                        <i class="fas fa-trash-alt mr-1"></i>Hapus
                    </button>
                </div>
            </div>
        </div>
    `);
    
    $('body').append(modal);
}

function closeDeleteModal() {
    $('#deleteModal').fadeOut(200, function() {
        $(this).remove();
    });
}

function confirmDeleteMessage(messageId) {
    $.ajax({
        url: `/anggota-portal/chat/${messageId}`,
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
                                <p>Belum ada pesan. Mulai percakapan dengan admin!</p>
                            </div>
                        `);
                    }
                });
                
                closeDeleteModal();
                showNotification('Pesan berhasil dihapus', 'success');
            }
        },
        error: function() {
            closeDeleteModal();
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
