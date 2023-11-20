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
                        <li>{{ $err }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif

                @include('component.alert')

                <div class="panel panel-default">
                    <div class="panel-heading">{{ $title }}</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <button class="btn btn-success" data-toggle="modal" href="#create">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                                Tambah Wisata
                            </button>
                        </div>
			<div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Daerah</th>
                                    <th>Alamat</th>
                                    <th>Fasilitas</th>
                                    <th>Jam Operasional</th>
                                    <th>Ulasan</th>
                                    <th>Rating</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index=1;
                                @endphp
                                @foreach($wisata as $c)
                                <tr>
                                    <td>{{ (($wisata->currentPage() - 1 ) * $wisata->perPage() ) + $loop->iteration }}</td>
                                    <td>{{ $c->nama  }}</td>
                                    <td>{{ $c->daerah  }}</td>
                                    <td>{{ $c->alamat }}</td>
                                    <td>{{ $c->fasilitas  }}</td>
                                    <td>{{ date("H:i", strtotime($c->jam_buka)) .' - '. date("H:i", strtotime($c->jam_tutup))  }}</td>
                                    <td>{{ $c->ulasan  }}</td>
                                    <td>{{ $c->rating  }}</td>
                                    <td>
                                        <a href="{{  url('wisata',['id' => $c->id]) }}"><button class="btn btn-info" data-toggle="tooltip" data-placement="bottom" title="lihat data"><span class="glyphicon glyphicon-eye-open"></span> </button></a>
                                        <a href="{{  url()->route('wisata.edit', ['id' => $c->id])}}"><button class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="ubah data"><span class="glyphicon glyphicon-pencil"></span> </button></a>
                                        <a href="{{  url()->route('nilai.create',['penerima' => $c->id]) }}"><button class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="penilaian"><span class="glyphicon glyphicon-ok"></span> </button></a>
                                        <a href="#"data-id="{{ $c->id  }}" class="destroy"><button class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="hapus data"><span class="glyphicon glyphicon-trash"></span> </button></a>
                                    </td>
                                </tr>
                                @php
                                    $index++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
			</div>
                        {{ $wisata->links()  }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Create-->
    <div class="modal fade" id="create" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="post" action="{{ url('wisata')  }}">
                    {{ csrf_field()  }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Tambah Wisata</h4>
                    </div>
                    <div class="modal-body">
                        <div class="create-form">
                            <div class="form-group">
                                <label>Nama Wisata*</label>
                                <input type="text" class="form-control" name="nama" placeholder="Nama Wisata" required/>
                            </div>

                            <div class="form-group">
                                <label>Daerah*</label>
                                <select class="form-control" id="daerah" name="daerah" required>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Alamat*</label>
                                <textarea class="form-control" name="alamat" placeholder="Alamat" required></textarea>
                            </div>

                            <div class="form-group">
                                <label>Fasilitas*</label>
                                <textarea class="form-control" name="fasilitas" placeholder="Fasilitas" required></textarea>
                            </div>

                            <div class="form-group">
                                <label>Jam Operasional*</label>
                                <div class="input-group">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                          <input type="time" class="form-control" name="jam_buka" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="time" class="form-control" name="jam_tutup" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Total Ulasan*</label>
                                <input type="number" class="form-control" pattern="[0-9]+" name="ulasan" placeholder="Total Ulasan" required/>
                            </div>

                            <div class="form-group">
                                <label>Rating*</label>
                                <input type="text" class="form-control" pattern="[0-9]+(\.[0-9][0-9]?)?" name="rating" placeholder="Total Rating" required/>
                            </div>

                            <div class="form-group">
                                <label>Latitude*</label>
                                <input type="text" class="form-control" name="latitude" placeholder="Latitude" required/>
                            </div>

                            <div class="form-group">
                                <label>Longitude*</label>
                                <input type="text" class="form-control" name="longitude" placeholder="Longitude" required/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Modal Create-->

    <!--Modal Delete-->
    <div class="modal fade" id="hapus" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <form method="post" id="post_delete" action="#">
                    <input type="hidden" name="_method" value="DELETE" >
                    <div class="modal-header">
                        <div class="modal-title">
                            <h4>Dialog konfirmasi</h4>
                        </div>
                    </div>
                    <div class="modal-body">
                        <strong>
                            Apakah anda benar-benar ingin menghapus data ini ?
                        </strong>
                        {{ csrf_field()  }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-danger" value="Hapus"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Modal Delete-->
@endsection

@push('javascript')
    <script src="{{ asset('plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')  }}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip()
            $('#date').datepicker({
                format : 'yyyy-mm-dd'
            });
            $('.destroy').on('click', function(){
                var id = $(this).data('id');
                $('#post_delete').attr('action','{{  url('wisata')  }}/' + id);
                $('#hapus').modal('show');
            });
        });

        const daerah = document.getElementById("daerah");
        const getPost = async () => {
            const response = await fetch("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/51.json");
            const data = response.json();
            return data;
        };

        const displayOption = async () => {
            const options = await getPost();
            options.forEach(option => {
                const newOption = document.createElement("option");
                newOption.value = option.name;
                newOption.text = option.name;
                daerah.appendChild(newOption);
            });
        };
        displayOption();
    </script>
@endpush
