<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Export Kartu Keluarga</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            margin: 0;
            padding: 18px;
            color: #111827;
            background: #ffffff;
        }

        .document {
            width: 100%;
            border: 1px solid #d1d5db;
            background: #ffffff;
        }

        .header {
            text-align: center;
            padding: 20px 20px 10px;
            border-bottom: 2px solid #e5e7eb;
        }

        .title {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin: 0;
        }

        .subtitle {
            font-size: 13px;
            margin-top: 4px;
            color: #374151;
        }

        .meta {
            display: table;
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        .meta-row {
            display: table-row;
        }

        .meta-label,
        .meta-value {
            display: table-cell;
            padding: 10px 12px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }

        .meta-label {
            width: 35%;
            font-weight: 700;
            color: #374151;
            background: #f9fafb;
        }

        .meta-value {
            background: #ffffff;
        }

        .section-title {
            font-size: 15px;
            font-weight: 700;
            margin: 18px 0 8px;
            color: #111827;
        }

        .table-wrap {
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th, td {
            border: 1px solid #d1d5db;
            padding: 9px 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #f3f4f6;
            font-weight: 700;
        }

        .family-title {
            font-size: 24px;
            font-weight: 700;
            text-align: center;
            margin-top: 8px;
            margin-bottom: 14px;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.3px;
            background: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }
    </style>
</head>
<body>
    <div class="document">
        <div class="header">
            <div class="title">KARTU KELUARGA</div>
            <div class="subtitle">Data keluarga desa Kema 3 - Jaga 4</div>
            <div class="family-title">{{ $family->family_number }}</div>
        </div>

        <div class="meta">
            <div class="meta-row">
                <div class="meta-label">Kepala Keluarga</div>
                <div class="meta-value">{{ $family->headFamily?->resident?->name ?? 'Belum tersedia' }}</div>
            </div>
            <div class="meta-row">
                <div class="meta-label">NIK Kepala Keluarga</div>
                <div class="meta-value">{{ $family->headFamily?->resident?->nik ?? 'Belum tersedia' }}</div>
            </div>
            <div class="meta-row">
                <div class="meta-label">Jumlah Anggota</div>
                <div class="meta-value">{{ $family->familyRelationships->count() }} orang</div>
            </div>
            <div class="meta-row">
                <div class="meta-label">Status</div>
                <div class="meta-value"><span class="status-badge">Aktif</span></div>
            </div>
        </div>

        <div class="section-title">Daftar Anggota Keluarga</div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Nama</th>
                        <th style="width: 20%;">NIK</th>
                        <th style="width: 15%;">Hubungan</th>
                        <th style="width: 15%;">Jenis Kelamin</th>
                        <th style="width: 20%;">TTL</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($family->familyRelationships as $index => $relationship)
                        @php $resident = $relationship->resident; @endphp
                        @if (! $resident)
                            @continue
                        @endif
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $resident->name }}</td>
                            <td>{{ $resident->nik }}</td>
                            <td>{{ $relationship->family_relationship }}</td>
                            <td>{{ $resident->gender ?? '-' }}</td>
                            <td>
                                {{ $resident->place_of_birth ?? '-' }}
                                @if ($resident->date_of_birth)
                                    , {{ $resident->date_of_birth->translatedFormat('d F Y') }}
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 18px; color: #6b7280;">Belum ada anggota keluarga.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
