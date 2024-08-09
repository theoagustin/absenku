<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftKaryawansTable extends Migration
{
    public function up()
    {
        Schema::create('shift_karyawans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_karyawan')->constrained('karyawans')->onDelete('cascade');
            $table->foreignId('id_shift')->constrained('shifts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shift_karyawans');
    }
}

?>