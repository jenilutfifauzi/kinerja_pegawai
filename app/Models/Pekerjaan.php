<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    use HasFactory;

    protected $table = 'pekerjaans';
    protected $guarded = [];


    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori_pekerjaan()
    {
        return $this->belongsTo(KategoriPekerjaan::class);
    }

    public function data_penilaians()
    {
        return $this->hasMany(DataPenilaian::class);
    }
}
