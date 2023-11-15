<?php

namespace App\Http\Controllers;

use App\Wisata;
use App\Kriteria;
use App\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Utils\WPGenerator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        return view('home')->with([
            'menu' => 'dashboard'
        ]);
    }

    public function list_data(){
        $wisata = Wisata::all();
        $kriteria = Kriteria::all();
        $nilai = Nilai::all();
        $data = [];
        $tmp_nilai = [];
        $penerima_id = null;
        foreach ($nilai as $n){
            if($n->wisata_id != $penerima_id){
                $penerima_id = $n->wisata_id;
                $tmp_nilai = [];
            }
            array_push($tmp_nilai, $n->nilai);
            $data[$penerima_id]= $tmp_nilai;
        }


        return view('perhitungan')->with([
            'menu' => 'list',
            'wisata' => $wisata,
            'kriteria' => $kriteria,
            'data' => $data
        ]);
    }

    public function calculate(){
        $data = WPGenerator::weight_product();
        $kriteria = Kriteria::all();
        $penerima = Wisata::all();


        return view('calculate')->with([
            'menu' => 'list',
            'kriteria' => $kriteria,
            'data' => $data,
            'penerima' => $penerima
        ]);
    }
}
