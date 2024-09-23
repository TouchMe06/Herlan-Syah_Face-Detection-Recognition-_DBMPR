<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    use HasFactory;

    protected $table = 'unit_kerjas';

    protected $fillable = [
        'nm_unit_kerja',
    ];

    public function Pegawai()
    {
        return $this->hasMany(Pegawai::class);
    }
}
