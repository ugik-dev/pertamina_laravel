<!DOCTYPE html>
<html>
    <?php
    // $imageBinary = base64_encode($dataForm->gambar);
    // $imageSrc = 'storage/upload/tindakan/' . $dataForm->gambar;
    ?>

    <head>
        <title>Judul</title>
        {{-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
            rel="stylesheet"> --}}
    </head>
    <style>
        /* CSS untuk memberikan margin pada tabel */
        html {
            margin: 3px 10px 3px 5px;
            padding: 3px 3px 3px 3px
        }

        .no-border {
            border: none;
            padding-bottom: 2px;
            padding-right: 2px;
            border-collapse: collapse;
            /* border: 1px solid red; */
        }

        body {
            font-size: 10.9px;
            font-family: Arial, Helvetica, sans-serif;
        }

        table {
            margin: 2px;
            border-collapse: collapse;
            border: 0px solid #070707;
            /* Atur nilai margin sesuai kebutuhan Anda */
            /* border-collapse: collapse; */
            /* Agar garis antar sel tabel terlihat lebih baik */
            /* Lebar tabel, sesuaikan dengan kebutuhan Anda */
        }

        th,
        td {
            border-collapse: collapse;
            border: 1px solid #070707;
            /* Garis antar sel tabel */
            padding: 0px;
            /* Jarak antara isi sel dengan batas sel */
            text-align: left;
            /* Penataan teks dalam sel tabel */
        }

        th {
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }

        .form-check {
            display: flex;
            align-items: center;
        }

        .form-check-input {
            margin-right: 10px;
            /* Sesuaikan dengan jarak yang diinginkan antara checkbox dan label */
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
            /* Ganti dengan path gambar depan */
            position: absolute;
            top: 0;
            left: 0;
            background-size: contain;
            background-position: center center;
            /* Sesuaikan posisi ini */
        }

        .page_break {
            page-break-before: always;
        }
    </style>

    <body>
        <table style="width: 100%">
            <tr>
                <th width="50px" rowspan="4"> </th>
                <th colspan=2 class="text-center" width="50%" style="font-size: 12">
                    <table class="no-border">
                        <tr class="no-border">
                            <td class="no-border">Nama Pasien</td>
                            <td class="no-border">:</td>
                            <td class="no-border">{{ $dataForm->pasien->name }}</td>
                        </tr>
                        <tr class="no-border">
                            <td class="no-border">I/A dari</td>
                            <td class="no-border">:</td>
                            <td class="no-border"> ................................</td>
                        </tr class="no-border">
                        <tr class="no-border">
                            <td class="no-border">Lahir</td>
                            <td class="no-border">:</td>
                            <td class="no-border">{{ $dataForm->pasien->dob }}</td>
                        </tr>
                    </table>
                </th>
                <th colspan=2 class="text-center" style="font-size: 14"><img style="margin-left: 3px;width: 80px"
                        src="{{ public_path('assets/img/logo2.png') }}" />
                    <h4>KLINIK PERTAMINA</h4>
                    <h5>SURAT PERMINTAAN KONSULTASI</h5>
                </th>
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
                    <br>Pekerja
                </td>
                <td>Pekerjaan:
                    @php $dataForm->pasien->load('unit') @endphp
                    <br>{{ $dataForm->pasien->company->name }} - {{ $dataForm->pasien->unit->name }}

                </td>
                <td>No. Pekerja
                    <br>{{ $dataForm->pasien->employee_id }}
                </td>
                <td>Golongan

                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <br>
                    <div style="display: flex; gap: 8px;">
                        <div>Diagnosis : </div>
                        <div>{{ $dataForm->diagnosis }} </div>
                    </div>
                    <br>
                    <div style="flex: d-flex">
                        <div>Ikhtisan klinik singkat : </div>
                        <div>{{ $dataForm->ikhtisar }} </div>
                    </div>
                    <br>
                    <div style="flex: d-flex">
                        <div>Pengobatab yang telah diberikan : </div>
                        <div>{{ $dataForm->pengobatan_diberikan }} </div>
                    </div>
                    <br>
                    <div style="flex: d-flex">
                        <div>Konsultasi yang diminta : </div>
                        <div>{{ $dataForm->konsultasi_diminta }} </div>
                    </div>
                    <br><br><br><br><br><br>
                    <div style="flex: d-flex">
                        <div>Tanda tangan dokter pengirim : <br><br><br><br><br></div>
                        <div>{{ $dataForm->doctor->name }} </div>
                    </div>

                </td>
            </tr>

            {{-- <tr>
                <th> </th>

                <td style="width: 40% !important">
                    <table style="width: 100%" class="no-border text-center">
                        <tr class="no-border">
                            <td class="no-border" style="width: 15%"> </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center no-border"
                                style="font-size: 19px; font-style: bold  ">PEMERINTAH
                                KABUPATEN
                                BANGKA</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center no-border"
                                style="font-size: 15px; font-style: bold  ">DINAS KESEHATAN KABUPATEN BANGKA</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center no-border"
                                style="font-size: 15px; font-style: bold  ">UPTD PSC-119 SEPINTU SEDULANG</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center no-border" style="font-size: 10px;  ">Jl. Jendral
                                Sudirman Ex. SD Tingkat 33215,
                                Telp/Fax :0717-93766, HP :08127199119
                                <br> Email/facebook :
                                spgdt.sepintusedulang@gmail.com, website : psc.bangka.go.id
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>

            <tr>
                <th> </th>

                <td class="text-center">PETUGAS<br><br><br> <b> <b> ( {{ $dataForm->pasien->name }} )</b></td>
                <td class="text-center">PETUGAS YANG MENERIMA RUJUKAN
                    <br><br><br> <b> <b> ( ............................................... )</b>
                </td>
            </tr> --}}
        </table>
    </body>

</html>
