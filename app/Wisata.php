<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    protected $table = 'wisata';
    protected $fillable = [
        'nama',
        'daerah',
        'alamat',
        'fasilitas',
        'jam_buka',
        'jam_tutup',
        'ulasan',
        'rating',
        'latitude',
        'longitude'
    ];

    public function nilai(){
        return $this->hasMany('App\Nilai','wisata_id','id');
    }
}
