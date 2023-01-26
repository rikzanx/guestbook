<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesBlokir extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        "blokir_id",
        "foto_blokir"
    ];

    public function product(){
        return $this->hasOne('App\Models\Blokir','id','blokir_id');
    }
}
