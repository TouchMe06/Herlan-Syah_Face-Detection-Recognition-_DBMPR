<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawais';

    protected $fillable = [
        'unit_kerja_id',
        'nama',
        'nip',
        'telp'
    ];

    public function UnitKerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }

    public function tamu()
    {
        return $this->hasMany(Tamu::class);
    }
}
