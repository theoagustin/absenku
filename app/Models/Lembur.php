<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_karyawan',
        'tgl_lembur',
        'jam_mulai',
        'jam_selesai',
        'keterangan_lembur',
        'upah_tambahan',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}
