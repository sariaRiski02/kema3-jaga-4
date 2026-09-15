<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <title>Data Warga</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #1f2937;
            margin: 24px;
        }

        .header {
            text-align: center;
            margin-bottom: 28px;
        }

        h1 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: #111827;
        }

        .badge {
            display: inline-block;
            margin-top: 10px;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 0.3px;
        }

        .badge-dead {
            background-color: #dc2626;
            color: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #111827;
        }

        th,
        td {
            border: 1px solid #111827;
            padding: 10px 12px;
            vertical-align: top;
        }

        th {
            width: 30%;
            text-align: left;
            background-color: #f3f4f6;
            font-weight: 700;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Data warga Kema 3 Jaga 4 atas nama {{ $resident->name }}</h1>

        @if($resident->date_of_death)
            <span class="badge badge-dead">Sudah Meninggal</span>
        @endif
    </div>

    <table>

        <tr>
            <th>Nama Lengkap</th>
            <td>{{ $resident->name }}</td>
        </tr>

        <tr>
            <th>NIK</th>
            <td>{{ $resident->nik }}</td>
        </tr>

        <tr>
            <th>Tanggal Lahir</th>
            <td>{{ $resident->date_of_birth ? $resident->date_of_birth->format('d-m-Y') : '-' }}</td>
        </tr>

        <tr>
            <th>Tempat Lahir</th>
            <td>{{ $resident->place_of_birth }}</td>
        </tr>

        

        @if($resident->date_of_birth && $resident->date_of_death)

            <tr>
                <th>Tanggal Meninggal</th>
                <td>{{ $resident->date_of_death ? $resident->date_of_death->format('d-m-Y') : '-' }}</td>
            </tr>

            <tr>
                <th>Umur Saat Meninggal</th>  
                <td>
                    {{$resident->age_at_death->years . ' tahun ' . 
                        $resident->age_at_death->months . ' bulan ' . 
                        $resident->age_at_death->days . ' hari '}}
                </td>   
            </tr>
            
        @else
        
        <tr>
            <th>Umur</th>
            <td>{{ $resident->age ? $resident->age->years . ' tahun ' : '-' }}</td>
        </tr>
            
        @endif

        

        <tr>
            <th>Jenis Kelamin</th>
            <td>{{ $resident->gender ?? '-' }}</td>
        </tr>

        <tr>
            <th>Agama</th>
            <td>{{ $resident->religion ?? '-' }}</td>
        </tr>

        <tr>
            <th>Status Perkawinan</th>
            <td>{{ $resident->marital_status ?? '-' }}</td>
        </tr>

        <tr>
            <th>Pendidikan Terakhir</th>
            <td>{{ $resident->education ?? '-' }}</td>
        </tr>

        <tr>
            <th>Pekerjaan</th>
            <td>{{ $resident->occupation ?? '-' }}</td>
        </tr>

    </table>

</body>
</html>