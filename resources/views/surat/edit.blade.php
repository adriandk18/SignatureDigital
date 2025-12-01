@extends('surat.layout')

@section('title', 'Edit Surat')

@section('content')
<h3>Edit Surat</h3>

<form action="{{ route('surat.update', $surat->id) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-3">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control" value="{{ $surat->judul }}" required>
    </div>

    <div class="mb-3">
        <label>Nomor Surat</label>
        <input type="text" name="nomor_surat" class="form-control" value="{{ $surat->nomor_surat }}">
    </div>

    <div class="mb-3">
        <label>Penerima</label>
        <input type="text" name="penerima" class="form-control" value="{{ $surat->penerima }}" required>
    </div>

    <div class="mb-3">
        <label>Isi Surat</label>
        <textarea name="isi" class="form-control" rows="6" required>{{ $surat->isi }}</textarea>
    </div>

    <div class="mb-3">
        <label>Nama Penandatangan</label>
        <input type="text" name="penandatangan" class="form-control" value="{{ $surat->penandatangan }}" placeholder="Contoh: Kepala Desa">
    </div>

    <button class="btn btn-warning">Update</button>

    <a href="{{ route('surat.index') }}" class="btn btn-secondary ms-2">
        Kembali
    </a>
</form>
@endsection
