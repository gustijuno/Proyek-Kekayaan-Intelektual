<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RelasiJurusanDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data', function(Blueprint $table){
            $table->dropColumn('jurusan'); //menghapus kolom
            $table->unsignedBigInteger('jurusan_id')->nullable(); //menambahkan kolom kelas_id
            $table->foreign('jurusan_id')->references('id')->on('jurusan'); //menambahkan foreign key di kolom kelas_id
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data', function(Blueprint $table){
            $table->string('jurusan');
            $table->dropForeign(['jurusan_id']);
        });
    }
}
