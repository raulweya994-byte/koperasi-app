<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class AnggotaKoperasiExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithTitle
{
    protected $data;
    
    public function __construct($data)
    {
        $this->data = $data;
    }
    
    public function collection()
    {
        return $this->data->map(function($anggota, $index) {
            return [
                $index + 1,
                $anggota->no_anggota ?? '-',
                $anggota->nama ?? $anggota->nama_lengkap ?? '-',
                $anggota->nik ?? '-',
                $anggota->tempat_lahir ?? '-',
                $anggota->tanggal_lahir ? \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d/m/Y') : '-',
                $anggota->jenis_kelamin == 'L' ? 'Laki-laki' : ($anggota->jenis_kelamin == 'P' ? 'Perempuan' : '-'),
                $anggota->status_perkawinan ?? '-',
                $anggota->pendidikan_terakhir ?? '-',
                $anggota->agama ?? '-',
                $anggota->no_hp ?? '-',
                $anggota->email ?? '-',
                $anggota->koperasi->nama_usaha ?? '-',
                $anggota->distrik ?? '-',
                $anggota->alamat_lengkap ?? $anggota->alamat ?? '-',
                $anggota->nama_usaha ?? '-',
                $anggota->bidang_usaha ?? '-',
                $anggota->simpanan_pokok ?? 0,
                $anggota->simpanan_wajib ?? 0,
                $anggota->status ?? '-',
                $anggota->tanggal_bergabung ? \Carbon\Carbon::parse($anggota->tanggal_bergabung)->format('d/m/Y') : '-',
            ];
        });
    }
    
    public function headings(): array
    {
        return [
            'No',
            'No. Anggota',
            'Nama Lengkap',
            'NIK',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Status Perkawinan',
            'Pendidikan',
            'Agama',
            'No. HP',
            'Email',
            'Koperasi',
            'Distrik',
            'Alamat',
            'Nama Usaha',
            'Bidang Usaha',
            'Simpanan Pokok',
            'Simpanan Wajib',
            'Status',
            'Tgl Bergabung',
        ];
    }
    
    public function styles(Worksheet $sheet)
    {
        // Style header
        $sheet->getStyle('A1:U1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '1a3a6e'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);
        
        // Auto height for header
        $sheet->getRowDimension(1)->setRowHeight(25);
        
        // Style data rows
        $lastRow = $this->data->count() + 1;
        $sheet->getStyle('A2:U' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'CCCCCC'],
                ],
            ],
        ]);
        
        // Alignment for specific columns
        $sheet->getStyle('A2:A' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('G2:G' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('R2:S' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $sheet->getStyle('T2:T' . $lastRow)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        
        // Number format for currency
        $sheet->getStyle('R2:S' . $lastRow)->getNumberFormat()->setFormatCode('#,##0');
        
        return [];
    }
    
    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 15,  // No. Anggota
            'C' => 25,  // Nama
            'D' => 18,  // NIK
            'E' => 15,  // Tempat Lahir
            'F' => 12,  // Tgl Lahir
            'G' => 12,  // JK
            'H' => 15,  // Status Kawin
            'I' => 12,  // Pendidikan
            'J' => 10,  // Agama
            'K' => 15,  // No. HP
            'L' => 25,  // Email
            'M' => 30,  // Koperasi
            'N' => 15,  // Distrik
            'O' => 35,  // Alamat
            'P' => 20,  // Nama Usaha
            'Q' => 15,  // Bidang Usaha
            'R' => 15,  // Simpanan Pokok
            'S' => 15,  // Simpanan Wajib
            'T' => 10,  // Status
            'U' => 12,  // Tgl Bergabung
        ];
    }
    
    public function title(): string
    {
        return 'Rekap Anggota Koperasi';
    }
}
