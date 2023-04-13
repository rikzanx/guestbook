<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratJalan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nama',
        'nik',
        'nomor_surat',
        'departemen',
        'dari',
        'tujuan',
        'no_mb',
        'barang',
        'foto_suratjalan',
        'pos_izin',
        'lainnya',
        'verifikasi'
    ];
}
