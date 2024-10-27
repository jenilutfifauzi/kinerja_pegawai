<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPenilaian extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'periode' => 'date'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function kelola_pekerjaans()
    {
        return $this->hasMany(Pekerjaan::class, 'pegawai_id', 'pegawai_id');
    }
  
}
