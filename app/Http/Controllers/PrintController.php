<?php

namespace App\Http\Controllers;

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
                if(array_key_exists($p->id, $data['v'])){
                    $data['v'][$p->id] = $p->nama . "|" . $data['v'][$p->id];
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
