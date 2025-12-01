@extends('surat.layout')

@section('title', 'Buat Surat')

@section('content')
<h3>Buat Surat Baru</h3>

<form action="{{ route('surat.store') }}" method="POST">
    @csrf
    
    <div class="mb-3">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Nomor Surat (opsional)</label>
        <input type="text" name="nomor_surat" class="form-control">
    </div>

    <div class="mb-3">
        <label>Penerima</label>
        <input type="text" name="penerima" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Isi Surat</label>
        <textarea name="isi" class="form-control" rows="6" required></textarea>
    </div>

    <div class="mb-3">
        <label>Jabatan Penandatangan</label>
        <input type="text" name="penandatangan_jabatan" class="form-control">
    </div>

    <div class="mb-3">
        <label>Nama Penandatangan</label>
        <input type="text" name="penandatangan_nama" class="form-control">
    </div>

    <button class="btn btn-primary">Simpan</button>
</form>
@endsection
