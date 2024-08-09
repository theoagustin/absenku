<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_shift',
        'jam_masuk',
        'jam_keluar',
        'idusers',
        'created_at',
        'updated_at'
    ];
}

?>