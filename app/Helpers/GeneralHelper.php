<?php

use Illuminate\Support\Carbon;

if (!function_exists('spanFitality')) {
    function spanFitality($val, $cek = false)
    {
        if ($val == 'Y') {
            if ($cek)
                return true;
            return "<span class='text-success'>FIT</span>";
        } else if ($val == 'N') {
            if ($cek)
                return false;
            return "<span class='text-danger'>UNFIT</span>";
        } else {
            return "<span class='text-warning'> - </span>";
        }
    }
}
if (!function_exists('toSnakeCase')) {
    function toSnakeCase($string)
    {
        $string = str_replace(['/', '(', ')'], '_', $string);
        $string = preg_replace('/[^a-zA-Z0-9 _]/', '', $string);
        $string = trim($string, " _");
        $string = preg_replace('/\s+/', '_', $string);
        $string = preg_replace('/_+/', '_', $string);
        return strtolower($string);
    }
}



if (!function_exists('getHeaderMCU')) {
    function getHeaderMCU()
    {
        return ["Nama", "Nopek", "No RM", "Tempat Lahir", "Tanggal Lahir", "Lokasi", "Tahun MCU", "Tanggal MCU", "Jenis Kelamin", "Status Perkawinan", "Alamat", "Uraian Singkat Pekerjaan", "Hazard/Risiko Lingkungan Kerja", "Keluhan Umum", "Kesadaran", "Status Mentalis", "Status Psikologis (SRQ29)", "Keluhan berhubungan dengan Pekerjaan", "Riwayat Penyakit Dahulu", "Riwayat Penyakit Keluarga", "Riwayat Kecelakaan", "Riwayat Alergi", "Riwayat Vaksinasi", "Riwayat Obs/Gyn", "Riwayat Operasi", "Diet", "Konsumsi Buah/Sayur", "OlahRaga", "Merokok", "Kopi", "Alkohol", "Obat Rutin", "TD Sistole", "TD Diastole", "Nadi", "Irama Nadi", "Pernafasan", "Suhu Badan", "TB", "BB", "LP (Lingkar Pinggang)", "BMI", "Status Gizi", "AVOD", "AVOS", "ADD(Koreksi Visus)", "Tekanan Bola Mata", "Funduscopy", "Buta Warna", "Kepala", "Leher", "Mulut", "Tonsil", "Pharynx", "Jantung", "ParuParu", "Abdomen", "Hepar", "Lien", "Ginjal", "Extremitas", "Reflek Fisiologis", "Reflek Patologis", "Kulit", "Haemorhoid", "Tulang Belakang", "Lain Lain", "Kesimpulan", "EKG", "Pap Smear", "Treadmill Test", "Status Kebugaran", "Target Nadi Olahraga", "Test Rockport", "Napfa", "Spirometri", "Audiometri", "Mammografi", "USG Abdomen", "Biological Monitoring", "Toraks Foto", "Mata", "THT", "D", "M", "F", "Advice Gimul", "HB", "Leukosit", "Eritrosit", "Hematokrit", "Trombosit", "LED", "Basofil", "Eosinofil", "Batang", "Segmen", "Limfosit", "Monosit", "Hapusan Darah", "Warna Urine", "Berat Jenis", "PH Urine", "Protein", "Nitrit", "Reduksi N", "Reduksi PP", "Aseton Urin", "Bilirubin", "Urobilinogen", "Leukosit Esterase", "Sel Epithel", "Leukosit Urine", "Eritrosit Urine", "Silinder", "Bakteri", "Jamur", "Kristal", "Konsistensi", "Warna Faeces", "Lendir", "Darah Nanah", "Eritrosit Faeces", "Leukosit Faeces", "Amuba Protozoa", "Kista", "Sisa Pencernaan", "Telor Cacing", "Kultur Faeces", "Gula Darah Puasa", "Gula Darah 2jam PP", "Hba1c", "Kolesterol Total", "Trigliserida", "HDL", "LDL", "Rasio TC/HDL", "Ureum", "Kreatinin", "Asam Urat", "SGOT", "SGPT", "Bill Total", "Bili Direct", "Bili Indirect", "ALK Fospat", "Kolinesterase", "HbsAg", "Anti HBs", "HBeAg", "Anti HCV", "TPHA", "VDRL", "BTA Sputum", "Drug Test", "Alcohol Test", "Kesimpulan Derajat Kesehatan", "Kesimpulan Kelaikan Kerja", "Risiko Cardiovascular (SKJ)", "Risiko Cardiovascular (SF)", "Saran Dokter", "Rekomendasi", "Dokter", "Anamnesa Mata", "Penglihatan", "Test Ishihara", "Kesimpulan Mata", "Saran Mata", "Anamnesa THT", "Telinga", "Hidung", "Tenggorokan", "Kesimpulan THT", "Saran THT", "Tanggal Selesai", "Kesimpulan 1", "Kesimpulan 2", "Kesimpulan 3", "Nasehat 1", "Nasehat 2", "Diet 1", "Diet 2", "Diet 3", "Nasehat Lain", "Saran 1", "Saran 2", "Saran 3"];
    }
}
if (!function_exists('getParamMCU')) {
    function getParamMCU()
    {
        // $record =  ["Nama", "Nopek", "No RM", "Tempat Lahir", "Tanggal Lahir", "Lokasi", "Tahun MCU", "Tanggal MCU", "Jenis Kelamin", "Status Perkawinan", "Alamat", "Uraian Singkat Pekerjaan", "Hazard/Risiko Lingkungan Kerja", "Keluhan Umum", "Kesadaran", "Status Mentalis", "Status Psikologis (SRQ29)", "Keluhan berhubungan dengan Pekerjaan", "Riwayat Penyakit Dahulu", "Riwayat Penyakit Keluarga", "Riwayat Kecelakaan", "Riwayat Alergi", "Riwayat Vaksinasi", "Riwayat Obs/Gyn", "Riwayat Operasi", "Diet", "Konsumsi Buah/Sayur", "OlahRaga", "Merokok", "Kopi", "Alkohol", "Obat Rutin", "TD Sistole", "TD Diastole", "Nadi", "Irama Nadi", "Pernafasan", "Suhu Badan", "TB", "BB", "LP (Lingkar Pinggang)", "BMI", "Status Gizi", "AVOD", "AVOS", "ADD(Koreksi Visus)", "Tekanan Bola Mata", "Funduscopy", "Buta Warna", "Kepala", "Leher", "Mulut", "Tonsil", "Pharynx", "Jantung", "ParuParu", "Abdomen", "Hepar", "Lien", "Ginjal", "Extremitas", "Reflek Fisiologis", "Reflek Patologis", "Kulit", "Haemorhoid", "Tulang Belakang", "LainLain", "Kesimpulan", "EKG", "PapSmear", "Treadmill Test", "Status Kebugaran", "Target Nadi Olahraga", "Test Rockport", "Napfa", "Spirometri", "Audiometri", "Mammografi", "USG Abdomen", "Biological Monitoring", "Toraks Foto", "Mata", "THT", "D", "M", "F", "Advice Gimul", "HB", "Leukosit", "Eritrosit", "Hematokrit", "Trombosit", "LED", "Basofil", "Eosinofil", "Batang", "Segmen", "Limfosit", "Monosit", "Hapusan Darah", "Warna Urine", "Berat Jenis", "PH Urine", "Protein", "Nitrit", "Reduksi N", "Reduksi PP", "Aseton Urin", "Bilirubin", "Urobilinogen", "Leukosit Esterase", "Sel Epithel", "Leukosit Urine", "Eritrosit Urine", "Silinder", "Bakteri", "Jamur", "Kristal", "Konsistensi", "Warna Faeces", "Lendir", "Darah Nanah", "Eritrosit Faeces", "Leukosit Faeces", "Amuba Protozoa", "Kista", "Sisa Pencernaan", "Telor Cacing", "Kultur Faeces", "Gula Darah Puasa", "Gula Darah 2jam PP", "Hba1c", "Kolesterol Total", "Trigliserida", "HDL", "LDL", "Rasio TC/HDL", "Ureum", "Kreatinin", "Asam Urat", "SGOT", "SGPT", "Bill Total", "Bili Direct", "Bili Indirect", "ALK Fospat", "Kolinesterase", "HbsAg", "Anti HBs", "HBeAg", "Anti HCV", "TPHA", "VDRL", "BTA Sputum", "Drug Test", "Alcohol Test", "Kesimpulan Derajat Kesehatan", "Kesimpulan Kelaikan Kerja", "Risiko Cardiovascular (SKJ)", "Risiko Cardiovascular (SF)", "Saran Dokter", "Rekomendasi", "Dokter", "Anamnesa Mata", "Penglihatan", "Test Ishihara", "Kesimpulan Mata", "Saran Mata", "Anamnesa THT", "Telinga", "Hidung", "Tenggorokan", "Kesimpulan THT", "Saran THT", "Tanggal Selesai", "Kesimpulan 1", "Kesimpulan 2", "Kesimpulan 3", "Nasehat 1", "Nasehat 2", "Diet 1", "Diet 2", "Diet 3", "Nasehat Lain", "Saran 1", "Saran 2", "Saran 3"];
        $record = getHeaderMCU();
        $final = [];
        foreach ($record as $r) {
            array_push($final, ['label' => $r, 'field' => toSnakeCase($r)]);
        }
        return $final;
        // return strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', str_replace(' ', '_', $string)));
    }
}
if (!function_exists('countAge')) {
    function countAge($tanggalLahir)
    {
        $today = Carbon::now();
        $diff = $today->diff($tanggalLahir);

        return [
            'tahun' => $diff->y,
            'bulan' => $diff->m
        ];
    }
}


