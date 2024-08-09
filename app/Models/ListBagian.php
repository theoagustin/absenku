<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListBagian extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_bagian',
    ];

    public function bagian()
    {

        return $this->hasMany(Bagian::class);
    }
}