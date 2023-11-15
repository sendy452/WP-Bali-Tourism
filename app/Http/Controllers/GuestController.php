<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wisata;
class GuestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cpeserta(){
        $wisata = Wisata::paginate(10);

        $data = array(
            'title' => 'List Wisata',
            'menu' => 'wisata',
            'wisata' => $wisata
        );
        return view('wisata.gindex')->with($data);
    }

    public function detailcpeserta($id){
        $penerima = Wisata::findOrFail($id);
        return view('wisata.gview', ['penerima' => $penerima, 'menu' => 'wisata' , 'title' => 'Detail data ' . $penerima->nama]);
    }
}
