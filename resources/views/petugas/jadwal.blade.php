
@extends("layouts.app")

@section("title","Jadwal")
@section("page-title","Jadwal Petugas")

@section("content")
<h3>Daftar Jadwal</h3>

@foreach($jadwal as $j)
    <div class="card mb-2">
        <div class="card-body">
            <h5>{{ $j->judul }}</h5>
            <p>{{ $j->tanggal }}</p>
            <a href="{{ route('petugas.jadwal.show',$j) }}" class="btn btn-primary btn-sm">
                Detail
            </a>
        </div>
    </div>
@endforeach

{{ $jadwal->links() }}
@endsection