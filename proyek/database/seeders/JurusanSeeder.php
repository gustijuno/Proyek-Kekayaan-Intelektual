<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jurusan = [
            ['nama_jurusan' => 'Teknologi Informasi',],
            ['nama_jurusan' => 'Teknik Elektro',],
            ['nama_jurusan' => 'Teknik Mesin',],
            ['nama_jurusan' => 'Teknik Kimia',],
            ['nama_jurusan' => 'Teknik Sipil',],
            ['nama_jurusan' => 'Akutansi',],
            ['nama_jurusan' => 'Administrasi Niaga',],
        ];

        DB::table('jurusan')->insert($jurusan);
    }
}
