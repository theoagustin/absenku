<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{

    /**
     * fillable
     *
     * @var array
     */
    use HasFactory;
	protected $fillable = [
		'nik',
		'nama',
		'jekel',
		'alamat',
		'telp',
		'npwp',
		'id_perusahaan',
		'id_bagian',
        'id_posisi',
        'idakun',
        'tgl_mulai_bekerja',
        'idusers',
		];
		
		public function user(){

        return $this->hasMany(User::class);
    }
}
