@extends('surat.layout')

@section('title', 'Preview Surat')

@section('content')

<h2>Preview Surat</h2>

<div class="card p-4 shadow">
    <h3>{{ $surat->judul }}</h3>
    <p>{!! nl2br(e($surat->isi)) !!}</p>

    <h5>QR Code Tanda Tangan:</h5>
    <img src="data:image/png;base64,{{ $qr }}" width="150">

    <br><br>

    <a href="{{ route('surat.download', $surat->id) }}" class="btn btn-success">
        Download PDF
    </a> </br>

    <a href="{{ route('surat.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

@endsection