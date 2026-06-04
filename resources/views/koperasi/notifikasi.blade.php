@extends('layouts.app')
@section('title','Notifikasi')
@section('page-title','Notifikasi')
@section('breadcrumb')<li class="breadcrumb-item active">Notifikasi</li>@endsection
@section('content')
<div class="card shadow-sm">
<div class="card-header"><h3 class="card-title"><i class="fas fa-bell mr-2"></i>Notifikasi</h3></div>
<div class="card-body p-0">
@forelse($notifikasi as $n)
<div class="d-flex p-3 border-bottom {{ $n->read_at ? '' : 'bg-light' }}">
<div class="mr-3"><span class="badge badge-{{ $n->jenis ?? 'info' }} p-2"><i class="fas fa-bell"></i></span></div>
<div class="flex-grow-1">
<strong>{{ $n->judul }}</strong>
<p class="mb-1 text-muted" style="font-size:13px">{{ $n->pesan }}</p>
<small class="text-muted">{{ $n->created_at->diffForHumans() }}</small>
</div>
@if(!$n->read_at)
<div><form method="POST" action="{{ route('koperasi.notifikasi.read',$n) }}">@csrf<button type="submit" class="btn btn-sm btn-outline-primary">Tandai Dibaca</button></form></div>
@endif
</div>
@empty
<div class="text-center py-4 text-muted"><i class="fas fa-bell-slash fa-3x d-block mb-2"></i>Tidak ada notifikasi</div>
@endforelse
</div>
<div class="card-footer">{{ $notifikasi->links('pagination::bootstrap-4') }}</div>
</div>
@endsection
