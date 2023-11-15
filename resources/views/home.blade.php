@extends('layouts.app')

@section('content')

    <div class="container">
        @if(Auth::user()->level==='admin')
            @include('component.menu_admin')
        @else
            @include('component.menu_user')
        @endif
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Selamat Datang, di Sistem Penunjang Keputusan Wisata di Bali</strong></div>

                    <div class="panel-body">
                        <img src="{{ asset('img/wp.jpg')  }}" class="img-responsive" width="100%"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
