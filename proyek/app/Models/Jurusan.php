<?php

namespace App\Models;
use App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    protected $table='jurusan'; //mendefinisikan bahwa model ini terkait dengan tabel kelas

    public function data(){
        return $this->hasMany(Data::class);
    }
}
