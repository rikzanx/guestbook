<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode',
        'pertanyaan',
        'catatan'
    ];
    public function values(){
        return $this->hasMany('App\Models\PertanyaanValue','pertanyaan_id');
    }
}
