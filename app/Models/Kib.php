<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kib extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $fillable = [
        'nomor_kib',
        'no_ktp',
        'nama',
        'perusahaan',
        'alamat',
        'tgl_terbit',
        'masa_berlaku',
        'kontrak_kerja',
        'area_kerja',
        'status'
    ];

}
