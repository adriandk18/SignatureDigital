<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;

 Route::get('/', function () {
     return redirect('/surat');
 });

// Route::resource('surat', SuratController::class);
// Route::get('surat/{id}/pdf', [SuratController::class, 'pdf'])->name('surat.pdf');

Route::get('/surat/verify', [SuratController::class, 'verifyPage'])->name('surat.verify');
Route::post('/surat/verify/check', [SuratController::class, 'verifyProcess'])->name('surat.verify.process');

Route::resource('surat', SuratController::class);

// Preview surat di browser
Route::get('/surat/{id}/preview', [SuratController::class, 'preview'])->name('surat.preview');

// Download PDF
Route::get('/surat/{id}/download', [SuratController::class, 'download'])->name('surat.download');

