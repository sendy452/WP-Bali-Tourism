@extends('layouts.app')

@push('css')
<link href="{{ asset('plugins/datatable/jquery.dataTables.min.css')  }}" rel="stylesheet"/>
@endpush


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
                    <div class="panel-heading">Jarak Wisata</div>

                    <div class="panel-body">

                        <form method="post" action="{{ url('jarak') }}">
                            {{ csrf_field() }}
                            <div class="form-group" align="center">
                                <label>Cek Lokasi</label>
                                <div class="input-group">
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude" value="{{ $latitude ?? '' }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude" value="{{ $longitude ?? '' }}" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="input-group">
                                            <a class="btn btn-default" onclick="getLocation()"><span class="glyphicon glyphicon-refresh"></span></a>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="input-group">
                                            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-ok"></span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        @if (@$wisata)
                        <h3>List Wisata Terdekat</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="distance">
                                <thead>
                                    <tr>
                                        <th>Wisata</th>
                                        <th>Daerah</th>
                                        <th>Jarak (km)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($wisata as $v)
                                    <tr>
                                        <td>{{ $v['nama']}}</td>
                                        <td>{{ $v['daerah']}}</td>
                                        <td>{{ $v['jarak'] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('javascript')
<script src="{{ asset('plugins/datatable/jquery.dataTables.min.js')  }}"></script>

<script>
    $(document).ready(function(){
        $('#distance').DataTable({
            aaSorting: [[2, 'asc']],
            search : false
        });
    });

    const x = document.getElementById("latitude");
    const y = document.getElementById("longitude");

    function getLocation() {
        if (navigator.geolocation) {
            console.log(navigator)
            navigator.geolocation.getCurrentPosition(showPosition);
        } else { 
            x.value = "Not Found";
            y.value = "Not Found";
        }
    }

    function showPosition(position) {
        x.value = position.coords.latitude; 
        y.value = position.coords.longitude;
    }
</script>
@endpush

