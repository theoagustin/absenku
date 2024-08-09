<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{

    /**
     * fillable
     *
     * @var array
     */
    use HasFactory;
	protected $fillable = [
		'id_perusahaan',
        'nama_bagian',
        'idusers',
		];
	
}
