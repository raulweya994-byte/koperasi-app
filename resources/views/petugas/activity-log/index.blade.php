@extends('layouts.app')
@section('title', 'Log Aktivitas')

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none;background:linear-gradient(135deg,#06b6d4,#0891b2)">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between text-white">
                        <div class="d-flex align-items-center">
                            <div style="width:70px;height:70px;background:rgba(255,255,255,0.2);border-radius:16px;display:flex;align-items:center;justify-content:center;margin-right:20px">
                                <i class="fas fa-history fa-2x"></i>
                            </div>
                            <div>
                                <h3 class="mb-1 font-weight-bold">Log Aktivitas</h3>
                                <p class="mb-0" style="opacity:0.9">Riwayat aktivitas pengguna sistem</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <form action="{{ route('petugas.activity-log.deleteAll') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus SEMUA log aktivitas? Tindakan ini tidak dapat dibatalkan!')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light mb-2" style="border-radius:8px;font-weight:600">
                                    <i class="fas fa-trash-alt mr-2"></i>Hapus Semua
                                </button>
                            </form>
                            <div>
                                <h2 class="mb-0 font-weight-bold">{{ $logs->total() }}</h2>
                                <small style="opacity:0.9">Total Log</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter & Search --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:12px;border:none">
                <div class="card-body">
                    <form method="GET" action="{{ route('petugas.activity-log.index') }}" class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label" style="font-size:13px;font-weight:600;color:#374151">Tanggal Mulai</label>
                            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" style="border-radius:8px">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label" style="font-size:13px;font-weight:600;color:#374151">Tanggal Akhir</label>
                            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" style="border-radius:8px">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" style="font-size:13px;font-weight:600;color:#374151">Pengguna</label>
                            <select name="user_id" class="form-control" style="border-radius:8px">
                                <option value="">Semua</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" style="font-size:13px;font-weight:600;color:#374151">Aksi</label>
                            <select name="action" class="form-control" style="border-radius:8px">
                                <option value="">Semua</option>
                                @foreach($actions as $action)
                                <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                                    {{ ucfirst($action) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" style="font-size:13px;font-weight:600;color:#374151">&nbsp;</label>
                            <button type="submit" class="btn btn-primary btn-block" style="border-radius:8px">
                                <i class="fas fa-filter mr-1"></i>Filter
                            </button>
                        </div>
                    </form>
                    <div class="row mt-3">
                        <div class="col-md-10">
                            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan deskripsi, IP, atau user agent..." value="{{ request('search') }}" style="border-radius:8px" form="filterForm">
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('petugas.activity-log.index') }}" class="btn btn-secondary btn-block" style="border-radius:8px">
                                <i class="fas fa-redo mr-1"></i>Reset
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="border-radius:16px;overflow:hidden">
                            <thead style="background:linear-gradient(135deg,#34495e,#2c3e50)">
                                <tr>
                                    <th style="padding:20px;border:none;width:50px;text-align:center;color:#ffffff !important;font-weight:700">
                                        <i class="fas fa-hashtag"></i>
                                    </th>
                                    <th style="padding:20px;border:none;font-weight:700;color:#ffffff !important">
                                        <i class="fas fa-user mr-2"></i>Pengguna
                                    </th>
                                    <th style="padding:20px;border:none;font-weight:700;color:#ffffff !important">
                                        <i class="fas fa-bolt mr-2"></i>Aksi
                                    </th>
                                    <th style="padding:20px;border:none;font-weight:700;color:#ffffff !important">
                                        <i class="fas fa-info-circle mr-2"></i>Deskripsi
                                    </th>
                                    <th style="padding:20px;border:none;font-weight:700;color:#ffffff !important">
                                        <i class="fas fa-network-wired mr-2"></i>IP Address
                                    </th>
                                    <th style="padding:20px;border:none;font-weight:700;color:#ffffff !important">
                                        <i class="fas fa-clock mr-2"></i>Waktu
                                    </th>
                                    <th style="padding:20px;border:none;font-weight:700;color:#ffffff !important;text-align:center">
                                        <i class="fas fa-cog mr-2"></i>Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logs as $index => $log)
                                <tr style="border-bottom:1px solid #f3f4f6">
                                    <td style="padding:20px;text-align:center;color:#6b7280;font-weight:600">
                                        {{ $logs->firstItem() + $index }}
                                    </td>
                                    <td style="padding:20px">
                                        <div style="font-size:14px">
                                            <div class="font-weight-bold" style="color:#1f2937">
                                                {{ $log->user->name ?? 'System' }}
                                            </div>
                                            <div class="text-muted" style="font-size:12px">
                                                <i class="fas fa-user-tag mr-1"></i>{{ ucfirst($log->user->role ?? 'system') }}
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding:20px">
                                        <span class="badge badge-{{ $log->action == 'create' ? 'success' : ($log->action == 'update' ? 'warning' : ($log->action == 'delete' ? 'danger' : 'info')) }}" 
                                              style="padding:8px 16px;border-radius:20px;font-size:12px;font-weight:600">
                                            <i class="fas {{ $log->action == 'create' ? 'fa-plus' : ($log->action == 'update' ? 'fa-edit' : ($log->action == 'delete' ? 'fa-trash' : 'fa-eye')) }} mr-1"></i>
                                            {{ strtoupper($log->action) }}
                                        </span>
                                    </td>
                                    <td style="padding:20px">
                                        <div style="max-width:400px">
                                            <p class="mb-0" style="font-size:14px;color:#374151">
                                                {{ Str::limit($log->description, 80) }}
                                            </p>
                                        </div>
                                    </td>
                                    <td style="padding:20px">
                                        <span class="badge badge-light" style="padding:6px 12px;border-radius:8px;font-size:11px;font-weight:600;color:#6b7280">
                                            <i class="fas fa-map-marker-alt mr-1"></i>{{ $log->ip_address }}
                                        </span>
                                    </td>
                                    <td style="padding:20px">
                                        <div style="font-size:13px">
                                            <div class="font-weight-bold" style="color:#1f2937">
                                                {{ $log->created_at->format('d M Y') }}
                                            </div>
                                            <div class="text-muted" style="font-size:12px">
                                                <i class="far fa-clock mr-1"></i>{{ $log->created_at->format('H:i') }} WIT
                                            </div>
                                        </div>
                                    </td>
                                    <td style="padding:20px;text-align:center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('petugas.activity-log.show', $log->id) }}" 
                                               class="btn btn-sm btn-outline-info" 
                                               style="border-radius:6px 0 0 6px;padding:8px 12px"
                                               title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="{{ route('petugas.activity-log.destroy', $log->id) }}" 
                                                  method="POST" 
                                                  style="display:inline" 
                                                  onsubmit="return confirm('Yakin ingin menghapus log ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-outline-danger" 
                                                        style="border-radius:0 6px 6px 0;padding:8px 12px"
                                                        title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" style="padding:60px;text-align:center">
                                        <i class="fas fa-inbox fa-4x text-muted mb-3" style="display:block"></i>
                                        <h5 class="text-muted">Tidak ada log aktivitas</h5>
                                        <p class="text-muted mb-0">Belum ada aktivitas yang tercatat</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                {{-- Pagination --}}
                @if($logs->hasPages())
                <div class="card-footer" style="background:#f8f9fa;border:none;padding:20px">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted" style="font-size:14px">
                            Menampilkan {{ $logs->firstItem() }} - {{ $logs->lastItem() }} dari {{ $logs->total() }} log
                        </div>
                        <div>
                            {{ $logs->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.table-hover tbody tr:hover {
    background: linear-gradient(135deg, #e0f2fe, #bae6fd);
    transform: scale(1.01);
    transition: all 0.2s;
}

.btn-group .btn {
    transition: all 0.2s;
}

.btn-group .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.badge {
    transition: all 0.2s;
}

tr:hover .badge {
    transform: scale(1.05);
}
</style>
@endsection
