

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li id="li-dashboard"><a href="{{ url('home') }}">Dashboard</a></li>
                <li id="li-wisata"><a href="{{ url('wisata')  }}">Wisata</a></li>
                <li id="li-jarak"><a href="{{ url('jarak')  }}">Jarak</a></li>
                <li id="li-list"><a href="{{ url('home/calculate')  }}">Lihat Perhitungan</a></li>
                <li id="li-print"><a class="btn-print" href="{{ url('print')  }}" target="_blank">Cetak Rekomendasi</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


@push('javascript')
<script>
    $(document).ready(function(){
        $('#li-{{ $menu  }}').addClass('active');
    });
</script>
@endpush