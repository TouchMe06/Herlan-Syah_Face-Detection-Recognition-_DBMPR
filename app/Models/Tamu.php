<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tamu extends Model
{
    use HasFactory;

    protected $table = 'tamus';

    protected $fillable = [
        'nama',
        'telp',
        'instansi',
        'alamat',
        'jekel',
        'keperluan_id',
        'keperluan_lainnya',
        'pegawai_id',
        'foto',
    ];

    public function keperluan()
    {
        return $this->belongsTo(Keperluan::class);
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class);
    }
}
