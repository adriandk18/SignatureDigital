@extends('surat.layout')

@section('content')
<div class="container mt-4">
    <h3>Verifikasi Keaslian Surat</h3>

    <form action="{{ route('surat.verify.process') }}" method="POST">
        @csrf

        <label>ID Surat:</label>
        <input type="text" name="id" class="form-control" required>

        <label class="mt-2">Hash Surat:</label>
        <input type="text" name="hash" class="form-control" required>

        <button class="btn btn-primary mt-3">Verifikasi</button>

        <a href="{{ route('surat.index') }}" class="btn btn-secondary mt-3 ms-2">
            Kembali
        </a>
    </form>

    @if (session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif
</div>
@endsection
