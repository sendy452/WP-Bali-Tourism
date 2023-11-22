<!DOCTYPE html>
<html>
<head>
    <title></title>
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
        <h4 align="center">Ranking Wisata</h4>
        <div class="row" style="margin-top: 30px;">
            <div class="col-md-6 col-md-offset-3">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th style="text-align: center">Wisata</th>
                        <th style="text-align: center">Nilai</th>
                    </tr>
                    </thead>
                    @if ($data['v'])
                    <tbody>
                    @foreach($data['v'] as $v)
                        @php
                            $parcial = explode('|',$v)
                        @endphp
                        <tr>
                            <td>{{ $parcial[0] }}</td>
                            <td style="text-align: right;">
                                {{ $parcial[1]  }}
                            </td>
                        </tr>
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
    <script>
        $(document).ready(function(){
            window.print();
        });
    </script>
</body>
</html>



