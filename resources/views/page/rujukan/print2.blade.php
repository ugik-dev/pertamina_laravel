<!DOCTYPE html>
<html>

    <head>
        <title>Print</title>
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
                height: 700px;
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
                height: auto;
                margin-bottom: 30px !important;
                padding-bottom: 30px !important
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
        <table class="main">
            <tr>
                <td width="50px" rowspan="6" style="vertical-align: bottom">KES 29 </td>
                <td colspan="2" class="text-center" width="500px" style="font-size: 10">
                    <table class="no-border">
                        <tr class="no-border">
                            <td class="no-border">Nama Pasien</td>
                            <td class="no-border">:</td>
                            <td class="no-border">{{ $dataForm->pasien->name }}</td>
                        </tr>
                        <tr class="no-border">
                            <td class="no-border">I/A dari</td>
                            <td class="no-border">:</td>
                            <td class="no-border">
                                {{ $dataForm->ia_dari ?? '.................................................' }}
                            </td>
                        </tr>
                        <tr class="no-border">
                            <td class="no-border">Tgl. Lahir</td>
                            <td class="no-border">:</td>
                            <td>{{ $formattedTanggalDikirim }}</td>
                        </tr>
                        <tr class="no-border">
                            <td class="no-border">Umur</td>
                            <td class="no-border">:</td>
                            <td>{{ $tahun }} tahun {{ $bulan }} bulan</td>
                        </tr>
                        <tr class="no-border">
                            <td class="no-border">Jenis Kelamin</td>
                            <td class="no-border">:</td>
                            <td class="no-border">
                                {{ $dataForm->pasien->gender == 'L' ? 'Laki-laki' : ($dataForm->pasien->gender == 'P' ? 'Perempuan' : '') }}
                            </td>
                        </tr>
                    </table>
                </td>
                <td colspan="2" rowspan="1" class="text-center" width="500px"
                    style="font-size: 12; border-bottom: 0px ">
                    <div style=" padding-top:20px !important">
                        <img style="width: 200px; " src="{{ public_path('assets/img/logo2.png') }}" />
                    </div>
                    <div style=" padding-top:20px !important">
                        <span style="font-weight: bold; font-size:15;">KLINIK
                            PERTAMINA</span>
                    </div>

                </td>
            </tr>
            <tr>
                <td colspan="2">No. Poli/RS<br> Pengirim : {{ $dataForm->no_poli }}
                </td>
                <td colspan="2" class="text-center" style="border-top: 0px; ">
                    <span style="font-weight: bold !important">SURAT PERMINTAAN KONSULTASI</span>
                </td>
            </tr>
            <tr>
                <td>Kepada RS/Dokter:
                    <br>{{ $dataForm->tujuan }}
                </td>
                <td>Nama dokter pengirim:
                    <br>{{ $dataForm->doctor->name }}
                </td>
                <td>Biaya atas beban
                    <br>{{ $dataForm->atas_beban }}
                </td>
                <td>Tgl. Dikirim
                    <br> {{ \Carbon\Carbon::parse($dataForm->created_at)->format('Y-m-d h:i') }}
                </td>
            </tr>
            <tr>
                <td>Nama & hubungan keluarga penanggung:
                    <br>{{ $dataForm->relation_desc ?? 'Pekerja' }}
                </td>
                <td>Pekerjaan:
                    <br>{{ $dataForm->pasien->company->name }} - {{ $dataForm->pasien->unit->name }}
                </td>
                <td>No. Pekerja
                    <br>{{ $dataForm->pasien->empoyee_id }}
                </td>
                <td>Golongan
                </td>
            </tr>
            <tr style="border-bottom: 1px;">

                <td colspan="4" class="fill-remaining" style="border-bottom: 1px;">
                    <div class="table-cell">
                        <div class="table-row">
                            <span class="label">Diagnosis:</span>
                            <span class="value">{{ $dataForm->diagnosis }} {{ $lorem }}</span>
                        </div>
                        <div class="table-row">
                            <span class="label">Ikhtisar klinik singkat:</span>
                            <span class="value">{{ $dataForm->ikhtisar }} </span>
                        </div>
                        <div class="table-row">
                            <span class="label">Pengobatan yang telah diberikan:</span>
                            <span class="value">{{ $dataForm->pengobatan_diberikan }} {{ $lorem }}</span>
                        </div>
                        <div class="table-row">
                            <span class="label">Konsultasi yang diminta:</span>
                            <span class="value">{{ $dataForm->konsultasi_diminta }} {{ $lorem }}</span>
                        </div>
                    </div>
                </td>
            </tr>
            <tr class="signature-row" style="border-top: 1px;">
                <td colspan="4" class="signature text-center" style="border-top: 1px; padding-left:400px">
                    <div>Tanda tangan dokter pengirim:</div>
                    <br><br><br><br><br>
                    <div>{{ $dataForm->doctor->name }}</div>
                </td>
            </tr>

        </table>

        <table class="main">
            <tr>
                <td width="50px" rowspan="6" style="vertical-align: bottom">KES 29 </td>
                <td colspan="2" class="text-center" width="500px" style="font-size: 10">
                    <table class="no-border">
                        <tr class="no-border">
                            <td class="no-border">Nama Pasien</td>
                            <td class="no-border">:</td>
                            <td class="no-border">{{ $dataForm->pasien->name }}</td>
                        </tr>
                        <tr class="no-border">
                            <td class="no-border">I/A dari</td>
                            <td class="no-border">:</td>
                            <td class="no-border"> .................................................</td>
                        </tr>
                        <tr class="no-border">
                            <td class="no-border">Tgl. Lahir</td>
                            <td class="no-border">:</td>
                            <td>{{ $formattedTanggalDikirim }}</td>
                        </tr>
                        <tr class="no-border">
                            <td class="no-border">Umur</td>
                            <td class="no-border">:</td>
                            <td>{{ $tahun }} tahun {{ $bulan }} bulan</td>
                        </tr>
                        <tr class="no-border">
                            <td class="no-border">Jenis Kelamin</td>
                            <td class="no-border">:</td>
                            <td class="no-border">
                                {{ $dataForm->pasien->gender == 'L' ? 'Laki-laki' : ($dataForm->pasien->gender == 'P' ? 'Perempuan' : '') }}
                            </td>
                        </tr>
                    </table>
                </td>
                <td colspan="2" rowspan="1" class="text-center" width="500px"
                    style="font-size: 12; border-bottom: 0px ">
                    <div style=" padding-top:20px !important">
                        <img style="width: 200px; " src="{{ public_path('assets/img/logo2.png') }}" />
                    </div>
                    <div style=" padding-top:20px !important">
                        <span style="font-weight: bold; font-size:15;">KLINIK
                            PERTAMINA</span>
                    </div>

                </td>
            </tr>
            <tr>
                <td colspan="2" style="width: 100%; border-collapse: collapse;">
                    <table class="no-border">
                        <tr>
                            <td colspan="2">
                                <table border=1 style="border:1px solid " width="100%">
                                    <tr style="border:1px solid ">
                                        @for ($i = 0; $i <= 10; $i++)
                                            <td style="border:1px solid " class="box"></td>
                                        @endfor
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
                <td colspan="2" class="text-center" style="border-top: 0px"> <span
                        style="font-weight: bold !important">SURAT JAWABAN KONSULTASI</span>

                </td>
            </tr>
            <tr>
                <td>Kepada dokter pengirim:
                    <br>{{ $dataForm->doctor->name }}
                </td>
                <td>Nama dokter konsultan:
                </td>
                <td colspan="2">No. MR :<br>RS/Poli : <br>Konsulen :
                </td>
            </tr>
            <tr>
                <td>No. Pekerja
                    <br>{{ $dataForm->pasien->empoyee_id }}
                </td>
                <td>Pekerjaan:
                    <br>{{ $dataForm->pasien->company->name }} - {{ $dataForm->pasien->unit->name }}
                </td>
                <td>Golongan:
                </td>
                <td>Tgl. Jawaban dikembalikan :
                </td>
            </tr>
            <tr style="border-bottom: 1px;">

                <td colspan="4" class="fill-remaining" style="border-bottom: 1px;">

                </td>
            </tr>
            <tr class="signature-row" style="border-top: 1px;">
                <td colspan="4" class="signature text-center" style="border-top: 1px; padding-left:400px">
                    <div>Tanda tangan dokter pengirim:</div>
                    <br><br><br><br><br>
                    <hr>
                    <span
                        style="
                         left: 0 !important;
                            bottom: 0 !important;
                             text-align: left !important;">
                    </span>
                </td>
            </tr>

        </table>
    </body>

</html>
