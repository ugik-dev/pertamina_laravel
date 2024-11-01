<!DOCTYPE html>
<html>

    <head>
        <title>Print</title>
        <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">

        <style>
            /* CSS untuk memberikan margin pada tabel */
            html,
            body {
                margin: 3px 10px 3px 5px;
                padding: 3px 3px 3px 3px;
                height: 100%;
            }

            body {
                font-size: 13px;
                font-family: Arial, Helvetica, sans-serif;
                display: block;
            }

            table.main {
                width: 100%;
                border-collapse: collapse;
                border: 1px solid #070707;
                /* height: calc(100% - 60px); */
                /* Mengatur tinggi tabel agar sesuai dengan tinggi viewport */
            }

            .signature {
                position: absolute;
                bottom: 0;
                width: 100%;
                text-align: left;
            }

            .signature div {
                display: flex;
                gap: 8px;
            }

            table.no-border {
                border-collapse: collapse;
                border: none;
            }

            .no-border td,
            .no-border th {
                border: none;
                padding-bottom: 2px;
                padding-right: 2px;
            }

            .no-border2 td,
            .no-border2 th {
                border: none;
                padding-bottom: 1px;
                padding-right: 1px;
            }

            table {
                margin: 2px;
                border-collapse: collapse;
                border: 0px solid #070707;
            }

            th,
            td {
                border-collapse: collapse;
                border: 1px solid #070707;
                padding: 5px;
                text-align: left;
                vertical-align: top;
            }

            th {
                /* background-color: #f2f2f2; */
            }

            .text-center {
                text-align: center;
                /* text-align: top; */
            }

            .text-underline {
                text-decoration: underline;
                /* text-align: top; */
            }

            .form-check {
                display: flex;
                align-items: center;
            }

            .form-check-input {
                margin-right: 10px;
            }

            .break-5 {
                line-height: 5px;
            }

            .background-image,
            .front-image {
                width: 370px !important;
                height: 370px;
                background-repeat: no-repeat;
            }

            .background-image {
                background-image: url('{{ public_path('assets/img/anotomi-tubuh.png') }}');
                top: 0;
                left: 0;
                background-size: contain;
                background-position: center center;
            }

            .front-image {
                background-image: url('');
                position: absolute;
                top: 0;
                left: 0;
                background-size: contain;
                background-position: center center;
            }

            .fill-space {
                height: 100%;
            }

            .fill-remaining {
                height: 10px;
            }

            .break-5 {
                line-height: 5px;
            }

            .page_break {
                page-break-before: always;
            }

            /* Menyesuaikan tinggi untuk baris yang harus memenuhi sisa ruang */
            .fill-remaining td {
                vertical-align: top;
            }

            /* Menyesuaikan tinggi untuk baris tanda tangan */
            .signature-row td {
                /* height: auto; */
                margin-bottom: 0px !important;
                padding-bottom: 0px !important;
                margin-top: 0px !important;
                padding-top: 0px !important
            }

            .label {
                font-weight: bold;
                text-decoration: underline;
                display: inline-block;
                width: 800px;
                margin-bottom: 5px;
                /* Sesuaikan dengan lebar label yang diinginkan */
                vertical-align: top;
            }

            .value {
                display: inline-block;
                margin-left: 100px;
                margin-bottom: 15px;
                min-height: 50px
            }

            .table-row {
                margin-bottom: 10px;
            }

            .container {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                /* Jarak antara kotak */
                justify-content: space-between;
                /* Atur posisi kotak dalam baris */
            }

            .box {
                width: 20px;
                height: 20px;
                border: 1px solid #000000;
                color: rgb(0, 0, 0);
                text-align: center;
                vertical-align: middle;
                line-height: 14px;
                font-size: 14px;
                font-weight: bold;
            }
        </style>
    </head>
    @php

        // Function to convert an integer to a Roman numeral
        function intToRoman($num)
        {
            // Mapping of integers to Roman numeral symbols
            $value = [1000, 900, 500, 400, 100, 90, 50, 40, 10, 9, 5, 4, 1];
            $symbol = ['M', 'CM', 'D', 'CD', 'C', 'XC', 'L', 'XL', 'X', 'IX', 'V', 'IV', 'I'];

            $roman = '';

            // Loop through the values
            for ($i = 0; $num > 0; $i++) {
                while ($num >= $value[$i]) {
                    $roman .= $symbol[$i]; // Append the corresponding Roman numeral symbol
                    $num -= $value[$i]; // Subtract the value from the number
                }
            }

            return $roman;
        }

        use Carbon\Carbon;

        // Format tanggal dikirim
        $tanggalDikirim = Carbon::parse($dataForm->created_at);
        $formattedTanggalDikirim = $tanggalDikirim->format('d F Y');

        // Menghitung umur
        $tanggalLahir = Carbon::parse($dataForm->pasien->dob);
        $umur = $tanggalLahir->age; // Umur dalam tahun
        $bulanLahir = $tanggalLahir->month;
        $bulanSekarang = Carbon::now()->month;
        $bulan = $bulanSekarang - $bulanLahir;
        $tahun = $umur;

        if ($bulan < 0) {
            $bulan += 12;
            $tahun--;
        }

        $lorem = "
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, hic suscipit mollitia asperiores
                    voluptatibus tenetur eveniet ullam error fuga magni, temporibus ab dolores est ex pariatur dicta
                    voluptas! Ab, necessitatibus!
                    Et quo dolore aspernatur voluptas, est blanditiis sint aperiam placeat modi exercitationem nesciunt
                    animi quia ipsa natus nulla perferendis odio corrupti vel ad tenetur recusandae earum autem quasi!
                    Eligendi, nam!
                    Laboriosam consequuntur facere qui quidem molestiae officia quam perferendis. Architecto quam sint, est,
                    molestiae vero quibusdam id aliquam consectetur repellendus error veritatis esse animi voluptates
                    voluptatibus, facere nemo aspernatur fugiat.";
        $lorem = '';
    @endphp

    <body>
        <table class="main no-border">
            <tr>
                <td colspan="2" rowspan="1" class="" width="500px" style="font-size: 12; border-bottom: 0px ">
                    <table class="no-border" style="width: 100%">
                        <tr>
                            <td style="vertical-align: center;">
                                <img style="width: 140px;" src="{{ public_path('assets/img/logo2.png') }}" />
                            </td>
                            <td style="vertical-align: top; text-align: right"> <!-- Gunakan vertical-align: top -->
                                <p style="margin-right:20px; margin-top: 1px;"><b>No.
                                        {{ str_pad($dataForm->no_poli, 5, '0', STR_PAD_LEFT) }}</b></p>
                            </td>
                        </tr>
                    </table>

                    <div style=" padding-top:20px !important" class="text-center">
                        <span style="font-weight: bold; font-size:15;">KLINIK
                            PERTAMINA<br></span>
                        <span style="font-weight: bold; font-size:12;">Salinan Resep</span>
                    </div>

                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr style="height: 3px; background-color: black;border: none; ">
                </td>
            </tr>
            <tr>

                <td colspan="2" style="font-weight: bold; font-size:12;">Dr. : {{ $dataForm->doctor->name }}
                </td>
            </tr>
            <tr>
                <td colspan="2" style="padding-bottom: 0px ; margin-bottom: 0px">
                    {{-- <p style="font-size: 24px; font-family: 'Great Vibes', cursive;"> --}}
                    <sup
                        style="font-size: 24px; font-family: 'Great Vibes', cursive;font-size: 20px; position: relative; top: 1px; letter-spacing: -2px; margin-right: -6px;">R/</sup>
                    {{-- </p> --}}
                </td>
            </tr>
            <tr>
                <td colspan="2" class="fill-remaining">
                    <table style="width: 100%; padding-top : 0px; margin-top : 0px">
                        @foreach ($dataForm->drugs as $drug)
                            <tr>
                                <td style="width: 80%">{{ $drug->drug->nama_obat }} {{ $drug->drug_qyt }}
                                    {{ $drug->drug->satuan }}</td>
                                <td style="width: 20%; text-align:right">No {{ intToRoman($drug->drug_number) }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <sup style="font-size: 15px; font-family: 'Great Vibes', cursive">S</sup>
                                    {{ $drug->signatura }}<br>
                                    <hr>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </td>
            </tr>

            <tr class="signature-row" style="border-top: 1px;">
                <td colspan="2" class="signature text-center" style="border-top: 1px; padding-left:0px">
                    <table class="no-border2" style="font-size: 11px!important">
                        <tr>
                            <td colspan="3">
                                <hr style="height: 1px; background-color: black;border: none; ">
                                <hr style="height: 1px; background-color: black;border: none; ">
                            </td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{ $dataForm->pasien->name }}</td>
                        </tr>
                        <tr>
                            <td>Tgl. Lahir - L/P</td>
                            <td>:</td>
                            <td>{{ $formattedTanggalDikirim }} -
                                {{ $dataForm->pasien->gender == 'L' ? 'Laki-laki' : ($dataForm->pasien->gender == 'P' ? 'Perempuan' : '') }}
                            </td>
                        </tr>
                        <tr>
                            <td>Umur</td>
                            <td>:</td>
                            <td>{{ $tahun }} tahun {{ $bulan }} bulan</td>
                        </tr>
                        <tr>
                            <td>A/I/Tanggungan dari</td>
                            <td>:</td>
                            <td> {{ $dataForm->ia_dari ?? '.................................................' }}</td>
                        </tr>
                        <tr>
                            <td>No Pekerja/Pensiun</td>
                            <td>:</td>
                            <td>{{ $dataForm->pasien->empoyee_id }}</td>
                        </tr>
                        <tr>
                            <td>Bagian</td>
                            <td>:</td>
                            <td>{{ $dataForm->pasien->company->name }} - {{ $dataForm->pasien->unit->name }}</td>
                        </tr>
                        <tr>
                            <td>Tgl. Kunjung</td>
                            <td>:</td>
                            <td> {{ \Carbon\Carbon::parse($dataForm->created_at)->format('Y-m-d h:i') }}</td>
                        </tr>
                    </table>
                </td>
                {{-- <td colspan="2" class="signature text-center" style="border-top: 1px; padding-left:0px">
                    <hr>
                    <div>Tanda tangan dokter pengirim:</div>
                    <br><br><br><br><br>
                    <div>{{ $dataForm->doctor->name }}</div>
                </td> --}}
            </tr>
        </table>
    </body>

</html>