if (!function_exists('tanggalSort')) {
    function tanggalSort($date)
    {
        // Set locale to Bahasa Indonesia
        \Carbon\Carbon::setLocale('id');
        // format keluaran Sel, 9 Jan 23
        return \Carbon\Carbon::parse($date)->isoFormat('ddd, D MMM YY');
    }
}


function styleStatusCall($text, $s)
{
    return '<span class="badge bg-label-' . $s . ' rounded-pill">' . $text . '</span>';
}


if (!function_exists('input_checkbox')) {
    // function input_checkbox($id, $label, $extra = '', $value = null)
    // {
    //     return '<div class="form-check form-check-primary">
    //             <input class="form-check-input" type="checkbox" value="1" id="' . $id . '"
    //                 name="' . $id . '" ' . (!empty($value) ? ($value == '1' ? 'checked' : '') : '') . '>
    //             <label class="form-check-label" for="' . $id . '">' . $label . $extra . '</label>
    //         </div>';
    // }

    function input_checkbox($id, $label, $extra = '', $value = null)
    {
        $checked = old($id, $value) ? 'checked' : '';

        return view('components.checkbox', compact('id', 'label', 'extra', 'checked'));
    }
}

if (!function_exists('input_inline')) {
    function input_inline($id, $label, $col_1 = 'sm-3', $col_2 = 'sm-9', $span = null, $value = null)
    {
        return view('components.input-inline', compact('id', 'label', 'col_1', 'col_2', 'span', 'value'));
    }
}
if (!function_exists('textarea_inline')) {
    function textarea_inline($id, $label, $col_1 = 'sm-3', $col_2 = 'sm-9', $rows = 3, $value = null)
    {
        return '<div class="row mt-3">
                            <label class="col-' . $col_1 . ' col-form-label" for="">' . $label . '</label>
                            <div class="col-' . $col_2 . '">
                                    <div class="input-group">
                                        <textarea type="text" id="' . $id . '" name="' . $id . '" rows="' . $rows . '" class="form-control">' . ($value ?? '') . '</textarea>
                                    </div>
                            </div>
                        </div>
                  ';
    }
}
if (!function_exists('input_radios')) {
    function input_radios($id,  $arr, $class = '', $col_child = 'sm-12', $value = null)
    {
        $html = '';
        foreach ($arr as $key => $ar) {
            $html .= input_radio($id, $key, $ar, $col_child, $value);
        };

        return ' <div class="col-sm-12 mt-2 ' . $class . '">
                   ' . $html . '
                </div>';
    }
}

