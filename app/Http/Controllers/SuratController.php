<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

// BaconQrCode v2
use BaconQrCode\Writer;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;

class SuratController extends Controller
{
    public function index()
    {
        $surat = Surat::paginate(10);
        return view('surat.index', compact('surat'));
    }

    public function create()
    {
        return view('surat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'nomor_surat' => 'nullable',
            'isi'   => 'required',
            'penerima' => 'required',
            'penandatangan_nama' => 'required',
            'penandatangan_jabatan' => 'required'
        ]);

        Surat::create([
            'judul' => $request->judul,
            'nomor_surat' => $request->nomor_surat,
            'isi'   => $request->isi,
            'penerima' => $request->penerima,
            'penandatangan_nama' => $request->penandatangan_nama,
            'penandatangan_jabatan' => $request->penandatangan_jabatan
        ]);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil dibuat.');
    }

    public function show($id)
    {
        $surat = Surat::findOrFail($id);
        return view('surat.show', compact('surat'));
    }

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        return view('surat.edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'nomor_surat' => 'nullable',
            'isi'   => 'required',
            'penerima' => 'required',
            'penandatangan_nama' => 'required',
            'penandatangan_jabatan' => 'required'
        ]);

        $surat->update([
            'judul' => $request->judul,
            'nomor_surat' => $request->nomor_surat,
            'isi'   => $request->isi,
            'penerima' => $request->penerima,
            'penandatangan_nama' => $request->penandatangan_nama,
            'penandatangan_jabatan' => $request->penandatangan_jabatan
        ]);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Surat::findOrFail($id)->delete();
        return redirect()->route('surat.index')->with('success', 'Surat berhasil dihapus.');
    }


    /* ===================================================
     *      QR CODE GENERATOR (SVG)
     * =================================================== */
    private function generateQr(string $text): string
    {
        $renderer = new ImageRenderer(
            new RendererStyle(180),
            new SvgImageBackEnd()
        );

        $writer = new Writer($renderer);
        $svg = $writer->writeString($text);

        return base64_encode($svg);
    }


    /* ===================================================
     *     HASHING SHA-256 — DIGITAL SIGNATURE
     * =================================================== */
    private function generateHash(Surat $surat): string
    {
        $secret = env('APP_KEY');

        return hash("sha256",
            $surat->id .
            $surat->judul .
            $surat->isi .
            $surat->penandatangan_nama .
            $surat->penandatangan_jabatan .
            $surat->created_at .
            $secret
        );
    }


    /* ===================================================
     *        PREVIEW SURAT (HTML)
     * =================================================== */
    public function preview($id)
    {
        $surat = Surat::findOrFail($id);

        $hash = $this->generateHash($surat);
        $qrContent = "ID={$surat->id}|HASH={$hash}";
        $qr = $this->generateQr($qrContent);

        return view('surat.preview', compact('surat', 'qr'));
    }


    /* ===================================================
     *              DOWNLOAD PDF SURAT
     * =================================================== */
    public function download($id)
    {
        $surat = Surat::findOrFail($id);

        $hash = $this->generateHash($surat);
        $qrContent = "ID={$surat->id}|HASH={$hash}";
        $qr = $this->generateQr($qrContent);

        $pdf = Pdf::loadView('surat.template', compact('surat', 'qr'))
                  ->setPaper('A4', 'portrait');

        return $pdf->download("surat-{$surat->id}.pdf");
    }


    /* ===================================================
     *             F I T U R   V E R I F I K A S I
     * =================================================== */

    public function verifyPage()
    {
        return view('surat.verify');
    }

    public function verifyProcess(Request $request)
    {
        $request->validate([
            'id'   => 'required',
            'hash' => 'required'
        ]);

        $surat = Surat::find($request->id);

        if (!$surat) {
            return back()->with('error', 'Surat tidak ditemukan.');
        }

        // hash asli
        $realHash = $this->generateHash($surat);

        if ($realHash === $request->hash) {
            return back()->with('success', '✔ Surat valid & asli.');
        }

        return back()->with('error', '❌ Surat tidak valid (hash tidak cocok).');
    }
}
