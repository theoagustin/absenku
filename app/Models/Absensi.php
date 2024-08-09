<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{

    /**
     * fillable
     *
     * @var array
     */
    use HasFactory;
	protected $fillable = [
		'id_karyawan',
        'tanggal',
        'jam_masuk',
        'jam_keluar',
        'status_kehadiran',
        'latitude',
        'langitude',
        'keterangan',
        'idusers',
		];
        public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}
