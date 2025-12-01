@extends('surat.layout')

@section('title', 'Daftar Surat')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Daftar Surat</h3>
    <a href="{{ route('surat.create') }}" class="btn btn-primary">+ Buat Surat</a>
</div>

@if (session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Judul</th>
            <th>Nomor Surat</th>
            <th>Dibuat</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($surat as $s)
        <tr>
            <td>{{ $s->judul }}</td>
            <td>{{ $s->nomor_surat }}</td>
            <td>{{ $s->created_at->format('d M Y') }}</td>
            <td>
                <a href="{{ route('surat.preview', $s->id) }}" class="btn btn-primary btn-sm">Lihat Surat</a>

                <a href="{{ route('surat.edit', $s->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('surat.destroy', $s->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus surat ini?')">Hapus</button>
                </form>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>
    
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('surat.verify') }}" class="btn btn-primary">Verifikasi Surat</a>
    </div>

{{ $surat->links() }}
@endsection
