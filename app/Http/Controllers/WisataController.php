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
            $request->session()->flash('success', 'Berhasil menambahkan data wisata.');
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
        $wisata = Wisata::findOrFail($id);
        return view('wisata.view', ['wisata' => $wisata, 'menu' => 'wisata' , 'title' => 'Detail data ' . $wisata->nama]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Wisata  $wisata
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wisata = Wisata::findOrFail($id);
        return view('wisata.update', ['wisata' => $wisata, 'menu' => 'wisata' , 'title' => 'Ubah data ' . $wisata->nama]);
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
            'nama' => 'required|max:50|regex:[[A-Za-z]+]',
            'daerah' => 'required|max:50',
            'alamat' => 'required',
            'fasilitas' => 'required',
            'jam_buka' => 'required',
            'jam_tutup' =>  'required',
            'ulasan' =>  'required',
            'rating' =>  'required',
            'latitude' =>  'required|max:50',
            'longitude' =>  'required|max:50',
        ]);
        $penerima = Wisata::findOrFail($id);

        $update = $penerima->update($request->except(['_token','_method']));
        if($update){
            $request->session()->flash('success', 'Berhasil mengubah data wisata.');
            return redirect()->action('WisataController@index');
        }else{
            $request->session()->flash('error', 'Gagal mengubah data wisata.');
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
            $request->session()->flash('success','Berhasil menghapus data wisata.');
        }else{
            $request->session()->flash('error','Gagal menghapus data wisata.');
        }
        return redirect()->action('WisataController@index');
    }
}
