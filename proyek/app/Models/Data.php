<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Mahasiswa as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model; //Model Eloquent

class Data extends Model
{
    use HasFactory;
    protected $table="data";
    public $timestamps= false;
    protected $primaryKey = 'id';

    protected $fillable = [
        'email',
        'nama',
        'NIDN', 
        'jurusan',
        'studi',
        'hp', 
        'jenisKl', 
        'judulKl' ,
        'noSertif',
        'pemegangKl', 
        'fileSertif',
        'filePernyataan',
        'fileIdentitas'
        ];
    
    public function jurusan(){
        return $this->belongsTo(Jurusan::class);
    }
       

}
