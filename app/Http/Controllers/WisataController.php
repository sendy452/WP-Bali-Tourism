<?php

namespace App\Http\Controllers;

use App\Wisata;
use App\Http\Requests\StoreWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WisataController extends Controller
{
    public  function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wisata = Wisata::paginate(10);

        $data = array(
            'title' => 'Wisata',
            'menu' => 'wisata',
            'wisata' => $wisata
        );
        return view('wisata.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWisata $request)
    {
        $penerima = Wisata::create($request->except(['_token']));
        if($penerima){
            $request->session()->flash('success', 'Berhasil menambahkan data wisata beasiswa.');
        }else{
            $request->session()->flash('error', 'Gagal menambahkan data wisata.');
        }
        return redirect()->action('WisataController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wisata  $wisata
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penerima = Wisata::findOrFail($id);
        return view('wisata.view', ['penerima' => $penerima, 'menu' => 'wisata' , 'title' => 'Detail data ' . $penerima->nama]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Wisata  $wisata
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $penerima = Wisata::findOrFail($id);
        return view('wisata.update', ['penerima' => $penerima, 'menu' => 'wisata' , 'title' => 'Ubah data ' . $penerima->nama]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wisata  $wisata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nis' => 'required|max:20|regex:[[0-9]+]',
            'nama' => 'required|max:50|regex:[[A-Za-z]+]',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir' =>  'required',
            'telp' => 'required|max:20|regex:[[0-9]+]'
        ]);
        $penerima = Wisata::findOrFail($id);
        $nisIsExist = Wisata::where('id','<>',$id)->where('nis','=',$request->nis)->first();
        if($nisIsExist){
            $this->validate($request,[
               'nis' => 'required|max:20|regex:[[0-9]+]|unique:wisata'
            ]);
            return view('wisata.update', ['penerima' => $penerima, 'menu' => 'wisata' , 'title' => 'Ubah data ' . $penerima->nama]);
        }

        $update = $penerima->update($request->except(['_token','_method']));
        if($update){
            $request->session()->flash('success', 'Berhasil mengubah data wisata beasiswa.');
            return redirect()->action('WisataController@index');
        }else{
            $request->session()->flash('error', 'Gagal mengubah data wisata beasiswa.');
        }
        return view('wisata.update', ['penerima' => $penerima, 'menu' => 'wisata' , 'title' => 'Ubah data ' . $penerima->nama]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wisata  $wisata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $penerima = Wisata::findOrFail($id);
        if($penerima->delete()){
            $request->session()->flash('success','Berhasil menghapus data wisata beasiswa.');
        }else{
            $request->session()->flash('error','Gagal menghapus data wisata beasiswa.');
        }
        return redirect()->action('WisataController@index');
    }
}
