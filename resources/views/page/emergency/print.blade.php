<!DOCTYPE html>
<html>
    <?php
    // $imageBinary = base64_encode($dataForm->gambar);
    $imageSrc = 'storage/upload/tindakan/' . $dataForm->gambar;
    
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
            background-image: url('{{ $imageSrc }}');
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
                <th colspan=2 class="text-center" style="font-size: 14">FORM PENGKAJIAN DAN TINDAKAN
                    <br>PUBLIC SAFETY CENTER (PSC) -119 SEPINTU SEDULANG KABUPATEN BANGKA
                </th>
            </tr>
            <tr>
                <td style="width: 50% !important">
                    <table style="width: 100%" class="no-border text-center">
                        <tr class="no-border">
                            <td style="width: 15%" class="no-border"> <img style="margin-left: 3px; width: 80px"
                                    src="{{ public_path('assets/img/kab-bangka.png') }}" /></td>
                            <td style="width: 70%; font-size: 23px ; color: red; font-style: bold italic;"
                                class="text-center no-border">
                                TIME SAVING<br>
                                IS LIFE SAVING</td>
                            <td class="no-border" style="width: 15%"> <img style="margin-left: 3px;width: 80px"
                                    src="{{ public_path('assets/img/logo.png') }}" /></td>
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
                    {{-- <img style="margin-left: 3px" src="{{ public_path('assets/img/kop-form-kajian.jpg') }}" /> --}}
                </td>
                <td style="width: 50% !important">
                    <table class="no-borders" style="width: 100%">
                        <tr>
                            <td class="no-border" width="110px">NAMA PASIEN </td>
                            <td width="10px" class="text-center no-border">: </td>
                            <td colspan="4" class="no-border">{{ $dataForm->nama_pasien }} </td>
                        </tr>
                        <tr>
                            <td class="no-border" width="90px">UMUR </td>
                            <td width="10px" class="text-center no-border">: </td>
                            <td width=90px class="no-border">{{ $dataForm->umur }} <span
                                    style="float:right; margin-right:30px">Tahun</span> </td>

                            <td class="no-border" width="50px">JAMKES </td>
                            <td width="10px" class="text-center no-border">: </td>
                            <td class="no-border">{{ $dataForm->jamkes }} </td>
                        </tr>
                        <tr>
                            <td class="no-border" width="90px">JENIS KELAMIN </td>
                            <td width="10px" class="text-center no-border">: </td>
                            <td width=90px class="no-border">
                                {{ !empty($dataForm->jenis_kelamin) ? ($dataForm->jenis_kelamin == 'p' ? 'Perempuan' : 'Laki-laki') : '' }}
                            </td>

                            <td class="no-border" width="50px">NO TELP </td>
                            <td width="10px" class="text-center no-border">: </td>
                            <td class="no-border">{{ $dataForm->phone_pasien }} </td>
                        </tr>
                        {!! table_input(
                            'SUMBER INFORMASI',
                            !empty($dataForm->sumber_informasi) ? ($dataForm->sumber_informasi == 'orang_lain' ? 'Orang Lain' : 'Diri') : '',
                        ) !!}
                        {{-- {!! table_input('NAMA PASIEN', $dataForm->nama_pasien ?? '', ['100', '10', 0]) !!}
                        <tr>
                            {!! table_input('UMUR', ($dataForm->umur ?? '') . ' Tahun', ['100', '10', '200'], false) !!}
                            {!! table_input('JAMKES', $dataForm->jamkes ?? '', ['100', '10', '200'], false) !!}
                        </tr>
                        {!! table_input('NO TELP', $dataForm->phone_pasien ?? '') !!}
                        {!! table_input(
                            'JENIS KELAMIN',
                            !empty($dataForm->jenis_kelamin) ? ($dataForm->jenis_kelamin == 'p' ? 'Perempuan' : 'Laki-laki') : '',
                        ) !!}
                        --}}
                        {!! table_input('LOKASI KEJADIAN', $dataForm->lokasi_kejadian ?? '') !!}
                        {!! table_input('ALAMAT RUMAH', $dataForm->alamat_rumah ?? '') !!}
                        {!! table_input('Tanggal', $dataForm->tanggal) !!}
                    </table>
                    <table border="1" class="text-center" width="100%">
                        <tr>
                            <td class="text-center">Panggilan</td>
                            <td class="text-center">Kebera<br>ngkatan</td>
                            <td class="text-center">TKP</td>
                            <td class="text-center">Yankes</td>
                            <td class="text-center">di Rujuk</td>
                        </tr>
                        <tr>
                            <td class="text-center">{{ $dataForm->waktu_panggilan }}</td>
                            <td class="text-center">{{ $dataForm->waktu_berangkat }}</td>
                            <td class="text-center">{{ $dataForm->waktu_tkp }}</td>
                            <td class="text-center">{{ $dataForm->waktu_yankes }}</td>
                            <td class="text-center"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan=2>
                    <div style="min-height: 50px; margin-left: 10px"> <b>Keluhan Utama:</b><br>{!! $dataForm->keluhan_utama !!}
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan=2 class="text-center"><b>PRIMARY ASSESSMENT</b></td>
            </tr>
            <tr>
                <td class="text-center"><b>AIRWAY</b></td>
                <td class="text-center"><b>BREATHING</b></td>
            </tr>
            <tr>
                <td style="vertical-align: top ">
                    <table border="0" class="no-border" width='100%'>
                        <tr>
                            <td width="30%" class="no-border"
                                style="vertical-align: top ; padding-top: 10px !important">

                                <table class="no-border">
                                    {!! pdf_checkbox2('Bebas', $dataForm->airway_bebas ?? '', $format) !!}
                                    {!! pdf_checkbox2('Tidak Efektif', $dataForm->airway_tiak_efektif ?? '', $format) !!}
                                    {!! pdf_checkbox2('Benda Asing', $dataForm->airway_benda_asing ?? '', $format) !!}
                                    {!! pdf_checkbox2('C-Spine', $dataForm->airway_c_spine ?? '', $format) !!}

                                </table>


                            </td>
                            <td class="no-border" style="vertical-align: top ; padding-top: 10px !important">
                                <label>Tindakan : </label>
                                <table class="no-border">
                                    {!! pdf_checkbox2('Bebaskan Jalan Napas', $dataForm->airway_t_bebaskan_jalan_napas ?? '', $format) !!}
                                    {!! pdf_checkbox2(
                                        'Keluarkan Benda Asing sadsa asdasd ' .
                                            ($dataForm->airway_t_kel_ben_val
                                                ? '<span style="text-decoration: underline;">   ' . $dataForm->airway_t_kel_ben_val . '    </span>'
                                                : ''),
                                        $dataForm->airway_t_kel_ben ?? '',
                                        $format,
                                    ) !!}
                                    {!! pdf_checkbox2(
                                        'Fiksasi Manual ' . pdf_radio('', get_fiksasi(), $dataForm->airway_t_fik_man_val ?? '', $format),
                                        $dataForm->airway_t_fik_man ?? '',
                                        $format,
                                    ) !!}
                                    {!! pdf_checkbox2('Colar brance', $dataForm->airway_t_col_brance ?? '', $format) !!}
                                    {!! pdf_checkbox2('OPA', $dataForm->airway_t_opa ?? '', $format) !!}
                                    {!! pdf_checkbox2('Intubasi / Needle krokotirodektomie', $dataForm->airway_t_intubasi ?? '', $format) !!}
                                </table>
                                <br><span style="margin-buttom: 100px !important"></span>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="vertical-align: top ">
                    <table border="0" class="no-border" width='100%'>
                        <tr>
                            <td width="50%" class="no-border"
                                style="vertical-align: top ; padding-top: 10px !important">

                                <table class="no-border">
                                    {!! pdf_checkbox2(
                                        'Andekuat ' . pdf_radio('', get_breathing(), $dataForm->breathing_val ?? '', $format),
                                        $dataForm->breathing_andekuat ?? '',
                                        $format,
                                    ) !!}
                                    {{-- {!! pdf_checkbox2(pdf_radio('', get_breathing(), $dataForm->breathing_val ?? '', $format), 'noprint', $format) !!} --}}
                                    {!! pdf_checkbox2('Wheezing ', $dataForm->breathing_wheezing ?? '', $format) !!}
                                    {!! pdf_checkbox2('Stridor ', $dataForm->breathing_stridor ?? '', $format) !!}
                                    {!! pdf_checkbox2('Apnoe', $dataForm->breathing_apnoe ?? '', $format) !!}
                                </table>

                            </td>
                            <td class="no-border" style="vertical-align: top ; padding-top: 10px !important">
                                <label>Tindakan : </label>
                                <table class="no-border">

                                    {!! pdf_checkbox2(
                                        'O2/Oksigen : ' . $dataForm->breathing_t_o2_val . '  <span >lt/mt</span>',
                                        $dataForm->breathing_t_o2 ?? '',
                                        $format,
                                    ) !!}
                                    {!! pdf_checkbox2(
                                        'Saturasi : ' . $dataForm->breathing_t_satur_val . '  <span >%</span>',
                                        $dataForm->breathing_t_satur ?? '',
                                        $format,
                                    ) !!}

                                    {!! pdf_checkbox2('BVM', $dataForm->breathing_t_bvm ?? '', $format) !!}
                                    {!! pdf_checkbox2('Needle thoracosistesis', $dataForm->breathing_t_needle_thorac ?? '', $format) !!}
                                    {!! pdf_checkbox2('Thorax Drain', $dataForm->breathing_t_thorax_drain ?? '', $format) !!}
                                </table>

                                <br><span style="margin-buttom: 100px !important"></span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text-center"><b>CIRCULATION</b></td>
                <td class="text-center"><b>DISABILITY (GCS) =
                        {{ $dataForm->gcs ?? '....................................' }}</b></td>
            </tr>
            <tr>
                <td style="vertical-align: top ">
                    <table border="0" class="no-border" width='100%'>
                        <tr>
                            <td width="50%" class="no-border"
                                style="vertical-align: top ; padding-top: 10px !important">

                                <table class="no-border" style="vertical-align: top ;">
                                    <tr class="no-border" style="vertical-align: top ;">
                                        <td class="no-border" style="vertical-align: top ;">1. </td>
                                        <td class="no-border"> Capillary refil : {{ $dataForm->cir_cap_refil }} dt
                                        </td>
                                    </tr>
                                    <tr class="no-border" style="vertical-align: top ;">
                                        <td class="no-border">2. </td>
                                        <td class="no-border"> Warna kulit
                                            {!! pdf_radio('', get_warna_kulit(), $dataForm->cir_col_kulit ?? false, $format) !!}
                                        </td>
                                    </tr>
                                    <tr class="no-border" style="vertical-align: top ;">
                                        <td class="no-border">3. </td>
                                        <td class="no-border"> Kulit
                                            {!! pdf_radio('', get_kulit(), $dataForm->cir_kulit ?? false, $format) !!}
                                        </td>
                                    </tr>
                                    <tr class="no-border" style="vertical-align: top ;">
                                        <td class="no-border">4. </td>
                                        <td class="no-border"> Nadi<br>
                                            Tempat : {{ $dataForm->cir_nadi_tempat ?? '' }}
                                            {!! pdf_radio('', get_nadi(), $dataForm->cir_nadi ?? '', $format) !!}
                                        </td>
                                    </tr>


                                </table>


                            </td>
                            <td class="no-border" style="vertical-align: top ; padding-top: 10px !important">
                                <label>Tindakan : </label>
                                <table class="no-border">
                                    <tr class="no-border">
                                        <td class="no-border">1.</td>
                                        <td class="no-border">Pasang Monitor : {{ $dataForm->cir_monitor ?? '' }}
                                        </td>
                                    </tr>
                                    <tr class="no-border">
                                        <td class="no-border"></td>
                                        <td class="no-border">
                                            <div style="min-height: 50">
                                                EKG : {{ $dataForm->cir_ekg ?? '' }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="no-border">
                                        <td class="no-border">2.</td>
                                        <td class="no-border">IVFD : {{ $dataForm->cir_cpr ?? '...............' }} mt
                                        </td>
                                    </tr>
                                    <tr class="no-border">
                                        <td class="no-border">3.</td>
                                        <td class="no-border">CPR : {{ $dataForm->cir_ifvd ?? '...............' }}
                                            tts/ms
                                        </td>
                                    </tr>
                                    {!! pdf_checkbox2('Periksa Tensi', $dataForm->cir_tensi ?? '', $format) !!}
                                    {!! pdf_checkbox2('Balut Tekan', $dataForm->cir_balut_tekan ?? '', $format) !!}
                                    {!! pdf_checkbox2('Bebat Tekan', $dataForm->cir_bebat_tekan ?? '', $format) !!}
                                    {!! pdf_checkbox2('Defibrator', $dataForm->cir_defibrator ?? '', $format) !!}
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="vertical-align: top ">
                    <table class="no-border " width='100%'>
                        <tr>
                            <td class="no-border ">
                                <table width='100%' border="1">
                                    <tr class="text-center">
                                        <td colspan="1" class="text-center"><b>MEMBUKA MATA</b></td>
                                        <td colspan="1" class="text-center">NILAI</td>
                                    </tr>
                                    <?php
                                    $gcs_mata = gcs_mata();
                                    $gcs_verbal = gcs_verbal();
                                    $gcs_motorik = gcs_motorik();
                                    ?>
                                    @foreach ($gcs_mata as $key => $m)
                                        @if ($format == 1)
                                            <tr>
                                                <td>{{ $m }}</td>
                                                <td class="text-center">
                                                    {{ $key == ($dataForm->gcs_res_mata ?? false) ? '[' . $key . ']' : $key }}
                                                </td>
                                            </tr>
                                        @else
                                            @if ($key == ($dataForm->gcs_res_mata ?? false))
                                                <tr>
                                                    <td> {{ $m }}</td>
                                                    <td class="text-center">
                                                        {{ $key }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    <tr>
                                        <td colspan="2" class="text-center"><b>RESPON VERBAR</b></td>
                                    </tr>
                                    @foreach ($gcs_verbal as $key => $m)
                                        @if ($format == 1)
                                            <tr>
                                                <td>{{ $m }}</td>
                                                <td class="text-center">
                                                    {{ $key == ($dataForm->gcs_res_verbal ?? false) ? '[' . $key . ']' : $key }}
                                                </td>
                                            </tr>
                                        @else
                                            @if ($key == ($dataForm->gcs_res_verbal ?? false))
                                                <tr>
                                                    <td> {{ $m }}</td>
                                                    <td class="text-center">
                                                        {{ $key }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                    <tr>
                                        <td colspan="2" class="text-center"><b>RESPON MOTORIK</b></td>
                                    </tr>
                                    @foreach ($gcs_motorik as $key => $m)
                                        @if ($format == 1)
                                            <tr>
                                                <td>{{ $m }}</td>
                                                <td class="text-center">
                                                    {{ $key == ($dataForm->gcs_res_motorik ?? false) ? '[' . $key . ']' : $key }}
                                                </td>
                                            </tr>
                                        @else
                                            @if ($key == ($dataForm->gcs_res_motorik ?? false))
                                                <tr>
                                                    <td> {{ $m }}</td>
                                                    <td class="text-center">
                                                        {{ $key }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
                                    @endforeach

                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="no-border">
                                Tindakan <br>
                                Posisi : {{ $dataForm->gcs_t_posisi ?? '..........' }} <br>
                                GDS : {{ $dataForm->gcs_t_gds ?? '..........' }} mg/dl <br>
                                Chol : {{ $dataForm->gcs_t_chol ?? '..........' }} mg/dl <br>
                                AU : {{ $dataForm->gcs_t_au ?? '..........' }} mg/dl <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            @if ($format == 1)
        </table>
        <div class="page_break"></div>
        <table border="1px">
            @endif

            <tr>
                <td style="width: 50% !important" class="text-center"><b>SKALA NYERI</b></td>
                <td style="width: 50% !important" class="text-center"><b>EXPOSURE</b></td>
            </tr>
            <tr>
                <td style="width: 50%" class="text-center">
                    <b style="font-size : 12"> {{ $dataForm->skala_nyeri }}</b>
                    {{-- @for ($i = 0; $i <= 10; $i++)
                        &nbsp;&nbsp;
                        {!! !empty($dataForm->skala_nyeri)
                            ? ($dataForm->skala_nyeri == $i
                                ? '<b style="font-size : 14">[' . $i . ']</b>'
                                : $i)
                            : $i !!}&nbsp;&nbsp;
                    @endfor --}}

                </td>
                <td class="text-center">{!! pdf_radio('', gcs_expo(), $dataForm->expo ?? false, $format) !!}</td>
            </tr>
            <tr>
                <td class="text-center" colspan="2"><b>VITAL SIGN& SECONDARY ASSESMENT
                    </b></td>
            </tr>
            <tr>
                <td class="text-center" colspan="2">
                    <table border="1" width="100%">
                        <tr>
                            <td width="25%">NIPN : {{ $dataForm->sec_nipb ?? '..........' }} mmHg</td>
                            <td width="25%">HR : {{ $dataForm->sec_hr ?? '..........' }} x/mt</td>
                            <td width="25%">RR : {{ $dataForm->sec_rr ?? '..........' }} x/mt</td>
                            <td width="25%">TEMP : {{ $dataForm->sec_temp ?? '..........' }} &deg;C</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td width="50%" style="position: relative; vertical-align: top">
                    <div class="background-image"></div>
                    <div class="front-image"></div>
                </td>
                <td width="50%" style="vertical-align: top ">
                    <table width="100%">
                        <tr>
                            <td>
                                <div style="min-height: 40"><b>Riwayat Alergi</b> : {!! $dataForm->sec_riw_alergi !!}</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="min-height: 40"><b>Riwayat Makanan</b> : {!! $dataForm->sec_riw_makanan !!}</div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="min-height: 40"><b>Riwayat Penyakit Keluarga</b> :
                                    {!! $dataForm->sec_riw_penyakit_kel !!}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="min-height: 50"><b>Suspect Diagnosis</b> : {!! $dataForm->sec_suspect !!}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="min-height: 100"><b>Terapi/Obat yang diberikan</b> :
                                    {!! $dataForm->sec_riw_alergi !!}</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td class="text-center">PETUGAS<br><br><br> <b> <b> ( {{ $dataForm->user->name }} )</b></td>
                <td class="text-center">PETUGAS YANG MENERIMA RUJUKAN
                    <br><br><br> <b> <b> ( ............................................... )</b>
                </td>
            </tr>
        </table>
    </body>

</html>
