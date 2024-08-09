<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posisi extends Model
{

    /**
     * fillable
     *
     * @var array
     */
    use HasFactory;
	protected $fillable = [
		'id_perusahaan',
		'id_bagian',
        'nama_posisi',
        'jenis_gaji',
        'gaji_pokok',
        'gaji_lembur_perjam',
        'idusers',
		];
		
		public function user(){

        return $this->hasMany(User::class);
    }
}
