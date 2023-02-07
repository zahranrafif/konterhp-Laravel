<!DOCTYPE html>
<html>

<head>

    <title>Data Service</title>

    <!-- Scripts -->
    <!--@vite(['resources/sass/app.scss', 'resources/js/app.js']) -->

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Home') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/mahasiswa">Data Service</a>
                    </li>
                </ul>


                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</head>

<body>
    <div class="container mt-5">
        @if (session('Sukses'))
        <div class="alert alert-success" role="alert">
            {{ session('Sukses') }}
        </div>
        @endif
        <center>
            <h1 class="pt-1">Data Service Motor</h1>
            <p>Honda Beat & Yamaha Mio M3</p>
        </center>

        <div class="row">
            <div class="col-4 my-4" align="left">
                <a href="/mahasiswa/exportpdf" class="btn btn-outline-success">Export PDF</a>
            </div>

            <!-- {{--form search data--}} -->
            <div class="col-4 my-4" align="center">
                @csrf
                <form class="d-flex" action="/mahasiswa/cari" method="GET">
                    <input class="form-control me-2" type="text" name="cari" placeholder="Search" value="{{ old('cari') }}">
                    <button class="btn btn-outline-success" type="submit">Cari</button>
                </form>

                <!--{{-- pemberitahuan jika data tidak ditemukan --}} -->
                @if ($data_mahasiswa->count() > 0)
                @else
                <center>
                    <font color="red">
                        <br>
                        <h4>Tidak ditemukan data yang sesuai !!</h4>
                    </font>
                </center>
                @endif
            </div>

            <div class="col-4 my-4" align="right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Tambah Data
                </button>

            </div>

            <table class="table table-hover">
                <thead>
                </thead>
            </table>


            <div class="table-responsive">
                <table class="table table-light table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th>Motor</th>
                            <th>Tanggal</th>
                            <th>Service</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @php
                    $nomor = 1 + (($data_mahasiswa->currentPage()-1) * $data_mahasiswa->perPage());
                    @endphp
                    @foreach ($data_mahasiswa as $mahasiswa)
                    <tbody>
                        <tr>
                            <td>{{ $nomor++ }}</td>
                            <!-- <td>{{ $mahasiswa->id }}</td> -->
                            <td>{{ $mahasiswa->nama }}</td>
                            <td>{{ $mahasiswa->nim }}</td>
                            <td>{{ $mahasiswa->alamat }}</td>
                            <td>
                                <a href="/mahasiswa/{{$mahasiswa->id}}/edit" class="btn btn-warning">Edit</a>
                                <a href="/mahasiswa//delete/{{$mahasiswa->id}}" class="btn btn-danger bgn-sm" onclick="return confirm('Yakin Mau Dihapus?')">Hapus</a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            Current Page: {{ $data_mahasiswa->currentPage() }}<br>
            Jumlah Data: {{ $data_mahasiswa->total() }}<br>
            Data perhalaman: {{ $data_mahasiswa->perPage() }}<br>
            <br>
            <div class="pull-right">
                {{ $data_mahasiswa->links() }}
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Input data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('add.mhs') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Motor</label>
                                <input name="nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="EmailHelp" placeholder="Merk Motor">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Service</label>
                                <input name="nim" type="date" class="form-control" id="exampleInputEmail1" aria-describedby="" placeholder="02 Februari 2023">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Keterangan Service</label>
                                <textarea name="alamat" type="text" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Keterangan Hasil Service"></textarea>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
        </script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>

</html>