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
                font-size: 15px;
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

            table.bordered {
                border-collapse: collapse;
                border: 1px solid black;

            }

            .bordered td,
            .bordered th {
                border: 1px solid black;
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
                height: 600px;
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
                margin-bottom: 20px;
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
        $countAge = countAge($dataForm->pasien->dob);
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
        <table class="no-border">
            <tr>
                <td width="50px" rowspan="6" style="vertical-align: bottom"> </td>
                <td colspan="4" class="text-center" width="500px" style="font-size: 12">
                    <table class="no-border">
                        <tr>
                            <td style="width:400px"></td>
                            <td>
                                <div style=" padding-top:20px !important">
                                    <img style="width: 200px; " src="{{ public_path('assets/img/logo2.png') }}" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:400px">PT.PERTAMINA PATRA NIAGA<br>REGIONAL SUMBANGSEL</td>
                            <td>
                                <div style=" padding-top:20px !important">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2"><b>SURAT PENGANTAR BEROBAT<br>
                                    No : ......../PND500000/20&nbsp;&nbsp;&nbsp;-S8</b></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <br>
                                Kepada Yth : {{ $dataForm->tujuan }}<br>di<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat
                                <br><br>
                                Sehubungan dengan kesehatannya, mohon bantuan untuk dilakukan pemeriksaan
                                pengobatan/atau perawatan terhadap :
                            </td>
                        </tr>
                    </table>
                    <table class="no-border" style="margin-left: 20px">
                        <tr>
                            <td style="width: 160px">Nama Pasien</td>
                            <td>:</td>
                            <td>{{ $dataForm->pasien->name }}</td>
                        </tr>

                        <tr>
                            <td>Tgl. Lahir</td>
                            <td>:</td>
                            @php
                                $tanggalDikirim = Carbon::parse($dataForm->pasien->dob);
                                $formatTglLahir = $tanggalDikirim->format('d F Y');
                            @endphp
                            <td>{{ $formatTglLahir }}</td>
                        </tr>
                        <tr>
                            <td>Umur</td>
                            <td>:</td>
                            <td>{{ $countAge['tahun'] }} tahun {{ $countAge['bulan'] }} bulan</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>
                                {{ $dataForm->pasien->gender == 'L' ? 'Laki-laki' : ($dataForm->pasien->gender == 'P' ? 'Perempuan' : '') }}
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>
                                @switch($dataForm->pasien->tanggungan_st)
                                    @case(1)
                                        Suami
                                    @break

                                    @case(2)
                                        Istri
                                    @break

                                    @case(3)
                                        Anak
                                    @break

                                    @default
                                        Pekerja
                                @endswitch
                            <td>
                        </tr>
                    </table>
                    <table class="no-border">
                        <tr>
                            <td>Tanggungan dari : </td>
                        </tr>
                    </table>
                    <table class="no-border" style="margin-left: 20px">
                        <tr>
                            <td style="width: 160px">Nama</td>
                            <td>:</td>
                            <td>{{ $dataForm->guarantor->pemilik->name }}</td>
                        </tr>
                        <tr>
                            <td>No Pekerja/Pensiunan</td>
                            <td>:</td>
                            {{-- @dd($dataForm->guarantor->pemilik) --}}
                            <td>{{ $dataForm->guarantor->pemilik->empoyee_id }}</td>
                        </tr>
                        <tr>
                            <td>Bagian</td>
                            <td>:</td>
                            <td>{{ $dataForm->guarantor->pemilik->company->name }} -
                                {{ $dataForm->guarantor->pemilik->unit->name }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $dataForm->guarantor->pemilik->alamat }}</td>
                        </tr>
                        <tr>
                            <td>Penjamin</td>
                            <td>:</td>
                            <td>
                                {{ $dataForm->guarantor?->guarantor->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>No. Penjamin</td>
                            <td>:</td>
                            <td>
                                {{ $dataForm->guarantor?->number }}
                            </td>
                        </tr>
                    </table>
                    <table class="no-border">
                        <tr>
                            <td>
                                Semua biaya yang timbul dapat dibebankan kepada
                                PT. Administrasi Medika, STO Telkom Gambir, Lantai 3, Jl. Medan Merdeka Sel. No. 12,
                                RT.11/RW.2, Gambir, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta
                                10110.<br><br>
                                Demikian disampaikan, atas kerjasamanya diucapkan terimakasih.
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="signature-row" style="border-top: 0px;">
                <td colspan="4" class="signature text-center" style="border-top: 0px; padding-left:400px">
                    @php
                        $tanggalDikirim = Carbon::parse(now());
                        $formattedTanggalTTD = $tanggalDikirim->format('d F Y');
                    @endphp
                    @if (!empty($qrcode))
                        <div>Pangkalpinang, {{ $formattedTanggalTTD }} <br>Medical Sumbangsel</div>
                        <img style="width: 150px;" src="{{ $qrcode }}" />
                    @else
                        {{-- @php
                            $tanggalDikirim = Carbon::parse($dataForm->created_at);
                            $formattedTanggalDikirim = $tanggalDikirim->format('d F Y');
                        @endphp --}}
                        <div>Pangkal Pinang, {{ $formattedTanggalTTD }} <br>Medical Sumbangsel</div>

                        <br><br><br><br><br>
                    @endif
                    <div>{{ $dataForm->doctor->name }}</div>
                </td>
            </tr>

        </table>
        <table class="no-border page-break">
            <tr>
                <td width="30px" rowspan="6" style="vertical-align: bottom"> </td>
                <td colspan="4" class="text-center" width="700px" style="font-size: 12">
                    <table class="no-border">
                        <tr>
                            <td style="width:400px"></td>
                            <td>
                                <div style=" padding-top:20px !important">
                                    <img style="width: 200px; " src="{{ public_path('assets/img/logo2.png') }}" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center" colspan="2">
                                <table class="no-borders">
                                    <tr>
                                        <td colspan="6">Jawaban Konsul :</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 80px">Nama</td>
                                        <td style="width: 5px">:</td>
                                        <td style="width: 200px">{{ $dataForm->pasien->name }}</td>
                                        <td style="width: 80px">No Pekerja</td>
                                        <td style="width: 5px">:</td>
                                        <td style="width: 200px">{{ $dataForm->guarantor->pemilik->empoyee_id }}</td>
                                    </tr>
                                    <tr>
                                        <td>I/A</td>
                                        <td>:</td>
                                        <td>
                                            @if ($dataForm->guarantor->pemilik->id != $dataForm->pasien->id)
                                                {{ $dataForm->guarantor->pemilik->name }}
                                            @endif
                                        </td>
                                        <td>Bagian</td>
                                        <td>:</td>
                                        <td> {{ $dataForm->guarantor->pemilik->unit->name }}</td>
                                    </tr>

                                    <tr>
                                        <td>Tgl. Lahir</td>
                                        <td>:</td>
                                        @php
                                            $tanggalDikirim = Carbon::parse($dataForm->pasien->dob);
                                            $formatTglLahir = $tanggalDikirim->format('d F Y');
                                        @endphp
                                        <td>{{ $formatTglLahir }}</td>
                                    </tr>
                                    <tr>
                                        <td>Umur</td>
                                        <td>:</td>
                                        <td>{{ $tahun }} tahun {{ $bulan }} bulan</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table class="bordered" style="width: 680px">
                                    <tr>
                                        <td style="width: 50%" class="text-center">Hasil Pemeriksaan</td>
                                        <td class="text-center">Nasehat</td>
                                    </tr>
                                    <tr style="height: 500px;">
                                        <td style="height: 500px;"></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="signature-row" style="border-top: 0px;">
                <td colspan="4" class="signature text-center" style="border-top: 0px; padding-left:400px">

                    <div>.......................... , ........................................</div>

                    <br><br><br><br><br>

                    <div> ( Dr. ................................................... ) </div>
                </td>
            </tr>

        </table>

    </body>

</html>
