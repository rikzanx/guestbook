<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratJalan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nama_barang',
        'jumlah',
        'bentuk',
        'dari',
        'tujuan',
        'nomor_po',
        'nama_penanggung_jawab',
        'nomor',
        'waktu_masuk',
        'waktu_keluar',
        'verifikasi'
    ];
    public function images(){
        return $this->hasMany('App\Models\ImagesSuratJalan','surat_jalan_id');
    }
}
