<!DOCTYPE html>
<html>
<head>
    <title>PRINT OUT</title>
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css')  }}" rel="stylesheet"/>
    <style>
        .title-center{
            text-align: center;
        }
    </style>

</head>
<body>
    <div class="kop-surat">
        <div class="title-center">
            <h2>SPK Wisata Bali</h2>
        </div>
        <hr/>
    </div>
    <br/>
    <br/>
    <br/>

    <div class="content">
        <h4 align="center">Ranking 10 Wisata Teratas</h4>
        <div class="row" style="margin-top: 30px;">
            <div class="col-md-6 col-md-offset-3">
                <table class="table table-bordered" id="ranking">
                    <thead>
                    <tr>
                        <th style="text-align: center">Wisata</th>
                        <th style="text-align: center">Nilai</th>
                        <th style="text-align: center">Jarak (km)</th>
                    </tr>
                    </thead>
                    @if ($data['v'])
                    <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach($data['v'] as $v)
                        @php
                            $parcial = explode('|',$v);
                        @endphp
                        @if($i < 10)
                        <tr>
                            <td>{{ $parcial[0] }}</td>
                            <td style="text-align: right;">
                                {{ $parcial[1]  }}
                            </td>
                            <td style="text-align: right;">
                                {{ $parcial[2]  }}
                            </td>
                        </tr>
                        @endif
                        @php
                            $i++;
                        @endphp
                    @endforeach
                    </tbody>
                    @endif
                </table>
            </div>
        </div>

    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.1.1.min.js')  }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js')  }}"></script>
    <script src="{{ asset('plugins/datatable/jquery.dataTables.min.js')  }}"></script>
    <script>
        $(document).ready(function(){
            $('#ranking').DataTable({
                aaSorting: [[1, 'desc'], [2, 'asc'], [0, 'asc']],
                bPaginate: false,
                bFilter: false,
                bInfo: false,
                columnDefs: [
                    { orderable: false, targets: 0 },
                    { orderable: false, targets: 1 },
                    { orderable: false, targets: 2 },
                ],
            });

            window.print();
        });
    </script>
</body>
</html>