function input_radio($id, $key, $ar, $col_child, $value)
{
    // echo 'key: ' . $key . '  value:' . $value;
    // die();
    return '
        <div class="form-check form-check-inline col-' . $col_child . '">
            <input class="form-check-input form-check-inline" type="radio" ' . (!empty($value) ? ($value == $key ? 'checked' : '') : '') . '
            name="' . $id . '" id="' . $id . '_' . $key . '_val" value="' . $key . '">
        <label class="form-check-label"  for="' . $id . '_' . $key .  '_val">' . $ar . '</label>
        </div>
   ';
}


if (!function_exists('statusCall')) {
    function statusCall($i)
    {
        if ($i == 1) return styleStatusCall("Belum Direspon", 'danger');
        else if ($i == 2) return styleStatusCall("Handle by Admin PSC", 'warning');
        else if ($i == 3) return styleStatusCall("Handle by Petugas Lapangan", 'warning');
        else if ($i == 99) return styleStatusCall("Selesai", 'success');
    }
}

if (!function_exists('tanggalFull')) {
    function tanggalFull($date)
    {
        // Set locale to Bahasa Indonesia
        \Carbon\Carbon::setLocale('id');

        return \Carbon\Carbon::parse($date)->isoFormat('dddd, D MMMM YYYY, ' . '[Pukul] HH:mm');
    }
}
if (!function_exists('tanggalDayDate')) {
    function tanggalDayDate($date)
    {
        // Set locale to Bahasa Indonesia
        \Carbon\Carbon::setLocale('id');

        return \Carbon\Carbon::parse($date)->isoFormat('dddd, D MMMM YYYY');
    }
}

