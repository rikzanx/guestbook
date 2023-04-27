<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesSuratJalan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $fillable = [
        "surat_jalan_id",
        "image_surat_jalan"
    ];

    public function suratjalan(){
        return $this->hasOne('App\Models\SuratJalan','id','surat_jalan_id');
    }
}
