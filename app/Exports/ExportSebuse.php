<?php

namespace App\Exports;

use App\Helpers\Helpers;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Fill;


class ExportSebuse implements FromCollection,  WithStyles,  WithCustomStartCell, WithEvents, WithTitle, WithProperties
{
    protected $data;
    protected $total_data;
    protected $filter;

    public function __construct($data, $filter)
    {
        $this->data = $data;
        $this->filter = $filter;
        $this->total_data = 0;
    }
    public function title(): string
    {
        return 'SEBUSE REPORT ' . $this->filter['date_start'] . ' sd ' . $this->filter['date_end'];  // Nama sheet yang kamu inginkan
    }

    public function properties(): array
    {
        return [
            'creator'        => 'SIM PERTAFIT - Telp: 0812-7974-8967, Email: ugik.dev@gmail.com',
            'lastModifiedBy' => 'SIM PERTAFIT - Telp: 0812-7974-8967, Email: ugik.dev@gmail.com',
        ];
    }

    public function startCell(): string
    {
        return 'A9';
    }

    public function collection()
    {

        $datas = $this->data;
        $exportData = collect();
        $i = 1;
        foreach ($datas as $userId => $userData) {
            $userName = $userData['user_name'];
            $pushData = [];
            $pushData[] = $i;
            // Carbon::parse($data->created_at)->format('Y-m-d'),  // Tanggal
            // Carbon::parse($data->created_at)->format('h:i'),    // Waktu
            $pushData[] = $userData['user_name'];
            // dd($userData['userdata']);
            $pushData[] = Carbon::parse($userData['userdata']->dob)->age;
            $pushData[] = "tb";
            $pushData[] = "bb";
            $pushData[] = "fat";
            $pushData[] = "pinggang";
            $pushData[] = "tkndrh";
            $pushData[] = "gdp";
            $pushData[] = "gd2";
            $pushData[] = "kol";
            $pushData[] = "as_ur";
            $pushData[] = "skor";
            foreach ($userData['data'] as $year => $months) {
                foreach ($months as $month => $days) {
                    foreach ($days as $day => $dailyData) {
                        foreach ($dailyData as $data) {
                        }
                    }
                }
            }
            $exportData->push($pushData);
            $i++;
        }
        $this->total_data = $i - 1;
        return $exportData;
    }



    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $centerStyle = [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ];
                $borderStyle = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ];
                $boldStyle = [
                    'font' => [
                        'bold' => true,
                    ],
                ];
                $headerStyle = [
                    'font' => [
                        'bold' => true,
                    ],
                    'fill' => [
                        'fillType'   => Fill::FILL_SOLID,
                        'startColor' => ['argb' => '03AED2']
                    ]
                ];
                $filRed = [
                    'fill' => [
                        'fillType'   => Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'ff6666']
                    ]
                ];
                $filGreen = [
                    'fill' => [
                        'fillType'   => Fill::FILL_SOLID,
                        'startColor' => ['argb' => '66ffcc']
                    ]
                ];
                $sheet = $event->sheet;
                $style = $event->sheet->getDelegate();
                $style->getStyle('A6:T7')->applyFromArray($centerStyle);
                $style->getStyle('A6:T7')->applyFromArray($headerStyle);
                $style->getStyle('A1')->applyFromArray($centerStyle);
                $style->getStyle('A1')->applyFromArray($boldStyle);
                $style->getStyle('A6:T' . ($this->total_data + 7))->applyFromArray($borderStyle);
                $style->getStyle('J8:T' . ($this->total_data + 7))->applyFromArray($filGreen);
                $style->getStyle('I8:T' . ($this->total_data + 7))->applyFromArray($centerStyle);

                // $style->getStyle('A6:T7')->applyFromArray($centerStyle);
                // $style->getStyle('A6:T7')->applyFromArray($headerStyle);
                // $style->getStyle('A1')->applyFromArray($centerStyle);
                // $style->getStyle('A1')->applyFromArray($boldStyle);
                // $style->getStyle('A6:T' . $this->total_data + 7)->applyFromArray($borderStyle);
                // $style->getStyle('J8:T' . $this->total_data + 7)->applyFromArray($filGreen);
                // $style->getStyle('I8:T' . $this->total_data + 7)->applyFromArray($centerStyle);
                $w1 = 20;
                $w2 = 10;
                $w3 = 6;
                $w = [5, 13, 7, 16, 20, 5, 12, 20];
                $sheet->getColumnDimension('A')->setWidth($w[0]);
                $sheet->getColumnDimension('B')->setWidth($w[1]);
                $sheet->getColumnDimension('C')->setWidth($w[2]);
                $sheet->getColumnDimension('D')->setWidth($w[3]);
                $sheet->getColumnDimension('E')->setWidth($w[4]);
                $sheet->getColumnDimension('F')->setWidth($w[5]);
                $sheet->getColumnDimension('G')->setWidth($w[6]);
                $sheet->getColumnDimension('H')->setWidth($w[7]);
                $sheet->getColumnDimension('R')->setWidth(12);
                $sheet->getColumnDimension('S')->setWidth(12);
                $i = 5;
                $sheet->mergeCells('A1:T1');
                $sheet->setCellValue('A1', 'Daily Check UP');

                $sheet->mergeCells('A' . $i + 1 . ':A' . $i + 3);
                $sheet->mergeCells('B' . $i + 1 . ':B' . $i + 3);
                $sheet->mergeCells('C' . $i + 1 . ':C' . $i + 3);
                $sheet->mergeCells('D' . $i + 1 . ':D' . $i + 3);
                $sheet->mergeCells('E' . $i + 1 . ':E' . $i + 3);
                $sheet->mergeCells('F' . $i + 1 . ':F' . $i + 3);
                $sheet->mergeCells('G' . $i + 1 . ':G' . $i + 3);
                $sheet->mergeCells('H' . $i + 1 . ':H' . $i + 3);
                $sheet->mergeCells('I' . $i + 1 . ':I' . $i + 3);
                $sheet->mergeCells('J' . $i + 1 . ':J' . $i + 3);
                $sheet->mergeCells('K' . $i + 1 . ':K' . $i + 3);
                $sheet->mergeCells('L' . $i + 1 . ':L' . $i + 3);
                $sheet->mergeCells('M' . $i + 1 . ':M' . $i + 3);
                $sheet->mergeCells('M' . $i + 1 . ':M' . $i + 3);

                // $sheet->mergeCells('J' . $i + 1 . ':O' . $i + 3);
                // $sheet->mergeCells('P' . $i + 1 . ':R' . $i + 3);
                // $sheet->mergeCells('S' . $i + 1 . ':S' . $i + 3);
                // $sheet->mergeCells('T' . $i + 1 . ':T' . $i + 3);
                // $sheet->setCellValue('A' . $i + 1, 'Data Umum');
                // $sheet->setCellValue('J' . $i + 1, 'Tanda-Tanda Vital');
                // $sheet->setCellValue('P' . $i + 1, 'Pemeriksaan Tambahan');
                $sheet->setCellValue('A' . $i + 1, 'No');
                $sheet->setCellValue('B' . $i + 1, 'Nama');
                $sheet->setCellValue('C' . $i + 1, 'Usia');
                $sheet->setCellValue('D' . $i + 1, 'TB');
                $sheet->setCellValue('E' . $i + 1, 'BB');
                $sheet->setCellValue('F' . $i + 1, 'Visceral Fat');
                $sheet->setCellValue('G' . $i + 1, 'Lingkar Pinggang');
                $sheet->setCellValue('H' . $i + 1, 'Tekanan Darah');
                $sheet->setCellValue('I' . $i + 1, 'GDP');
                $sheet->setCellValue('J' . $i + 1, 'GD2JPP');
                $sheet->setCellValue('K' . $i + 1, 'Kolestrol Total');
                $sheet->setCellValue('L' . $i + 1, 'Asam Urat');
                $sheet->setCellValue('M' . $i + 1, 'Skor Kebugaran');
                $sheet->setCellValue('N' . $i + 2, 'KARDIO (KALORI)');
                $columnIndex = 'M';
                $dateStart = Carbon::parse($this->filter['date_start']);
                $dateEnd = Carbon::parse($this->filter['date_end']);
                for ($date = $dateStart; $date->lte($dateEnd); $date->addDay()) {
                    // dd(++$columnIndex);
                    // dd($date->format('d'));

                    // $sheet->setCellValue(++$columnIndex . $i + 3, "S");
                    $sheet->setCellValue(++$columnIndex . $i + 3, $date->format('d'));

                    // if (isset($userData['data'][$date->year][$date->format('m')][$date->format('d')])) {
                    //     $dailyData = $userData['data'][$date->year][$date->format('m')][$date->format('d')];

                    // Isi data per tanggal di kolom yang sesuai
                    // foreach ($dailyData as $data) {
                    //     $sheet->setCellValue($columnIndex . $row, $data->kardio ?? ''); // Contoh: data kardio
                    // }
                }

                // Pindah ke kolom berikutnya (kanan)
                // $columnIndex++;
                // }
                // dd($this->filter);
                // $sheet->setCellValue('O' . $i + 2, 'SPO2');
                // $sheet->setCellValue('P' . $i + 2, 'Romberg');
                // $sheet->setCellValue('Q' . $i + 2, 'Alcohol');
                // $sheet->setCellValue('R' . $i + 2, 'Alcohol Lvl');
                // $sheet->setCellValue('S' . $i + 1, 'FIT/UNFIT');
                // $sheet->setCellValue('T' . $i + 1, 'Ket');
                $sheet->mergeCells('A3:B3');
                $sheet->mergeCells('A4:B4');
                $sheet->mergeCells('A5:B5');
                $sheet->mergeCells('D3:T3');
                $sheet->mergeCells('D4:T4');
                $sheet->mergeCells('D5:T5');

                $sheet->setCellValue('A3', 'Unit');
                $sheet->setCellValue('A4', 'Dari Tanggal');
                $sheet->setCellValue('A5', 'Sampai Tanggal');

                // $sheet->setCellValue('F1', 'Tanggal');
                // $sheet->setCellValue('F2', 'Pagu Unit Kerja');
                // $sheet->setCellValue('F3', 'Total Usulan');
                // $sheet->setCellValue('G1', ':');
                // $sheet->setCellValue('G2', ':');
                // $sheet->setCellValue('G3', ':');
                $sheet->setCellValue('C3', ':');
                $sheet->setCellValue('C4', ':');
                $sheet->setCellValue('C5', ':');
                $sheet->setCellValue('D3', 'IT PANGKAL BALAM');
                $sheet->setCellValue('D4', $this->filter['date_start']);
                $sheet->setCellValue('D5', $this->filter['date_end']);

                $datas = $this->data;
                $i = 1;
                // foreach ($datas as $data) {
                //     if (!spanFitality($data->fitality, true)) {
                //         $style->getStyle('S' . $i + 7)->applyFromArray($filRed);
                //     }
                //     if (!Helpers::spanSistole($data->sistole, true)) {
                //         $style->getStyle('J' . $i + 7)->applyFromArray($filRed);
                //     }
                //     if (!Helpers::spanDiastole($data->diastole, true)) {
                //         $style->getStyle('K' . $i + 7)->applyFromArray($filRed);
                //     }
                //     if (!Helpers::spanHr($data->hr, true)) {
                //         $style->getStyle('L' . $i + 7)->applyFromArray($filRed);
                //     }
                //     if (!Helpers::spanTemp($data->temp, true)) {
                //         $style->getStyle('M' . $i + 7)->applyFromArray($filRed);
                //     }
                //     if (!Helpers::spanRr($data->rr, true)) {
                //         $style->getStyle('N' . $i + 7)->applyFromArray($filRed);
                //     }
                //     if (!Helpers::spanSpo2($data->spo2, true)) {
                //         $style->getStyle('O' . $i + 7)->applyFromArray($filRed);
                //     }
                //     if (!Helpers::spanRomberg($data->romberg, true)) {
                //         $style->getStyle('P' . $i + 7)->applyFromArray($filRed);
                //     }
                //     if (!Helpers::spanAlcoholTest($data->alcohol, true)) {
                //         $style->getStyle('Q' . ($i + 7) . ':R' . ($i + 7))->applyFromArray($filRed);
                //     }

                //     $i++;
                // }
            },
        ];
    }
    function numberToLetter($number)
    {
        $base = ord('a') - 1; // Mendapatkan nilai ASCII untuk huruf 'a' minus 1
        $result = ''; // Variabel untuk menyimpan hasil konversi

        while ($number > 0) {
            $remainder = $number % 26; // Sisa bagi dengan 26
            if ($remainder == 0) {
                $remainder = 26; // Jika sisa bagi adalah 0, ubah menjadi 26
            }
            $char = chr($base + $remainder); // Mendapatkan karakter huruf dari nilai ASCII
            $result = $char . $result; // Tambahkan huruf ke hasil konversi
            $number = ($number - $remainder) / 26; // Hitung nilai untuk iterasi berikutnya
        }

        return strtoupper($result);
    }
    public function styles($sheet)
    {
        return [
            // Tambahkan style lainnya sesuai kebutuhan
        ];
    }
}