if (!function_exists('tanggalJam')) {
    function tanggalJam($date)
    {
        // Set locale to Bahasa Indonesia
        \Carbon\Carbon::setLocale('id');

        return \Carbon\Carbon::parse($date)->isoFormat('HH:mm');
    }
}



if (!function_exists('table_input')) {
    function table_input($label, $value, $arr = ['100', '2', '50'], $tr = true)
    {
        $html = "";
        if ($tr) $html .= '<tr class="no-borders">';
        $html .= '
                <td class="no-border"  width="80px">' . $label . '</td>
                <td class="no-border text-center"  width="10px">:</td>
                <td class="no-border"   width="150px" ' . (($tr) ? 'colspan="4"' : '') . '> ' . $value . '</td>
                ';
        if ($tr) $html .= '</tr>';
        return $html;
    }
}


if (!function_exists('pdf_checkbox')) {
    function pdf_checkbox($label, $value = null)
    {
        // dd($value);
        $checked = ('1' == $value) ? 'checked' : '';
        return '  
                <div style="display: inline-block; vertical-align: middle;">
                <input style="transform: scale(1); vertical-align: middle;" type="checkbox" ' . $checked . '>
                <span style="display: inline-block; vertical-align: middle;"> ' . $label . '</span>
            </div>
';
    }
}
if (!function_exists('pdf_checkbox2')) {
    function pdf_checkbox2($label, $value = null, $format = 1)
    {
        // dd($value);
        $checked = ('1' == $value) ? 'checked' : '';
        if ($format == 2 && empty($value)) {
            return "";
        }
        return '  <tr class="no-border" style="height: 5px !important ;margin-top: 0px !important ; padding-top:0px !important ">
        <td class="no-border" style="vertical-align: top ; margin-top: -100px !important ; padding-top: -10px !important ">
        ' . ($value == 'noprint' ? '' :
            //         '<div style="display: inline-block; vertical-align: buttom;">
            //     <input style="transform: scale(1); margin: 0; padding: 0; height: 15px !important;" type="checkbox" ' . $checked . '>
            // </div>'
            '<input style="vertical-align: top ;  transform: scale(1.2); margin-top:  -5px !important ; padding-top: -10px  !important ;height: 15px !important" type="checkbox" ' . $checked . '>'
        ) . ' 
        </td> 
        <td class="no-border" style="height: 15px !important;" > ' . $label . '</td>
        <tr>';
    }
}
if (!function_exists('pdf_radio')) {
    function pdf_radio($label, $arr = [], $value = null, $format = 1)
    {
        $html = '';
        foreach ($arr as $key => $ar) {
            $checked = ($key == $value) ? 'checked' : '';
            if ($format == 2) {
                if ($checked) return " : <b>$ar<b>";
            } else {
                $html .= '<div style="display: inline-block; vertical-align: middle; margin-left: 2px;">
                    <input style="transform: scale(0.6); vertical-align: middle;" type="radio" ' . $checked . '>
                    <span style="display: inline-block; vertical-align: middle;"> ' . $ar . '</span>
                    </div>';
            }
        }
        if ($format == 2) return "";
        return "<br>" . $html;
    }
}

