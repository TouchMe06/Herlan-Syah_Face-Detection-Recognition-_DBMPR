<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    protected $table = 'jawabans';

    protected $fillable = [
        'daftar_jawaban',
        'tamu_id',
        'pertanyaan_id'
    ];

    public function tamu()
    {
        return $this->belongsTo(Tamu::class);
    }

    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class);
    }
}
