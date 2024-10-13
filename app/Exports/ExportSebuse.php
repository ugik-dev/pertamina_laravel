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


class ExportSebuse implements WithStyles,  WithEvents, WithTitle, WithProperties
{
    // FromCollection, 
    protected $data;
    protected $total_data;
    protected $filter;
    protected $exportDatas;

    public function __construct($data, $filter)
    {
        $this->data = $data;
        $this->filter = $filter;
        $this->total_data = 0;
        $this->exportDatas = collect();
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
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    // 'fill' => [
                    //     'fillType'   => Fill::FILL_SOLID,
                    //     'startColor' => ['argb' => '03AED2']
                    // ]
                ];
                $filRed = [
                    'fill' => [
                        'fillType'   => Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'ff6666']
                    ]
                ];

                $filBlue = [
                    'fill' => [
                        'fillType'   => Fill::FILL_SOLID,
                        'startColor' => ['argb' => '8EA6E5']
                    ]
                ];
                $filSky = [
                    'fill' => [
                        'fillType'   => Fill::FILL_SOLID,
                        'startColor' => ['argb' => '76E4FF']
                    ]
                ];
                $filYellow = [
                    'fill' => [
                        'fillType'   => Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'D3EB5E']
                    ]
                ];
                $filGrey = [
                    'fill' => [
                        'fillType'   => Fill::FILL_SOLID,
                        'startColor' => ['argb' => '848484']
                    ]
                ];
                $filGreen = [
                    'fill' => [
                        'fillType'   => Fill::FILL_SOLID,
                        'startColor' => ['argb' => '66ffcc']
                    ]
                ];

                $filSuccess = [
                    'fill' => [
                        'fillType'   => Fill::FILL_SOLID,
                        'startColor' => ['argb' => '50ed3b']
                    ]
                ];

                $filBlack = [
                    'fill' => [
                        'fillType'   => Fill::FILL_SOLID,
                        'startColor' => ['argb' => '4b4d4a']
                    ]
                ];

                $filDanger = [
                    'fill' => [
                        'fillType'   => Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'd12833']
                    ]
                ];
                $filWarning = [
                    'fill' => [
                        'fillType'   => Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'e0db36']
                    ]
                ];
                $sheet = $event->sheet;
                $style = $event->sheet->getDelegate();
                // $style->getStyle('A6:T7')->applyFromArray($centerStyle);
                // $style->getStyle('A6:T7')->applyFromArray($headerStyle);
                // $style->getStyle('A1')->applyFromArray($centerStyle);
                // $style->getStyle('A1')->applyFromArray($boldStyle);
                // $style->getStyle('A6:T' . ($this->total_data + 7))->applyFromArray($borderStyle);
                // $style->getStyle('J8:T' . ($this->total_data + 7))->applyFromArray($filGreen);
                // $style->getStyle('I8:T' . ($this->total_data + 7))->applyFromArray($centerStyle);

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
                $w = [5, 20, 5, 7, 7, 7, 7, 7, 7, 7, 7];
                $sheet->getColumnDimension('A')->setWidth($w[0]);
                $sheet->getColumnDimension('B')->setWidth($w[1]);
                $sheet->getColumnDimension('C')->setWidth($w[2]);
                $sheet->getColumnDimension('D')->setWidth($w[3]);
                $sheet->getColumnDimension('E')->setWidth($w[4]);
                $sheet->getColumnDimension('F')->setWidth($w[5]);
                $sheet->getColumnDimension('G')->setWidth($w[6]);
                $sheet->getColumnDimension('H')->setWidth($w[7]);
                $sheet->getColumnDimension('I')->setWidth($w[7]);
                $sheet->getColumnDimension('J')->setWidth($w[7]);
                $sheet->getColumnDimension('L')->setWidth($w[7]);
                $sheet->getColumnDimension('M')->setWidth($w[7]);
                // $sheet->getColumnDimension('L')->setWidth($w[7]);
                // $sheet->getColumnDimension('R')->setWidth(12);
                // $sheet->getColumnDimension('S')->setWidth(12);
                $i = 5;


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
                $columnStart = 'N';
                // dd($this0<fi)
                $dateStart = Carbon::parse($this->filter['date_start']);
                $dateEnd = Carbon::parse($this->filter['date_end']);
                for ($date = $dateStart; $date->lte($dateEnd); $date->addDay()) {
                    $sheet->setCellValue(++$columnIndex . $i + 3, $date->format('d'));
                    $sheet->getColumnDimension($columnIndex)->setWidth($w[7]);
                }
                ++$columnIndex;
                $sheet->setCellValue($columnIndex . $i + 3, "TOTAL");
                ++$columnIndex;
                $sheet->setCellValue($columnIndex . $i + 3, "FREKUENSI");
                $sheet->mergeCells($columnStart . $i + 2 . ':' . $columnIndex . $i + 2);
                $style->getStyle($columnStart . '7:' . $columnIndex . '8')->applyFromArray($filBlue);

                // $columnIndex = 'M';
                $columnStart = $columnIndex;
                $columnStart++;
                $sheet->setCellValue($columnStart . $i + 2, 'Streching');

                // dd($columnStart);
                $dateStart = Carbon::parse($this->filter['date_start']);
                $dateEnd = Carbon::parse($this->filter['date_end']);
                $m = 0;
                for ($date = $dateStart; $date->lte($dateEnd); $date->addDay()) {
                    // $sheet->setCellValue(++$columnIndex . $i + 3, $date->format('d'));
                    $sheet->setCellValue(++$columnIndex . $i + 3, $m++);
                    $sheet->getColumnDimension($columnIndex)->setWidth($w[7]);
                }
                ++$columnIndex;
                $sheet->setCellValue($columnIndex . $i + 3, "TOTAL");
                // ++$columnIndex;
                // $sheet->setCellValue($columnIndex . $i + 3, "FREKUENSI");
                // dd($columnStart . $i + 2 . ':' . $columnIndex . $i + 2);
                $sheet->mergeCells($columnStart . $i + 2 . ':' . $columnIndex . $i + 2);
                $style->getStyle($columnStart . '7:' . $columnIndex . '8')->applyFromArray($filYellow)->getAlignment()
                    ->setWrapText(true);;

                $columnStart = $columnIndex;
                $columnStart++;
                $sheet->setCellValue($columnStart . $i + 2, 'GYM');
                $dateStart = Carbon::parse($this->filter['date_start']);
                $dateEnd = Carbon::parse($this->filter['date_end']);
                for ($date = $dateStart; $date->lte($dateEnd); $date->addDay()) {
                    $sheet->setCellValue(++$columnIndex . $i + 3, $date->format('d'));
                    $sheet->getColumnDimension($columnIndex)->setWidth($w[7]);
                }
                ++$columnIndex;
                $sheet->setCellValue($columnIndex . $i + 3, "TOTAL");
                $sheet->mergeCells($columnStart . $i + 2 . ':' . $columnIndex . $i + 2);
                $style->getStyle($columnStart . '7:' . $columnIndex . '8')->applyFromArray($filGrey);


                // mkn
                $columnStart = $columnIndex;
                $columnStart++;
                $sheet->setCellValue($columnStart . $i + 2, 'Makan Sehat');
                $dateStart = Carbon::parse($this->filter['date_start']);
                $dateEnd = Carbon::parse($this->filter['date_end']);
                for ($date = $dateStart; $date->lte($dateEnd); $date->addDay()) {
                    $sheet->setCellValue(++$columnIndex . $i + 3, $date->format('d'));
                    $sheet->getColumnDimension($columnIndex)->setWidth($w[7]);
                }
                ++$columnIndex;
                $sheet->setCellValue($columnIndex . $i + 3, "TOTAL");
                $sheet->mergeCells($columnStart . $i + 2 . ':' . $columnIndex . $i + 2);
                $style->getStyle($columnStart . '7:' . $columnIndex . '8')->applyFromArray($filSky);

                ++$columnIndex;
                $sheet->setCellValue($columnIndex . $i + 2, "Webinar");
                $sheet->mergeCells($columnIndex . $i + 2 . ':' . $columnIndex . $i + 3);

                ++$columnIndex;
                $sheet->setCellValue($columnIndex . $i + 2, "Kesimpulan");
                $sheet->mergeCells($columnIndex . $i + 2 . ':' . $columnIndex . $i + 3);
                $sheet->mergeCells("N" . $i + 1 . ':' . $columnIndex . $i + 1);
                // $style->getStyle('A6:' . $columnIndex . '8')->applyFromArray($headerStyle);


                // $style = $sheet->getStyle('A7:' . $columnIndex . '8');
                // $style->applyFromArray($headerStyle);
                // $style->getAlignment()->setWrapText(true);

                // render data
                // end mkn
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
                $sheet->setCellValue('D4', date('Y-m-d', strtotime($this->filter['date_start'])));
                $sheet->setCellValue('D5', date('Y-m-d', strtotime($this->filter['date_end'])));

                $datas = $this->data;
                // $exportData = collect();
                $j = 1;
                $row = $i + $j + 3;
                foreach ($datas as $userId => $userData) {
                    $userName = $userData['user_name'];
                    // dd($userName)
                    // dd('A' . $row);
                    $sheet->setCellValue('A' . $row, $j);
                    $sheet->setCellValue('B' . $row,  $userData['user_name']);
                    $sheet->setCellValue('C' . $row,  Carbon::parse($userData['userdata']->dob)->age);
                    $sheet->setCellValue('D' . $row, "");
                    // $pushData[] = "tb";
                    // $pushData[] = "bb";
                    // $pushData[] = "fat";
                    // $pushData[] = "pinggang";
                    // $pushData[] = "tkndrh";
                    // $pushData[] = "gdp";
                    // $pushData[] = "gd2";
                    // $pushData[] = "kol";
                    // $pushData[] = "as_ur";
                    // $pushData[] = "skor";
                    $columnIndex = 'M';
                    $columnStart = 'N';
                    $dateStart = Carbon::parse($this->filter['date_start']);
                    $dateEnd = Carbon::parse($this->filter['date_end']);
                    $kal_frek = 0;
                    $kal_total = 0;
                    for ($date = $dateStart; $date->lte($dateEnd); $date->addDay()) {
                        $kal_val =  $userData['data'][$date->format('Y')][$date->format('m')][$date->format('d')][0]['kal_val'] ?? '';
                        $sheet->setCellValue(++$columnIndex . $row,  $kal_val);
                        !empty($kal_val) ? $kal_frek++ : '';
                        !empty($kal_val) ? $kal_total += $kal_val : 0;
                    }
                    ++$columnIndex;
                    $sheet->setCellValue($columnIndex . $row, $kal_total);
                    ++$columnIndex;
                    $sheet->setCellValue($columnIndex . $row, $kal_frek);
                    if ($kal_total >= 600 && $kal_frek >= 3) {
                        $style->getStyle($columnIndex . $row,)->applyFromArray($filSuccess);
                    } else
                    if ($kal_frek == 1) {
                        $style->getStyle($columnIndex . $row,)->applyFromArray($filDanger);
                    } else
                    if ($kal_frek >= 2) {
                        $style->getStyle($columnIndex . $row,)->applyFromArray($filWarning);
                    } else {
                        $style->getStyle($columnIndex . $row,)->applyFromArray($filBlack);
                    }

                    // Stetching
                    $str_frek = 0;
                    $dateStart = Carbon::parse($this->filter['date_start']);
                    $dateEnd = Carbon::parse($this->filter['date_end']);

                    for ($date = $dateStart; $date->lte($dateEnd); $date->addDay()) {
                        $str_val =  $userData['data'][$date->format('Y')][$date->format('m')][$date->format('d')][0]['str_attch'] ?? '';

                        $sheet->setCellValue(++$columnIndex . $row,  !empty($str_val) ? '1' : '');
                        !empty($str_val) ? $str_frek++ : '';
                    }
                    ++$columnIndex;
                    if ($str_frek == 0) {
                        $style->getStyle($columnIndex . $row,)->applyFromArray($filBlack);
                    }
                    if ($str_frek == 1) {
                        $style->getStyle($columnIndex . $row,)->applyFromArray($filWarning);
                    }
                    if ($str_frek >= 2) {
                        $style->getStyle($columnIndex . $row,)->applyFromArray($filSuccess);
                    }
                    $sheet->setCellValue($columnIndex . $row, $str_frek);

                    // Gym
                    $gym_frek = 0;
                    $dateStart = Carbon::parse($this->filter['date_start']);
                    $dateEnd = Carbon::parse($this->filter['date_end']);

                    for ($date = $dateStart; $date->lte($dateEnd); $date->addDay()) {
                        $gym_val =  $userData['data'][$date->format('Y')][$date->format('m')][$date->format('d')][0]['gym_attch'] ?? '';

                        $sheet->setCellValue(++$columnIndex . $row,  !empty($gym_val) ? '1' : '');
                        !empty($gym_val) ? $gym_frek++ : '';
                    }
                    ++$columnIndex;
                    if ($gym_frek == 0) {
                        $style->getStyle($columnIndex . $row,)->applyFromArray($filBlack);
                    }
                    if ($gym_frek == 1) {
                        $style->getStyle($columnIndex . $row,)->applyFromArray($filWarning);
                    }
                    if ($gym_frek >= 2) {
                        $style->getStyle($columnIndex . $row,)->applyFromArray($filSuccess);
                    }

                    $sheet->setCellValue($columnIndex . $row, $gym_frek);

                    // MKN
                    $mkn_frek = 0;
                    $dateStart = Carbon::parse($this->filter['date_start']);
                    $dateEnd = Carbon::parse($this->filter['date_end']);

                    for ($date = $dateStart; $date->lte($dateEnd); $date->addDay()) {
                        $mkn_val =  $userData['data'][$date->format('Y')][$date->format('m')][$date->format('d')][0]['mkn_attch'] ?? '';

                        $sheet->setCellValue(++$columnIndex . $row,  !empty($mkn_val) ? '1' : '');
                        !empty($mkn_val) ? $mkn_frek++ : '';
                    }
                    ++$columnIndex;
                    if ($mkn_frek == 0) {
                        $style->getStyle($columnIndex . $row,)->applyFromArray($filBlack);
                    }
                    if ($mkn_frek == 1) {
                        $style->getStyle($columnIndex . $row,)->applyFromArray($filWarning);
                    }
                    if ($mkn_frek >= 5) {
                        $style->getStyle($columnIndex . $row,)->applyFromArray($filSuccess);
                    }
                    $sheet->setCellValue($columnIndex . $row, $mkn_frek);


                    // ++$columnIndex;
                    // $sheet->setCellValue($columnIndex . $row, $kal_frek);


                    $j++;
                    $row++;
                }
                // dd($this->exportDatas);
                // $this->total_data = $i - 1;
                $row--;

                $style = $event->sheet->getDelegate();
                ++$columnIndex;
                ++$columnIndex;
                $sheet->mergeCells('A1:' . $columnIndex . '1');
                $sheet->setCellValue('A1', 'SEBUSE');
                $sheet->setCellValue('N6', 'EVIDENCE');
                $style->getStyle('A6:' . $columnIndex . '8')->applyFromArray($centerStyle);
                $style->getStyle('A6:' . $columnIndex . '8')->applyFromArray($headerStyle)->getAlignment()
                    ->setWrapText(true)->setHorizontal('center')     // Rata tengah horizontal (opsional jika dibutuhkan)
                    ->setVertical('center');
                $style->getStyle('A1')->applyFromArray($centerStyle);
                $style->getStyle('A1')->applyFromArray($boldStyle);
                $style->getStyle('A6:' . $columnIndex .   $row)->applyFromArray($borderStyle);
                // $style->getStyle('J8:' . $columnIndex . '' . ($this->total_data + 7))->applyFromArray($filGreen);
                // $style->getStyle('I8:' . $columnIndex . '' . ($this->total_data + 7))->applyFromArray($centerStyle);
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
