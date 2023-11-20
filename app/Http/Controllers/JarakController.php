<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wisata;

class JarakController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){
        return view('jarak.calculate')->with([
            'menu' => 'jarak',
            'wisata' => null
        ]);
    }

    public function store(Request $request)
    {
        $wisata = Wisata::get();
        $hasil_jarak = [];
        foreach ($wisata as $value){
            $hasil = $this->distance($request->latitude, $request->longitude, $value->latitude, $value->longitude);
            $array_jarak = [
                'id_wisata' => $value->id,
                'nama' => $value->nama,
                'daerah' => $value->daerah,
                'jarak' => $hasil,
            ];
            array_push($hasil_jarak, $array_jarak);
        }

        return view('jarak.calculate')->with([
            'menu' => 'jarak',
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'wisata' => $hasil_jarak,
        ]); 
    }

    private function distance($lat1, $lon1, $lat2, $lon2) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        }
        else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
      
            return number_format(($miles * 1.609344), 2, '.', ''); 
        }
    }
}
