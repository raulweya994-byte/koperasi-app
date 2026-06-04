{{-- Detail Program Bantuan --}}
<div class="p-4">
    {{-- Info Program --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm" style="border-radius:12px;border:none;background:linear-gradient(135deg,#667eea,#764ba2)">
                <div class="card-body p-4">
                    <h6 class="text-white mb-3 font-weight-bold">
                        <i class="fas fa-info-circle mr-2"></i>Informasi Program
                    </h6>
                    <div class="detail-item">
                        <div class="detail-label">Kode Bantuan</div>
                        <div class="detail-value">
                            <code style="background:rgba(255,255,255,0.2);color:#fff;padding:6px 12px;border-radius:8px;font-size:13px;font-weight:600">
                                {{ $bantuan->kode_bantuan }}
                            </code>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Nama Program</div>
                        <div class="detail-value">{{ $bantuan->nama_bantuan }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Jenis Bantuan</div>
                        <div class="detail-value">
                            <span class="badge badge-light" style="font-size:12px;padding:6px 12px">
                                {{ ucfirst($bantuan->jenis_bantuan) }}
                            </span>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Tahun & Periode</div>
                        <div class="detail-value">{{ $bantuan->tahun }} - {{ $bantuan->periode }}</div>
                    </div>
                    <div class="detail-item mb-0">
                        <div class="detail-label">Status</div>
                        <div class="detail-value">
                            @if($bantuan->status === 'aktif')
                                <span class="badge badge-success" style="font-size:12px;padding:6px 12px">
                                    <i class="fas fa-check-circle mr-1"></i>Aktif
                                </span>
                            @elseif($bantuan->status === 'selesai')
                                <span class="badge badge-secondary" style="font-size:12px;padding:6px 12px">
                                    <i class="fas fa-flag-checkered mr-1"></i>Selesai
                                </span>
                            @else
                                <span class="badge badge-danger" style="font-size:12px;padding:6px 12px">
                                    <i class="fas fa-times-circle mr-1"></i>Dibatalkan
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow-sm" style="border-radius:12px;border:none;background:linear-gradient(135deg,#f093fb,#f5576c)">
                <div class="card-body p-4">
                    <h6 class="text-white mb-3 font-weight-bold">
                        <i class="fas fa-chart-pie mr-2"></i>Statistik Penerima
                    </h6>
                    <div class="detail-item">
                        <div class="detail-label">Anggaran Program</div>
                        <div class="detail-value" style="font-size:18px;font-weight:700">
                            Rp {{ number_format($bantuan->anggaran, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Kuota Penerima</div>
                        <div class="detail-value">
                            <span class="badge badge-light" style="font-size:14px;padding:6px 12px">
                                {{ $bantuan->kuota }} Koperasi
                            </span>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Total Penerima</div>
                        <div class="detail-value">
                            <span class="badge badge-{{ $bantuan->penerima->count() >= $bantuan->kuota ? 'danger' : 'success' }}" 
                                  style="font-size:14px;padding:6px 12px">
                                {{ $bantuan->penerima->count() }} / {{ $bantuan->kuota }}
                            </span>
                        </div>
                    </div>
                    <div class="detail-item mb-0">
                        <div class="detail-label">Progress</div>
                        <div class="detail-value">
                            <div class="progress" style="height:24px;border-radius:12px;background:rgba(255,255,255,0.3)">
                                @php
                                    $progress = $bantuan->kuota > 0 ? ($bantuan->penerima->count() / $bantuan->kuota * 100) : 0;
                                @endphp
                                <div class="progress-bar bg-light" 
                                     style="width:{{ $progress }}%;border-radius:12px;font-weight:600;color:#333">
                                    {{ number_format($progress, 1) }}%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Deskripsi --}}
    @if($bantuan->deskripsi)
    <div class="card shadow-sm mb-4" style="border-radius:12px;border:none">
        <div class="card-body p-4">
            <h6 class="font-weight-bold mb-3" style="color:#1a3a6e">
                <i class="fas fa-align-left mr-2"></i>Deskripsi Program
            </h6>
            <p class="mb-0" style="color:#4b5563;line-height:1.8">{{ $bantuan->deskripsi }}</p>
        </div>
    </div>
    @endif

    {{-- Daftar Penerima --}}
    <div class="card shadow-sm" style="border-radius:12px;border:none">
        <div class="card-header" style="background:linear-gradient(135deg,#f8f9fa,#e9ecef);border-radius:12px 12px 0 0;border:none;padding:20px">
            <h6 class="mb-0 font-weight-bold" style="color:#1a3a6e">
                <i class="fas fa-users mr-2"></i>Daftar Penerima Bantuan
                <span class="badge badge-primary ml-2" style="font-size:12px">
                    {{ $bantuan->penerima->count() }} Koperasi
                </span>
            </h6>
        </div>
        <div class="card-body p-0">
            @if($bantuan->penerima->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background:#f8f9fa">
                        <tr>
                            <th style="padding:15px;border:none">No</th>
                            <th style="border:none">Nama Koperasi</th>
                            <th style="border:none">Pemilik</th>
                            <th style="border:none">Distrik</th>
                            <th style="border:none">Jumlah Bantuan</th>
                            <th style="border:none">Status</th>
                            <th style="border:none">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bantuan->penerima as $index => $penerima)
                        <tr style="border-bottom:1px solid #e5e7eb">
                            <td style="padding:15px">{{ $index + 1 }}</td>
                            <td>
                                <div class="font-weight-600" style="color:#1f2937">
                                    {{ $penerima->koperasi->nama_usaha ?? '-' }}
                                </div>
                                <small class="text-muted">
                                    {{ $penerima->koperasi->no_registrasi ?? '-' }}
                                </small>
                            </td>
                            <td>{{ $penerima->koperasi->nama_pemilik ?? '-' }}</td>
                            <td>
                                <span class="badge badge-info" style="font-size:11px;padding:5px 10px">
                                    <i class="fas fa-map-marker-alt mr-1"></i>{{ $penerima->koperasi->distrik ?? '-' }}
                                </span>
                            </td>
                            <td>
                                <strong style="color:#059669">
                                    Rp {{ number_format($penerima->jumlah_bantuan, 0, ',', '.') }}
                                </strong>
                            </td>
                            <td>
                                @if($penerima->status === 'diterima')
                                    <span class="badge badge-success" style="font-size:11px;padding:5px 10px">
                                        <i class="fas fa-check-circle mr-1"></i>Diterima
                                    </span>
                                @elseif($penerima->status === 'pending')
                                    <span class="badge badge-warning" style="font-size:11px;padding:5px 10px">
                                        <i class="fas fa-clock mr-1"></i>Pending
                                    </span>
                                @else
                                    <span class="badge badge-danger" style="font-size:11px;padding:5px 10px">
                                        <i class="fas fa-times-circle mr-1"></i>Ditolak
                                    </span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $penerima->created_at ? $penerima->created_at->format('d/m/Y') : '-' }}
                                </small>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot style="background:#f8f9fa">
                        <tr>
                            <td colspan="4" style="padding:15px;border:none">
                                <strong style="color:#1a3a6e">Total Bantuan Disalurkan</strong>
                            </td>
                            <td colspan="3" style="border:none">
                                <strong style="color:#059669;font-size:16px">
                                    Rp {{ number_format($bantuan->penerima->sum('jumlah_bantuan'), 0, ',', '.') }}
                                </strong>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3" style="opacity:0.3"></i>
                <h6 class="text-muted">Belum Ada Penerima</h6>
                <p class="text-muted mb-0">Program ini belum memiliki penerima bantuan</p>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.detail-item {
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid rgba(255,255,255,0.2);
}
.detail-label {
    color: rgba(255,255,255,0.8);
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
    font-weight: 600;
}
.detail-value {
    color: #fff;
    font-size: 15px;
    font-weight: 600;
}
</style>
