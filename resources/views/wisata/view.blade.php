@extends('layouts.app')

@section('content')


    <div class="container">
        @if(Auth::user()->level==='admin')
            @include('component.menu_admin')
        @endif
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">{{ $title  }}</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <a href="{{ url('wisata') }}">
                                <button class="btn btn-info">
                                    <span class="glyphicon glyphicon-arrow-left"></span>
                                    Kembali
                                </button>
                            </a>
                        </div>
                        <table class="table table-bordered">
                            <tr>
                                <td><b>Nama</b></td>
                                <td width="1%"> : </td>
                                <td>{{ $wisata->nama  }}</td>
                            </tr>
                            <tr>
                                <td><b>Daerah</b></td>
                                <td> : </td>
                                <td>{{ $wisata->daerah  }}</td>
                            </tr>
                            <tr>
                                <td><b>Alamat</b></td>
                                <td> : </td>
                                <td>{{ $wisata->alamat  }}</td>
                            </tr>
                            <tr>
                                <td><b>Fasilitas</b></td>
                                <td> : </td>
                                <td>{{ $wisata->fasilitas  }}</td>
                            </tr>
                            <tr>
                                <td><b>Jam Operasional</b></td>
                                <td> : </td>
                                <td>{{ date("h:i", strtotime($wisata->jam_buka)) .' - '. date("h:i", strtotime($wisata->jam_tutup))  }}</td>
                            </tr>
                            <tr>
                                <td><b>Total Ulasan</b></td>
                                <td> : </td>
                                <td>{{ $wisata->ulasan  }}</td>
                            </tr>
                            <tr>
                                <td><b>Rating</b></td>
                                <td> : </td>
                                <td>{{ $wisata->rating  }}</td>
                            </tr>
                            <tr>
                                <td><b>Latitude</b></td>
                                <td> : </td>
                                <td>{{ $wisata->latitude  }}</td>
                            </tr>
                            <tr>
                                <td><b>Longitude</b></td>
                                <td> : </td>
                                <td>{{ $wisata->longitude  }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
