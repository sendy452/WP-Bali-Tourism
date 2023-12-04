<?php

namespace App\Http\Controllers;

use App\JarakUser;
use Illuminate\Http\Request;
use App\Utils\WPGenerator;
use App\Wisata;
class PrintController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function index(){
        $data = WPGenerator::weight_product();
        $wisata = Wisata::all();
        if ($data['v']) {
            arsort($data['v']);

            foreach ($wisata as $p) {
                $jarak = JarakUser::where('user_id', auth()->user()->id)->where('wisata_id', $p->id)->first()->jarak;

                if(array_key_exists($p->id, $data['v'])){
                    $data['v'][$p->id] = $p->nama . "|" . $data['v'][$p->id] . "|" . $jarak ?? 0;
                }
            }
        }

        return view('print.print')->with([
            'menu' => 'list',
            'data' => $data,
            'wisata' => $wisata
        ]);
    }
}
