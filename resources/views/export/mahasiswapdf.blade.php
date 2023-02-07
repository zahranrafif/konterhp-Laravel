<!DOCTYPE html>
<html>

<head>
    <title>Service</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <center>
        <h5>Laporan Pencatatan Service</h5>
        <h1>Honda Beat & Mio M3</h1>
    </center>
    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Motor</th>
                <th>Tanggal</th>
                <th>Service</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            @foreach ($mahasiswa as $mhs)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $mhs->nama }}</td>
                <td>{{ $mhs->nim }}</td>
                <td>{{ $mhs->alamat }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>