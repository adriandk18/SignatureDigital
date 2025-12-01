@extends('surat.layout')

@section('title', 'Preview Surat')

@section('content')

<div class="card p-5 shadow-lg" style="max-width: 800px; margin: auto; background: white;">

    <!-- KOP SURAT -->
    <div class="header-kop mb-4 pb-3" style="border-bottom: 2px solid #000;">
        <div style="display: flex; align-items: center;">
            
            <!-- Logo -->
            <div style="
                width: 80px; 
                height: 80px; 
                border: 1px solid #000; 
                text-align: center; 
                line-height: 80px;
                font-size: 12px;">
                Logo
            </div>

            <!-- Info Perusahaan -->
            <div style="margin-left: 20px; font-family: 'Times New Roman';">
                <strong style="font-size: 18px;">PT. MAKMUR BERKAH</strong><br>
                <span style="font-size: 14px;">
                    Alamat: Jl. Sentosa km. 11 Jakarta<br>
                    Email: halo@makmur.com | Telp: (021) 3456789
                </span>
            </div>
        </div>
    </div>

    <!-- INFORMASI SURAT -->
    <div class="content-info mb-4" style="font-family: 'Times New Roman'; font-size: 14px;">
        <table>
            <tr>
                <td style="width: 120px;">Nomor</td>
                <td>: {{ $surat->nomor_surat ?? '-' }}</td>
            </tr>
            <tr>
                <td>Perihal</td>
                <td>: {{ $surat->judul }}</td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td>: -</td>
            </tr>
        </table>
    </div>

    <!-- PENERIMA -->
    <div class="kepada mb-4" style="font-family: 'Times New Roman'; font-size: 14px;">
        Kepada Yth:<br>
        <strong>{{ $surat->penerima ?? '-' }}</strong><br>
        Di Tempat
    </div>

    <!-- ISI SURAT -->
    <div class="isi-surat mb-4" style="font-family: 'Times New Roman'; 
                                       text-align: justify; 
                                       font-size: 15px;">
        {!! nl2br(e($surat->isi)) !!}
    </div>

    <!-- PENUTUP -->
    <div class="penutup mb-5" style="font-family: 'Times New Roman'; font-size: 15px;">
        Demikian surat ini dibuat agar dapat digunakan sebagaimana mestinya.<br>
        Atas perhatian dan kerja sama Saudara, kami ucapkan terima kasih.
    </div>

    <!-- TANDA TANGAN -->
    <div style="width: 300px; margin-left: auto; font-family: 'Times New Roman'; font-size: 14px;">
        
        <p>Hormat Saya,</p>
        <p>{{ \Carbon\Carbon::parse($surat->created_at)->translatedFormat('d F Y') }}</p>

        <br>

        <p>{{ $surat->penandatangan_jabatan ?? '-' }}</p>

        <!-- QR CODE -->
        <div class="mt-3">
            <strong>QR Code Tanda Tangan:</strong><br>
            <img src="data:image/svg+xml;base64,{{ $qr }}" width="130">
        </div>

        <br><br>

        <p><strong>{{ $surat->penandatangan_nama ?? '-' }}</strong></p>
    </div>

    <hr>

    <div class="mt-3">
        <a href="{{ route('surat.download', $surat->id) }}" class="btn btn-success">Download PDF</a>
        <a href="{{ route('surat.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

</div>

@endsection
