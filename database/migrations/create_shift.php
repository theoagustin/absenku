<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftsTable extends Migration
{
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('nama_shift');
            $table->time('jam_masuk');
            $table->time('jam_keluar');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shifts');
    }
}

?>