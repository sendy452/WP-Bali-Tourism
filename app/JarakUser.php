<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JarakUser extends Model
{
    protected $table = 'jarak_users';
    protected $fillable = ['wisata_id', 'kriteria_id', 'user_id', 'jarak', 'nilai'];

    public function wisata(){
        return $this->belongsTo('App\Wisata','wisata_id','id');
    }

    public function kriteria(){
        return $this->belongsTo('App\Kriteria','kriteria_id','id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
}
