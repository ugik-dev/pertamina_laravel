<!DOCTYPE html>
<html>

    <head>
        <title>Print</title>
    </head>
    <style>
        /* CSS untuk memberikan margin pada tabel */
        html,
        body {
            margin: 3px 10px 3px 5px;
            padding: 3px 3px 3px 3px;
            height: 100%;
        }

        body {
            font-size: 10.9px;
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            flex-direction: column;
        }

        table.main {
            width: 100%;
            height: 100vh;
            /* height: 100%; */
            border-collapse: collapse;
            border: 1px solid #070707;
            /* flex-grow: 1; */
            flex: 1;
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
            /* padding: 0px; */
            padding: 5px;
            /* Jarak antara isi sel dengan batas sel */
            text-align: left;
            /* Penataan teks dalam sel tabel */
        }

        th {
            /* background-color: #f2f2f2; */
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

        .fill-space {
            height: 100%;
        }

        .fill-remaining {
            height: 100%;
            flex-grow: 1;
        }

        .break-5 {
            line-height: 5px;
        }

        .page_break {
            page-break-before: always;
        }
    </style>

    <body>
        <table style="width: 100%" class="main">
            <tr>
                <td width="50px" rowspan="6"> </td>
                <td colspan=2 class="text-center" width="500px" style="font-size: 10">
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
                </td>
                <th colspan=2 rowspan="2" class="text-center" width="500px"
                    style="font-size: 14 ;margin: 20px 0 0 0 ; padding: 10px 0 0 0 !important;"><img
                        style="margin-left: 3px;width: 180px; " src="{{ public_path('assets/img/logo2.png') }}" />
                    <h3>KLINIK PERTAMINA</h3>
                    <p style="font-weight: normal; margin: 5px 0; padding: 0px 0;">
                        SURAT PERMINTAAN KONSULTASI
                    </p>
                </th>
            </tr>
            <tr>
                <th width="50px" colspan="2"> </th>
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
                    <br>{{ $dataForm->realation_desc }}
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
            <tr class="fill-remaining">
                <td colspan="4">
                    <div>Diagnosis : {{ $dataForm->diagnosis }}</div>
                    {{-- <br>
                    <div>Ikhtisar klinik singkat : {{ $dataForm->ikhtisar }}</div>
                    <br>
                    <div>Pengobatan yang telah diberikan : {{ $dataForm->pengobatan_diberikan }}</div>
                    <br>
                    <div>Konsultasi yang diminta : {{ $dataForm->konsultasi_diminta }}</div> --}}
                </td>
            </tr>
            <tr class="signature-row">
                <td colspan="4" class="signature">
                    <div>Tanda tangan dokter pengirim:</div>
                    <br><br><br>
                    <div>{{ $dataForm->doctor->name }}</div>
                </td>
            </tr>
            {{-- <tr class="fill-spacse">
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


                </td>
            </tr> --}}
            {{-- <tr class="signature-row">
                <td colspan="4" class="signature">
                    <div>Tanda tangan dokter pengirim:</div>
                    <br><br><br>
                    <div>{{ $dataForm->doctor->name }}</div>
                </td>
            </tr> --}}
        </table>
        {{-- <div class="signature">
            <div>Tanda tangan dokter pengirim:</div>
            <div>{{ $dataForm->doctor->name }}</div>
        </div> --}}
    </body>

</html>
