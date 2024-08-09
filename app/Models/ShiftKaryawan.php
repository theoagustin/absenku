<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class ShiftKaryawan extends Model
    {
        use HasFactory;

        protected $fillable = [
            'id_karyawan',
            'id_shift',
        ];

        public function shift()
        {
            return $this->belongsTo(Shift::class, 'id_shift');
        }

        public function karyawan()
        {
            return $this->belongsTo(Karyawan::class, 'id_karyawan');
        }
    }

    ?>