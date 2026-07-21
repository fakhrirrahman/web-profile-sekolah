<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Data PPDB Golden Sierra School</title>
    <style>
        @page {
            margin: 24px;
        }

        body {
            color: #1f2937;
            font-family: DejaVu Sans, sans-serif;
            font-size: 9.5px;
            line-height: 1.4;
        }

        h1,
        h2,
        h3,
        p {
            margin: 0;
        }

        .header {
            border-bottom: 2px solid #1f5c45;
            margin-bottom: 14px;
            padding-bottom: 10px;
        }

        .eyebrow {
            color: #b1842d;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1.6px;
            text-transform: uppercase;
        }

        .title {
            color: #1f5c45;
            font-size: 18px;
            font-weight: 700;
            margin-top: 3px;
        }

        .meta {
            color: #64748b;
            margin-top: 4px;
        }

        .data-table {
            border-collapse: collapse;
            width: 100%;
        }

        .data-table th {
            background: #1f5c45;
            color: #ffffff;
            font-size: 8px;
            letter-spacing: .7px;
            padding: 7px 5px;
            text-align: left;
            text-transform: uppercase;
        }

        .data-table td {
            border-bottom: 1px solid #d9e2dc;
            padding: 7px 5px;
            vertical-align: top;
        }

        .number {
            color: #1f5c45;
            font-weight: 700;
        }

        .muted {
            color: #64748b;
            font-size: 8.5px;
        }

        .status {
            border-radius: 12px;
            display: inline-block;
            font-size: 8px;
            font-weight: 700;
            padding: 3px 6px;
        }

        .status-baru,
        .status-tes_akademik {
            background: #eff6ff;
            color: #1d4ed8;
        }

        .status-dihubungi,
        .status-wawancara {
            background: #fffbeb;
            color: #92400e;
        }

        .status-observasi {
            background: #eef7f2;
            color: #1f5c45;
        }

        .status-lolos_berkas,
        .status-diterima {
            background: #ecfdf5;
            color: #047857;
        }

        .status-tidak_lolos_berkas,
        .status-ditolak {
            background: #fef2f2;
            color: #b91c1c;
        }

        .empty {
            border: 1px dashed #d9e2dc;
            color: #64748b;
            font-weight: 700;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <p class="eyebrow">Golden Sierra School</p>
        <h1 class="title">Laporan Data Pendaftar PPDB</h1>
        <p class="meta">Dicetak pada {{ $generatedAt->format('d M Y H:i') }} WIB</p>
    </div>

    @if ($registrations->isEmpty())
        <div class="empty">Tidak ada data pendaftar yang sesuai dengan filter.</div>
    @else
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 19%;">No. PPDB</th>
                    <th style="width: 23%;">Calon Siswa</th>
                    <th style="width: 21%;">Orang Tua/Wali</th>
                    <th style="width: 13%;">Jenjang</th>
                    <th style="width: 14%;">WhatsApp</th>
                    <th style="width: 10%;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registrations as $registration)
                    <tr>
                        <td>
                            <p class="number">{{ $registration->registration_number }}</p>
                            <p class="muted">{{ $registration->created_at->format('d M Y H:i') }}</p>
                        </td>
                        <td>
                            <p class="number">{{ $registration->student_name }}</p>
                            <p class="muted">{{ $registration->gender }}</p>
                        </td>
                        <td>{{ $registration->parent_name }}</td>
                        <td>{{ $registration->desired_grade }}</td>
                        <td>{{ $registration->phone }}</td>
                        <td>
                            <span class="status status-{{ $registration->status }}">{{ $registration->status_label }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
