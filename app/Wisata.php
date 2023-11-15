<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $table = 'wisata';
    protected $fillable = ['nama','alamat','jenis_kelamin','tgl_lahir','telp'];

    public function nilai(){
        return $this->hasMany('App\Nilai','wisata_id','id');
    }
}
