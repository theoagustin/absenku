<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{

    /**
     * fillable
     *
     * @var array
     */
    use HasFactory;
	protected $fillable = [
		'idusers',
		'nama',
        'username',
        'password',
        'gaji_pokok',
        'gaji_lembur_perjam',
        'idusers',
		];
		
		public function user(){

        return $this->hasMany(User::class);
    }
}
