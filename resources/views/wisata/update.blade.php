@extends('layouts.app')


@push('css')
<link href="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.css')  }}" type="text/css" rel="stylesheet"/>
@endpush

@section('content')


    <div class="container">
        @if(Auth::user()->level==='admin')
            @include('component.menu_admin')
        @endif
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <strong>Error!</strong>
                        <ul>
                            @foreach($errors->all() as $err)
                                <li>{{ $err  }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">{{ $title  }}</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <a href="{{ urL('wisata') }}">
                                <button class="btn btn-info">
                                    <span class="glyphicon glyphicon-arrow-left"></span>
                                    Kembali
                                </button>
                            </a>
                        </div>

                        <div class="create-form">
                            <form method="post" action="{{ url('wisata', ['id' => $wisata->id ]) }}">

                                <input name="_method" type="hidden" value="PUT">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label>Nama Wisata*</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Nama Wisata" value="{{ $wisata->nama }}" required/>
                                </div>
    
                                <div class="form-group">
                                    <label>Daerah*</label>
                                    <input type="text" class="form-control" name="daerah" placeholder="Daerah" value="{{ $wisata->daerah }}" required/>
                                </div>
    
                                <div class="form-group">
                                    <label>Alamat*</label>
                                    <textarea class="form-control" name="alamat" placeholder="Alamat" required>{{ $wisata->alamat }}</textarea>
                                </div>
    
                                <div class="form-group">
                                    <label>Fasilitas*</label>
                                    <textarea class="form-control" name="fasilitas" placeholder="Fasilitas" required>{{ $wisata->fasilitas }}</textarea>
                                </div>
    
                                <div class="form-group">
                                    <label>Jam Operasional*</label>
                                    <div class="input-group">
                                        <div class="col-md-6">
                                            <div class="input-group">
                                              <input type="time" class="form-control" name="jam_buka" value="{{ $wisata->jam_buka }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input type="time" class="form-control" name="jam_tutup" value="{{ $wisata->jam_tutup }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <label>Total Ulasan*</label>
                                    <input type="text" class="form-control" name="ulasan" placeholder="Total Ulasan" value="{{ $wisata->ulasan }}" required/>
                                </div>
    
                                <div class="form-group">
                                    <label>Rating*</label>
                                    <input type="text" class="form-control" name="rating" placeholder="Total Rating" value="{{ $wisata->rating }}" required/>
                                </div>
    
                                <div class="form-group">
                                    <label>Latitude*</label>
                                    <input type="text" class="form-control" name="latitude" placeholder="Latitude" value="{{ $wisata->latitude }}" required/>
                                </div>
    
                                <div class="form-group">
                                    <label>Longitude*</label>
                                    <input type="text" class="form-control" name="longitude" placeholder="Longitude" value="{{ $wisata->longitude }}" required/>
                                </div>

                                <button class="btn btn-warning" type="submit">Save</button>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('javascript')
<script src="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')  }}" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip()
        $('#date').datepicker({
            format : 'yyyy-mm-dd'
        });
    });
</script>
@endpush
