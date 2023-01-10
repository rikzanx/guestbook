<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nama',
        'nik',
        'nama_perusahaan',
        'tujuan',
        'foto_ktp',
        'nomor_kartu',
        'keluar',
        'pos_asal',
        'lainnya',
        'no_hp',
        'verifikasi'
    ];
}
