<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'pertanyaan_id',
        'jawaban',
        'catatan'
    ];
}
