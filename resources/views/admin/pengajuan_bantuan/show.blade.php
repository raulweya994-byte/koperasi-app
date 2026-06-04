@extends('layouts.app')
@section('title','Detail Pengajuan')
@section('page-title','Detail Pengajuan Bantuan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.pengajuan-bantuan.index') }}">Pengajuan Bantuan</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection
@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>{{ session('success') }}</div>@endif
<div class="row">
    <div class="col-md-7">
        <div class="card card-primary card-outline">
            <div class="card-header"><h3 class="card-title">Detail Pengajuan</h3></div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <tr><th width="35%">Nama Pemohon</th><td>{{ $pengajuanBantuan->nama_pemohon }}</td></tr>
                    <tr><th>No HP</th><td>{{ $pengajuanBantuan->no_hp }}</td></tr>
                    <tr><th>Email</th><td>{{ $pengajuanBantuan->email ?? '-' }}</td></tr>
                    <tr><th>Nama Usaha</th><td>{{ $pengajuanBantuan->nama_usaha }}</td></tr>
                    <tr><th>Jenis Bantuan</th><td><span class="badge badge-info">{{ ucfirst($pengajuanBantuan->jenis_bantuan) }}</span></td></tr>
                    <tr><th>Jumlah Diajukan</th><td>{{ $pengajuanBantuan->jumlah_diajukan ? 'Rp '.number_format($pengajuanBantuan->jumlah_diajukan,0,',','.') : '-' }}</td></tr>
                    <tr><th>Tujuan Penggunaan</th><td>{{ $pengajuanBantuan->tujuan_penggunaan ?? '-' }}</td></tr>
                    <tr><th>Tanggal Pengajuan</th><td>{{ $pengajuanBantuan->created_at->format('d M Y H:i') }}</td></tr>
                    <tr><th>Status</th><td><span class="badge badge-{{ $pengajuanBantuan->status==='disetujui'?'success':($pengajuanBantuan->status==='ditolak'?'danger':($pengajuanBantuan->status==='diproses'?'info':'warning')) }}">{{ ucfirst($pengajuanBantuan->status) }}</span></td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card card-warning card-outline">
            <div class="card-header"><h3 class="card-title">Update Status</h3></div>
            <form method="POST" action="{{ route('admin.pengajuan-bantuan.update', $pengajuanBantuan) }}">
                @csrf @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            @foreach(['menunggu'=>'Menunggu','diproses'=>'Diproses','disetujui'=>'Disetujui','ditolak'=>'Ditolak'] as $v=>$l)
                            <option value="{{ $v }}" {{ $pengajuanBantuan->status==$v?'selected':'' }}>{{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Catatan Admin</label>
                        <textarea name="catatan_admin" class="form-control" rows="4">{{ $pengajuanBantuan->catatan_admin }}</textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-warning btn-block"><i class="fas fa-save mr-1"></i>Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection