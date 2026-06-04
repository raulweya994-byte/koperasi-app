@extends('layouts.app')
@section('title', 'Dokumen Koperasi')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Dokumen Koperasi — {{ $koperasi->nama_usaha }}</h1>
        <a href="{{ route('admin.koperasi.show', $koperasi) }}" class="btn btn-secondary">← Kembali</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        {{-- Upload Dokumen --}}
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header fw-bold">Upload Dokumen Baru</div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.koperasi.uploadDokumen', $koperasi) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Jenis Dokumen <span class="text-danger">*</span></label>
                            <select name="jenis_dokumen"
                                class="form-control @error('jenis_dokumen') is-invalid @enderror" required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="ktp" @selected(old('jenis_dokumen') == 'ktp')>KTP</option>
                                <option value="kk" @selected(old('jenis_dokumen') == 'kk')>Kartu Keluarga</option>
                                <option value="foto_usaha" @selected(old('jenis_dokumen') == 'foto_usaha')>Foto Usaha</option>
                                <option value="surat_izin" @selected(old('jenis_dokumen') == 'surat_izin')>Surat Izin</option>
                                <option value="lainnya" @selected(old('jenis_dokumen') == 'lainnya')>Lainnya</option>
                            </select>
                            @error('jenis_dokumen')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">File <span class="text-danger">*</span></label>
                            <input type="file" name="file" accept=".jpg,.jpeg,.png,.pdf"
                                class="form-control @error('file') is-invalid @enderror" required>
                            <div class="form-text">Format: JPG, PNG, PDF. Maks 5MB.</div>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Upload</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Daftar Dokumen --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header fw-bold">Daftar Dokumen ({{ $koperasi->dokumen->count() }})</div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Jenis</th>
                                <th>File</th>
                                <th>Tanggal Upload</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($koperasi->dokumen as $i => $dok)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>
                                    <span class="badge bg-info">
                                        {{ ucfirst(str_replace('_', ' ', $dok->jenis_dokumen)) }}
                                    </span>
                                </td>
                                <td>
                                    @php $ext = pathinfo($dok->file_path, PATHINFO_EXTENSION); @endphp
                                    @if (in_array(strtolower($ext), ['jpg','jpeg','png']))
                                        <a href="{{ asset('storage/' . $dok->file_path) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $dok->file_path) }}"
                                                width="60" height="45" style="object-fit:cover; border-radius:4px;">
                                        </a>
                                    @else
                                        <a href="{{ asset('storage/' . $dok->file_path) }}" target="_blank"
                                            class="btn btn-sm btn-outline-secondary">
                                            📄 Lihat PDF
                                        </a>
                                    @endif
                                </td>
                                <td>{{ $dok->created_at->format('d M Y') }}</td>
                                <td>
                                    <form action="{{ route('admin.koperasi.hapusDokumen', $dok) }}" method="POST"
                                        onsubmit="return confirm('Hapus dokumen ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada dokumen.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection