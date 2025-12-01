<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $fillable = [
        'nomor_surat',
        'judul',
        'isi',
        'penerima',
        'tanggal',
        'penandatangan',
    ];
}

