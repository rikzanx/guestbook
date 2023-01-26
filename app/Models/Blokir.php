<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blokir extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'nama',
        'nik',
        'jenis_blokir',
        'foto',
        'keterangan',
        'masa_berlaku'
    ];

    public function images(){
        return $this->hasMany('App\Models\ImagesBlokir','blokir_id');
    }
}
