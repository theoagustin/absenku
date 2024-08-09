<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{

    /**
     * fillable
     *
     * @var array
     */
    use HasFactory;
	protected $fillable = [
		'dari_tanggal',
		'sampai_tanggal',
        'keterangan',
        'id_perusahaan',
		'idusers',
        'kategori',
        'perihal',
        'file',
        'status',
        'create_at',
        'update_at',
		];
		
		public function user(){
        return $this->belongsTo(User::class, 'idusers');
    }
}
