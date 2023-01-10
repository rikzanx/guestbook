<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nama_badan_usaha',
        'lokasi_pekerjaan',
        'departemen',
        'jenis_pekerjaan',
        'jumlah_personil',
        'ktp',
        'kib',
        'surat_kesehatan',
        'lainnya',
        'foto_lembar_depan',
        'nama_safety_upload',
        'no_hp',
        'verifikasi'
    ];
}
