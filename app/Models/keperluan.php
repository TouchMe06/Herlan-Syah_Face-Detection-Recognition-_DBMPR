<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keperluan extends Model
{
    use HasFactory;

    protected $table = 'keperluans';

    protected $fillable = [
        'judul',
    ];

    public function tamu()
    {
        return $this->hasMany(Tamu::class);
    }
}
