<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nik',
        'nama',
        'jekel',
        'alamat',
        'telp',
        'email',
        'id_perusahaan',
        'id_bagian',
        'id_posisi',
        'idakun',
        'tgl_mulai_bekerja',
        'idusers',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'id_karyawan');
    }

    public function bagian()
    {
        return $this->belongsTo(Bagian::class, 'id_bagian');
    }

    public function posisi()
    {
        return $this->belongsTo(Posisi::class, 'id_posisi');
    }

    public function shiftKaryawan()
    {
        return $this->hasOne(ShiftKaryawan::class, 'id_karyawan');
    }
}
