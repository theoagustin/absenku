<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ListPerusahaan extends Model
{
    public function bagians()
    {
        return $this->hasMany(Bagian::class);
    }
}