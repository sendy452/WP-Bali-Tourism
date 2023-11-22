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
                    <div class="panel-heading">Perhitungan</div>

                    <div class="panel-body">
                        <!-- Weight -->
                        <h3>Bobot</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="weight">
                                <thead>
                                    <tr>
                                        <th>
                                            Kriteria
                                        </th>
                                        <th>
                                            Bobot
                                        </th>
                                    </tr>
                                </thead>
                                @if ($data['weight'])
                                <tbody>
                                    @foreach($kriteria as $k)
                                    <tr>
                                        <td>{{ $k->nama }}</td>
                                        <td>{{ $data['weight'][$k->id] }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                @endif
                            </table>
                        </div>
                        <!-- Weight -->

                        <!-- S-->
                        <h3>Nilai S</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="svalue">
                                <thead>
                                <tr>
                                    <th>
                                        Wisata
                                    </th>
                                    <th>
                                        Nilai S
                                    </th>
                                </tr>
                                </thead>
                                @if ($data['s'])
                                <tbody>
                                @foreach($wisata as $p)
                                    <tr>
                                        <td>{{ $p->nama }}</td>
                                        <td>
                                            @foreach($data['s'] as $d)


                                                @if($p->id == $d['wisata'])
                                                    {{ $d['s'] }}&nbsp;
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                @endif
                            </table>
                        </div>
                        <!-- S-->

                        <!-- V -->
                        <h3>Nilai V</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="vector">
                                <thead>
                                <tr>
                                    <th>
                                        Wisata
                                    </th>
                                    <th>
                                        Nilai V
                                    </th>
                                </tr>
                                </thead>
                                @if ($data['v'])
                                <tbody>
                                @foreach($wisata as $p)
                                    <tr>
                                        <td>{{ $p->nama }}</td>
                                        <td>
                                            @if(array_key_exists($p->id, $data['v']))
                                                {{ $data['v'][$p->id]  }}
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                @endif
                            </table>
                        </div>
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
        $('#weight').DataTable({
            aaSorting: [[1, 'desc']],
            search : false
        });
        $('#svalue').DataTable({
            aaSorting: [[1, 'desc']],
            search : false
        });
        $('#vector').DataTable({
            aaSorting: [[1, 'desc']],
            search : false
        });
    });
</script>
@endpush

