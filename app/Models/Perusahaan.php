<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{

    /**
     * fillable
     *
     * @var array
     */
    use HasFactory;
	protected $fillable = [
		'nama_perusahaan',
        'alamat',
        'telp',
        'bidang',
        'owner',
        'email',
        'latitude',
        'langitude',
        'approv',
		'max_jarak_absen',
        'idusers',
		];
        public function karyawans()
    {
        return $this->hasMany(Karyawan::class, 'id_perusahaan');
    }
}