if (!function_exists('get_fiksasi')) {
    function get_fiksasi()
    {
        return ['head_tilt' => 'Head Tilt', 'chin_lit' => 'Chin Lit', 'jaw_trush' => 'Jaw Thrus'];
    }
}

if (!function_exists('get_breathing')) {
    function get_breathing()
    {
        return  ['lambat' => 'Lambat', 'cepat' => 'Cepat', 'asismetris' => 'Asismetris'];
    }
}

if (!function_exists('get_warna_kulit')) {
    function get_warna_kulit()
    {
        return    ['normal' => 'Normal', 'pucat' => 'Pucat', 'kemerahan' => 'Kemerahan', 'sianosis' => 'Sianosis'];
    }
}

if (!function_exists('get_kulit')) {
    function get_kulit()
    {
        return  ['normal' => 'Normal', 'hangat' => 'Hangat', 'dingin' => 'Dingin', 'kering' => 'Kering', 'lembab' => 'Lembab'];
    }
}
if (!function_exists('get_nadi')) {
    function get_nadi()
    {
        return  [
            'normal' => 'Normal',
            'reguler' => 'Reguler',
            'irreguler' => 'Irreguler',
            'bradikardi' => 'Bradikardi',
            'takikardi' => 'Takikardi',
            'kuat' => 'Kuat',
            'lemah' => 'Lemah',
        ];
    }
}

if (!function_exists('gcs_mata')) {
    function gcs_mata()
    {
        return  [
            '4' => 'Spontan',
            '3' => 'Terhadap bicara',
            '2' => 'Terhadap nyeri',
            '1' => 'Tidak ada respon',
        ];
    }
}
if (!function_exists('gcs_verbal')) {
    function gcs_verbal()
    {
        return  [
            '5' => 'Terorientasi',
            '4' => 'Percakapan yang membingungkan',
            '3' => 'Menggunakan kata-kata yang tidak sesuai',
            '2' => 'Suara mengerang',
            '1' => 'Tidak ada respon',
        ];
    }
}
if (!function_exists('gcs_motorik')) {
    function gcs_motorik()
    {
        return  [
            '6' => 'Mengikuti perintah',
            '5' => 'Menunjuk tempat rangsang',
            '4' => 'Menghindar dari stimulus',
            '3' => 'Fleksi abnormal',
            '2' => 'Ekstensi abnormal',
            '1' => 'Tidak ada respon',
        ];
    }
}
if (!function_exists('gcs_expo')) {
    function gcs_expo()
    {
        return [
            'buka_pakaian' => 'Buka Pakaian',
            'selimut' => 'Selimut',
            'rawat_luka' => 'Rawat Luka',
            'reposisi' => 'Reposisi',
            'spalk' => 'Spalk',
            'spine_split' => 'Spine Split',
        ];
    }
}
