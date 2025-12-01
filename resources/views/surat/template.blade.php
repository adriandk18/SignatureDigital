<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $surat->judul }}</title>
    <style>
        body { font-family: "Times New Roman", serif; font-size: 12pt; margin: 50px; }
        .header-kop { border-bottom: 1px solid #000; padding-bottom: 5px; margin-bottom: 20px; }
        .header-kop table { width: 100%; border-collapse: collapse; }
        .header-kop table td { padding: 0; vertical-align: top; }
        .header-kop .logo-box { width: 100px; height: 50px; border: 1px solid #000; text-align: center; line-height: 50px; font-size: 10pt; }
        .header-kop .company-info { text-align: left; padding-left: 15px; font-size: 10pt; }
        .header-kop .company-info strong { font-size: 12pt; }
        .content-info { margin-bottom: 15px; }
        .content-info table { width: 45%; }
        .content-info table td:first-child { width: 100px; }
        .kepada { margin-top: 20px; margin-bottom: 30px; }
        .isi-surat { margin-bottom: 20px; text-align: justify; }
        .penutup { margin-top: 30px; margin-bottom: 40px; }
        .ttd-box { width: 40%; float: right; text-align: left;}
        .ttd-box p { margin: 0; line-height: 1.4; } /* Menambahkan line-height untuk jarak antar baris */
        .qr-box { margin-top: 40px; font-size: 10pt; }
    </style>
</head>
<body>

<div class="header-kop">
    <table>
        <tr>
            <td style="width: 15%;">
                <div class="logo-box">Logo</div> 
            </td>
            <td class="company-info">
                <strong>PT. MAKMUR BERKAH</strong><br>
                Alamat: Jl. Sentosa km. 11 Jakarta<br>
                Email: <a href="mailto:halo@makmur.com">halo@makmur.com</a> | Telp: (021) 3456789
            </td>
        </tr>
    </table>
</div>


<div class="content-info">
    <table>
        <tr><td>No</td><td>: {{ $surat->nomor_surat }}</td></tr>
        <tr><td>Perihal</td><td>: {{ $surat->judul }}</td></tr>
        <tr><td>Lampiran</td><td>: -</td></tr>
    </table>
</div>


<div class="kepada">
    Kepada<br>
    Yth. ____________________________<br>
    Di Tempat
</div>


<div class="isi-surat">
    {!! nl2br(e($surat->isi)) !!}
</div>


<div class="penutup">
    Demikian surat ini dibuat agar dapat digunakan sebagaimana mestinya.  
    Atas perhatian dan kerja sama Saudara, kami ucapkan terima kasih.
</div>


<div class="ttd-box">
    <p>Hormat Kami</p>
    <p>{{ \Carbon\Carbon::parse($surat->created_at)->translatedFormat('d F Y') }}</p>
    <br>
    <p>a.n Dekan FT</p>
    <p>Wakil Dekan Bidang Akademik dan</p>
    <p>Kemahasiswaan FT</p>
    <br> {{-- Tambahkan <br> untuk memberi jarak ke QR --}}
    
    {{-- QR code dari referensi gambar --}}
    @if(isset($qr)) {{-- Pastikan $qr ada sebelum mencoba menampilkannya --}}
        <img src="data:image/svg+xml;base64,{{ $qr }}" width="100"> {{-- Ukuran QR disesuaikan agar tidak terlalu besar di bagian TTD --}}
    @else
        <div style="width: 100px; height: 100px; border: 1px dashed #ccc; text-align: center; line-height: 100px; font-size: 8pt;">QR Placeholder</div>
    @endif
    <br><br> {{-- Tambahkan <br> untuk jarak ke nama --}}

    <p><strong>Dr. -Ing. Dhidik Prastiyanto, S.T., M.T.</strong></p>
</div>

<div style="clear: both;"></div>


{{-- Bagian QR code yang terpisah di bawah ini dihapus karena sudah digabungkan ke ttd-box --}}
{{-- <div class="qr-box">
    <p>Scan QR untuk verifikasi keaslian:</p>
    <img src="data:image/svg+xml;base64,{{ $qr }}" width="130">
</div> --}}

</body>
</html>