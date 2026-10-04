<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Jurnal Pembelajaran</title>

    <style>
        @page {
            size: A4 landscape;
            margin: 15mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 9px;
            color: #111827;
        }

        /* =========================
           HEADER
        ========================= */

        .header {
            text-align: center;
            margin-bottom: 15px;
        }

        .school-name {
            font-size: 15px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .title {
            margin-top: 4px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .academic-year {
            margin-top: 3px;
            font-size: 10px;
        }

        /* =========================
           IDENTITAS
        ========================= */

        .identity {
            width: 100%;
            margin-bottom: 12px;
        }

        .identity td {
            padding: 2px 0;
            vertical-align: top;
        }

        .identity .label {
            width: 100px;
            font-weight: bold;
        }

        /* =========================
           TABEL JURNAL
        ========================= */

        table.journal {
            width: 100%;
            border-collapse: collapse;
        }

        table.journal th,
        table.journal td {
            border: 1px solid #374151;
            padding: 5px;
            vertical-align: top;
        }

        table.journal th {
            text-align: center;
            font-weight: bold;
            background: #f3f4f6;
        }

        .center {
            text-align: center;
        }

        .attendance {
            line-height: 1.5;
            white-space: nowrap;
        }

        /* =========================
           TANDA TANGAN
        ========================= */

        .signature {
            width: 100%;
            margin-top: 30px;
        }

        .signature td {
            width: 50%;
            text-align: center;
            vertical-align: top;
        }

        .signature-space {
            height: 60px;
        }

        .signature-name {
            font-weight: bold;
        }

        .signature-nip {
            margin-top: 3px;
        }
    </style>
</head>

<body>

    {{-- =========================
    HEADER
    ========================= --}}

    <div class="header">

        <div class="school-name">
            {{ $school ?? '-' }}
        </div>

        <div class="title">
            Jurnal Pembelajaran
        </div>

        <div class="academic-year">
            Tahun Pelajaran {{ $academicYear ?? '-' }}
        </div>

    </div>


    {{-- =========================
    IDENTITAS
    ========================= --}}

    <table class="identity">

        <tr>
            <td class="label">Nama Guru</td>
            <td>: {{ $teacher ?? '-' }}</td>

            <td class="label">Kelas</td>
            <td>: {{ $class ?? '-' }}</td>
        </tr>

        <tr>
            <td class="label">NIP</td>
            <td>: {{ $nip ?? '-' }}</td>

            <td class="label">Mata Pelajaran</td>
            <td>: {{ $subject?? '-' }}</td>
        </tr>

        <tr>
            <td class="label">Semester</td>
            <td>: {{ $semester ?? '-' }}</td>

            <td class="label">Ruangan</td>
            <td>: {{ $room ?? '-' }}</td>
        </tr>

    </table>


    {{-- =========================
    TABEL JURNAL
    ========================= --}}

    <table class="journal">

        <thead>

            <tr>
                <th style="width: 4%;">No.</th>
                <th style="width: 10%;">Tanggal</th>
                <th style="width: 10%;">Jam</th>
                <th style="width: 15%;">Materi Pembelajaran</th>
                <th style="width: 20%;">Kegiatan Pembelajaran</th>
                <th style="width: 13%;">Penilaian</th>
                <th style="width: 13%;">Kehadiran</th>
                <th style="width: 15%;">Catatan</th>
            </tr>

        </thead>

        <tbody>

            @foreach ($journals as $index => $journal)

                @php
                    $attendances = $journal->attendances->groupBy('status');

                    $hadir = $attendances->get('hadir', collect())->count();
                    $sakit = $attendances->get('sakit', collect())->count();
                    $izin = $attendances->get('izin', collect())->count();
                    $alpa = $attendances->get('alpa', collect())->count();
                @endphp

                <tr>

                    {{-- NO --}}
                    <td class="center">
                        {{ $index + 1 }}
                    </td>

                    {{-- TANGGAL --}}
                    <td class="center">
                        {{ $journal->date?->format('d/m/Y') }}
                    </td>

                    {{-- JAM --}}
                    <td class="center">
                        {{ $journal->start_time?->format('H:i') }}
                        -
                        {{ $journal->end_time?->format('H:i') }}
                    </td>

                    {{-- MATERI --}}
                    <td>
                        {{ $journal->material ?: '-' }}
                    </td>

                    {{-- KEGIATAN --}}
                    <td>
                        {{ $journal->activities ?: '-' }}
                    </td>

                    {{-- PENILAIAN --}}
                    <td>
                        {{ $journal->assessment ?: '-' }}
                    </td>

                    {{-- KEHADIRAN --}}
                    <td class="attendance">
                        H : {{ $hadir }}<br>
                        S : {{ $sakit }}<br>
                        I : {{ $izin }}<br>
                        A : {{ $alpa }}
                    </td>

                    {{-- CATATAN --}}
                    <td>
                        {{ $journal->notes ?: '-' }}
                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>


    {{-- =========================
    TANDA TANGAN
    ========================= --}}

    <table class="signature">

        <tr>

            <td>
                Guru Mata Pelajaran

                <div class="signature-space"></div>

                <div class="signature-name">
                    {{ $teacher ?? '-' }}
                </div>

                <div class="signature-nip">
                    NIP. {{ $nip ?? '____________________' }}
                </div>
            </td>


            <td>
                Mengetahui,<br>
                Kepala Sekolah

                <div class="signature-space"></div>

                <div class="signature-name">
                    __________________________
                </div>

                <div class="signature-nip">
                    NIP. ______________________
                </div>
            </td>

        </tr>

    </table>

</body>

</html>