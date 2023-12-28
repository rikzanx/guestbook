<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertanyaanValue extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'pertanyaan_id',
        'value'
    ];
}
