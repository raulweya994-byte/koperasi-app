<?php

namespace App\Services;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\SimpleType\Jc;
use Carbon\Carbon;

class AnggotaKoperasiExportService
{
    public static function exportToWord($data, $stats, $filterText)
    {
        // Buat dokumen Word baru
        $phpWord = new PhpWord();
        $phpWord->setDefaultFontName('Arial');
        $phpWord->setDefaultFontSize(8);
        
        // Set properties dokumen
        $properties = $phpWord->getDocInfo();
        $properties->setCreator('DISPERINDAGKOP Tolikara');
        $properties->setTitle('Rekap Data Anggota Koperasi');
        $properties->setDescription('Rekap lengkap data anggota koperasi Kabupaten Tolikara');
        
        // Tambah section dengan orientasi landscape
        $section = $phpWord->addSection([
            'marginLeft' => 600,
            'marginRight' => 600,
            'marginTop' => 800,
            'marginBottom' => 600,
            'orientation' => 'landscape',
        ]);
        
        // ========== HEADER DENGAN LOGO ==========
        $headerTable = $section->addTable(['borderSize' => 0, 'cellMargin' => 0]);
        $headerTable->addRow(1000);
        
        // Cell untuk logo
        $logoCell = $headerTable->addCell(2000, ['valign' => 'center']);
        $logoPath = public_path('assets/img/logo.png');
        if (!file_exists($logoPath)) {
            $logoPath = public_path('logo.png');
        }
        if (file_exists($logoPath)) {
            $logoCell->addImage($logoPath, [
                'width' => 70,
                'height' => 70,
                'alignment' => Jc::CENTER
            ]);
        }
        
        // Cell untuk teks header
        $textCell = $headerTable->addCell(10000, ['valign' => 'center']);
        $textCell->addText(
            'PEMERINTAH KABUPATEN TOLIKARA',
            ['bold' => true, 'size' => 13, 'color' => '1a3a6e'],
            ['alignment' => Jc::CENTER, 'spaceAfter' => 0]
        );
        $textCell->addText(
            'DINAS PERINDUSTRIAN, PERDAGANGAN, KOPERASI DAN UMKM',
            ['bold' => true, 'size' => 14, 'color' => '1a3a6e'],
            ['alignment' => Jc::CENTER, 'spaceAfter' => 50]
        );
        $textCell->addText(
            'Jl. Raya Karubaga, Kabupaten Tolikara, Papua Pegunungan',
            ['size' => 9, 'color' => '666666'],
            ['alignment' => Jc::CENTER, 'spaceAfter' => 0]
        );
        
        // Garis pemisah
        $section->addLine([
            'weight' => 2,
            'width' => 450,
            'height' => 0,
            'color' => '1a3a6e'
        ]);
        
        $section->addTextBreak(1);
        
        // ========== JUDUL ==========
        $section->addText(
            'REKAP DATA ANGGOTA KOPERASI',
            ['bold' => true, 'size' => 16, 'color' => '1a3a6e'],
            ['alignment' => Jc::CENTER, 'spaceAfter' => 200]
        );
        
        // Info filter dan tanggal
        $section->addText($filterText, ['size' => 9, 'color' => '333333'], ['spaceAfter' => 50]);
        $section->addText('Tanggal Cetak: ' . date('d F Y, H:i') . ' WIT', ['size' => 9, 'color' => '333333'], ['spaceAfter' => 200]);
        
        // ========== RINGKASAN ==========
        $section->addText('RINGKASAN DATA', ['bold' => true, 'size' => 11, 'color' => '1a3a6e'], ['spaceAfter' => 100]);
        
        $statsTable = $section->addTable(['borderSize' => 6, 'borderColor' => '1a3a6e', 'cellMargin' => 80]);
        $statsTable->addRow(400);
        $statsTable->addCell(3000, ['bgColor' => '1a3a6e'])->addText('Total Anggota', ['bold' => true, 'color' => 'FFFFFF', 'size' => 9], ['alignment' => Jc::CENTER]);
        $statsTable->addCell(3000, ['bgColor' => '10b981'])->addText('Aktif', ['bold' => true, 'color' => 'FFFFFF', 'size' => 9], ['alignment' => Jc::CENTER]);
        $statsTable->addCell(3000, ['bgColor' => 'f59e0b'])->addText('Pending', ['bold' => true, 'color' => 'FFFFFF', 'size' => 9], ['alignment' => Jc::CENTER]);
        $statsTable->addCell(3000, ['bgColor' => '6b7280'])->addText('Nonaktif', ['bold' => true, 'color' => 'FFFFFF', 'size' => 9], ['alignment' => Jc::CENTER]);
        
        $statsTable->addRow(400);
        $statsTable->addCell(3000)->addText($stats['total'] . ' Anggota', ['bold' => true, 'size' => 10], ['alignment' => Jc::CENTER]);
        $statsTable->addCell(3000)->addText($stats['aktif'], ['bold' => true, 'size' => 10, 'color' => '10b981'], ['alignment' => Jc::CENTER]);
        $statsTable->addCell(3000)->addText($stats['pending'], ['bold' => true, 'size' => 10, 'color' => 'f59e0b'], ['alignment' => Jc::CENTER]);
        $statsTable->addCell(3000)->addText($stats['nonaktif'], ['bold' => true, 'size' => 10, 'color' => '6b7280'], ['alignment' => Jc::CENTER]);
        
        $section->addTextBreak(2);
        
        // ========== TABEL DATA LENGKAP (21 KOLOM) ==========
        $section->addText('DAFTAR LENGKAP ANGGOTA KOPERASI', ['bold' => true, 'size' => 11, 'color' => '1a3a6e'], ['spaceAfter' => 100]);
        
        $tableStyle = ['borderSize' => 6, 'borderColor' => '1a3a6e', 'cellMargin' => 40];
        $table = $section->addTable($tableStyle);
        
        // Header tabel (21 kolom)
        $table->addRow(500, ['tblHeader' => true]);
        $headers = [
            ['No', 300],
            ['No. Anggota', 900],
            ['Nama Lengkap', 1400],
            ['NIK', 1000],
            ['Tempat Lahir', 800],
            ['Tgl Lahir', 700],
            ['JK', 400],
            ['Status Kawin', 700],
            ['Pendidikan', 600],
            ['Agama', 500],
            ['No. HP', 900],
            ['Email', 1200],
            ['Koperasi', 1400],
            ['Distrik', 700],
            ['Alamat', 1200],
            ['Nama Usaha', 1000],
            ['Bidang Usaha', 800],
            ['Simp. Pokok', 900],
            ['Simp. Wajib', 900],
            ['Status', 600],
            ['Tgl Gabung', 700]
        ];
        
        foreach ($headers as $header) {
            $table->addCell($header[1], ['bgColor' => '1a3a6e'])->addText($header[0], ['bold' => true, 'color' => 'FFFFFF', 'size' => 7], ['alignment' => Jc::CENTER]);
        }
        
        // Data rows (21 kolom)
        foreach ($data as $index => $a) {
            $bgColor = ($index % 2 == 0) ? 'f8f9fa' : 'FFFFFF';
            
            $table->addRow(350);
            $table->addCell(300, ['bgColor' => $bgColor])->addText($index + 1, ['size' => 7], ['alignment' => Jc::CENTER]);
            $table->addCell(900, ['bgColor' => $bgColor])->addText($a->no_anggota ?? '-', ['size' => 7]);
            $table->addCell(1400, ['bgColor' => $bgColor])->addText($a->nama ?? $a->nama_lengkap ?? '-', ['size' => 7, 'bold' => true]);
            $table->addCell(1000, ['bgColor' => $bgColor])->addText($a->nik ?? '-', ['size' => 7]);
            $table->addCell(800, ['bgColor' => $bgColor])->addText($a->tempat_lahir ?? '-', ['size' => 7]);
            $table->addCell(700, ['bgColor' => $bgColor])->addText($a->tanggal_lahir ? Carbon::parse($a->tanggal_lahir)->format('d/m/Y') : '-', ['size' => 7]);
            $table->addCell(400, ['bgColor' => $bgColor])->addText($a->jenis_kelamin == 'L' ? 'L' : ($a->jenis_kelamin == 'P' ? 'P' : '-'), ['size' => 7], ['alignment' => Jc::CENTER]);
            $table->addCell(700, ['bgColor' => $bgColor])->addText($a->status_perkawinan ?? '-', ['size' => 7]);
            $table->addCell(600, ['bgColor' => $bgColor])->addText($a->pendidikan_terakhir ?? '-', ['size' => 7]);
            $table->addCell(500, ['bgColor' => $bgColor])->addText($a->agama ?? '-', ['size' => 7]);
            $table->addCell(900, ['bgColor' => $bgColor])->addText($a->no_hp ?? '-', ['size' => 7]);
            $table->addCell(1200, ['bgColor' => $bgColor])->addText($a->email ?? '-', ['size' => 7]);
            $table->addCell(1400, ['bgColor' => $bgColor])->addText($a->koperasi->nama_usaha ?? '-', ['size' => 7]);
            $table->addCell(700, ['bgColor' => $bgColor])->addText($a->distrik ?? '-', ['size' => 7]);
            $table->addCell(1200, ['bgColor' => $bgColor])->addText($a->alamat_lengkap ?? $a->alamat ?? '-', ['size' => 7]);
            $table->addCell(1000, ['bgColor' => $bgColor])->addText($a->nama_usaha ?? '-', ['size' => 7]);
            $table->addCell(800, ['bgColor' => $bgColor])->addText($a->bidang_usaha ?? '-', ['size' => 7]);
            $table->addCell(900, ['bgColor' => $bgColor])->addText('Rp ' . number_format($a->simpanan_pokok ?? 0, 0, ',', '.'), ['size' => 7], ['alignment' => Jc::RIGHT]);
            $table->addCell(900, ['bgColor' => $bgColor])->addText('Rp ' . number_format($a->simpanan_wajib ?? 0, 0, ',', '.'), ['size' => 7], ['alignment' => Jc::RIGHT]);
            $table->addCell(600, ['bgColor' => $bgColor])->addText($a->status ?? '-', ['size' => 7], ['alignment' => Jc::CENTER]);
            $table->addCell(700, ['bgColor' => $bgColor])->addText($a->tanggal_bergabung ? Carbon::parse($a->tanggal_bergabung)->format('d/m/Y') : '-', ['size' => 7]);
        }
        
        // Footer
        $section->addTextBreak(2);
        $section->addText('Dokumen ini dicetak secara otomatis pada ' . date('d F Y, H:i:s') . ' WIT', ['size' => 7, 'italic' => true, 'color' => '999999'], ['alignment' => Jc::CENTER]);
        $section->addText('© ' . date('Y') . ' DISPERINDAGKOP Kabupaten Tolikara', ['size' => 7, 'italic' => true, 'color' => '999999'], ['alignment' => Jc::CENTER]);
        
        // Signature Section
        $section->addTextBreak(2);
        
        // Create signature table (right aligned)
        $signatureTable = $section->addTable(['alignment' => Jc::END]);
        $signatureTable->addRow();
        $signatureTable->addCell(8000); // Empty cell for spacing
        $signatureCell = $signatureTable->addCell(4000, ['valign' => 'top']);
        
        $signatureCell->addText('Karubaga, ' . date('d F Y'), ['size' => 9], ['alignment' => Jc::CENTER]);
        $signatureCell->addText('Kepala Dinas', ['size' => 9, 'bold' => true], ['alignment' => Jc::CENTER, 'spaceAfter' => 800]);
        
        $signatureCell->addText('Wugi Kogoya, S.P', ['size' => 10, 'bold' => true], ['alignment' => Jc::CENTER, 'spaceAfter' => 0]);
        $signatureCell->addText('NIP. -', ['size' => 8], ['alignment' => Jc::CENTER]);
        
        return $phpWord;
    }
}
