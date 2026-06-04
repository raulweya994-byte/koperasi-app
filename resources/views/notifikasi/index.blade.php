@extends("layouts.app")
@section("title","Notifikasi")
@section("page-title","Notifikasi")

@push('styles')
<style>
    .notif-card {
        border-radius: 12px;
        border: none;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    
    .notif-item {
        padding: 20px;
        border-bottom: 1px solid #f0f0f0;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .notif-item:hover {
        background: #f8f9fa;
        transform: translateX(5px);
    }
    
    .notif-item.unread {
        background: linear-gradient(90deg, #e0e7ff 0%, #f3f4f6 100%);
        border-left: 4px solid #667eea;
    }
    
    .notif-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .notif-icon.info {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
    }
    
    .notif-icon.success {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }
    
    .notif-icon.warning {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }
    
    .notif-icon.danger {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
    }
    
    .notif-title {
        font-weight: 700;
        color: #1f2937;
        font-size: 15px;
        margin-bottom: 8px;
    }
    
    .notif-message {
        color: #6b7280;
        font-size: 13px;
        line-height: 1.6;
        white-space: pre-line;
    }
    
    .notif-time {
        color: #9ca3af;
        font-size: 12px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .badge-unread {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }
    
    .btn-delete {
        width: 35px;
        height: 35px;
        border-radius: 8px;
        border: 1.5px solid #fee2e2;
        background: white;
        color: #ef4444;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .btn-delete:hover {
        background: #ef4444;
        color: white;
        border-color: #ef4444;
    }
    
    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }
    
    .empty-state i {
        font-size: 80px;
        color: #e5e7eb;
        margin-bottom: 20px;
    }
</style>
@endpush

@section("breadcrumb")
<li class="breadcrumb-item active">Notifikasi</li>
@endsection

@section("content")
<div class="card notif-card">
    <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px;">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-1" style="font-weight: 700;">
                    <i class="fas fa-bell mr-2"></i>Notifikasi
                </h3>
                <p class="mb-0" style="opacity: 0.9; font-size: 13px;">
                    Semua pemberitahuan dan update untuk Anda
                </p>
            </div>
            @if($notifikasi->where('is_read', false)->count() > 0)
            <div>
                <span class="badge-unread">
                    {{ $notifikasi->where('is_read', false)->count() }} Belum Dibaca
                </span>
            </div>
            @endif
        </div>
    </div>
    
    <div class="card-body p-0">
    @forelse($notifikasi as $n)
        <div class="notif-item {{ $n->is_read ? '' : 'unread' }}">
            <div class="d-flex align-items-start">
                <!-- Icon -->
                <div class="mr-3">
                    <div class="notif-icon {{ $n->tipe }}">
                        <i class="fas {{ $n->icon ?? 'fa-bell' }}"></i>
                    </div>
                </div>
                
                <!-- Content -->
                <div class="flex-grow-1">
                    <div class="notif-title">
                        {{ $n->judul }}
                        @if(!$n->is_read)
                        <span class="badge badge-primary badge-sm ml-2" style="font-size: 10px; padding: 3px 8px;">Baru</span>
                        @endif
                    </div>
                    <div class="notif-message">
                        {{ $n->pesan }}
                    </div>
                    <div class="notif-time mt-2">
                        <i class="fas fa-clock"></i>
                        <span>{{ $n->created_at->diffForHumans() }}</span>
                        @if($n->is_read && $n->read_at)
                        <span class="mx-1">•</span>
                        <i class="fas fa-check-double"></i>
                        <span>Dibaca {{ $n->read_at->diffForHumans() }}</span>
                        @endif
                    </div>
                    
                    <!-- Link jika ada -->
                    @if($n->link ?? $n->url)
                    <div class="mt-2">
                        <a href="{{ $n->link ?? $n->url }}" class="btn btn-sm btn-outline-primary" style="border-radius: 8px; font-size: 12px;">
                            <i class="fas fa-external-link-alt mr-1"></i>Lihat Detail
                        </a>
                    </div>
                    @endif
                </div>
                
                <!-- Delete Button -->
                <div class="ml-3">
                    <form action="{{ route('notifikasi.destroy', $n) }}" method="POST"
                          onsubmit="return confirm('Hapus notifikasi ini?')">
                        @csrf @method("DELETE")
                        <button type="submit" class="btn-delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <i class="fas fa-bell-slash"></i>
            <h5 class="text-muted mb-2">Tidak Ada Notifikasi</h5>
            <p class="text-muted mb-0" style="font-size: 14px;">
                Anda akan menerima notifikasi di sini ketika ada update atau informasi penting
            </p>
        </div>
    @endforelse
    </div>
    
    @if($notifikasi->count())
    <div class="card-footer" style="background: #f9fafb; padding: 15px 20px;">
        {{ $notifikasi->links("pagination::bootstrap-4") }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
// Auto mark as read when clicked
document.querySelectorAll('.notif-item.unread').forEach(item => {
    item.addEventListener('click', function(e) {
        // Jangan mark as read jika klik tombol delete
        if (e.target.closest('form')) return;
        
        // Hilangkan highlight unread
        this.classList.remove('unread');
        this.style.background = '#f8f9fa';
        
        // Hapus badge "Baru"
        const badge = this.querySelector('.badge-primary');
        if (badge) badge.remove();
    });
});
</script>
@endpush