// ===== EXPORT FUNCTIONS WITH LOGO FOR ANGGOTA DATA - SEMUA KOLOM LENGKAP =====

// Helper function to extract text from cell
function getCellText(cell) {
    if (!cell) return '-';
    const text = cell.innerText.trim();
    return text || '-';
}

// Export to Excel - SEMUA DATA LENGKAP (18 Kolom)
function exportExcel() {
    // Buat workbook baru
    const wb = XLSX.utils.book_new();
    
    // Siapkan data untuk Excel
    const excelData = [];
    
    // Header
    excelData.push([
        '#', 'No. Anggota', 'Nama Lengkap', 'NIK', 'Tempat Lahir', 'Tanggal Lahir', 
        'Jenis Kelamin', 'Status Perkawinan', 'Pendidikan Terakhir', 'Agama', 
        'No. HP', 'Alamat', 'Koperasi', 'Nama Usaha', 
        'Simpanan Pokok', 'Simpanan Wajib', 'Total Simpanan', 'Status'
    ]);
    
    // Ambil data dari tabel
    const rows = document.querySelectorAll('.table-modern tbody tr');
    let no = 1;
    
    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        if (cells.length > 1 && !cells[0].querySelector('.empty-state')) {
            // Ekstrak semua data
            const noAnggota = getCellText(cells[0]);
            const nama = cells[2].querySelector('strong') ? cells[2].querySelector('strong').innerText.trim() : getCellText(cells[2]).split('\n')[0];
            const nik = cells[2].querySelector('small') ? cells[2].querySelector('small').innerText.replace('NIK:', '').replace('🆔', '').trim() : '-';
            const tempatLahir = getCellText(cells[3]).split('\n')[0];
            const tglLahir = getCellText(cells[3]).split('\n')[1] || '-';
            const jk = getCellText(cells[4]);
            const statusKawin = getCellText(cells[5]);
            const pendidikan = getCellText(cells[6]);
            const agama = getCellText(cells[7]);
            const noHp = getCellText(cells[8]).split('\n')[0].replace('📱', '').trim();
            const alamat = getCellText(cells[9]).split('\n')[0].replace('📍', '').trim();
            const koperasi = getCellText(cells[10]).replace('🏢', '').trim();
            const usaha = getCellText(cells[11]).replace('🏪', '').trim();
            const simpananPokok = getCellText(cells[14]).replace('Rp', '').replace(/\./g, '').trim();
            const simpananWajib = getCellText(cells[15]).replace('Rp', '').replace(/\./g, '').trim();
            const totalSimpanan = getCellText(cells[16]).replace('Rp', '').replace(/\./g, '').trim();
            const status = getCellText(cells[18]);
            
            excelData.push([
                no, noAnggota, nama, nik, tempatLahir, tglLahir, jk, statusKawin,
                pendidikan, agama, noHp, alamat, koperasi, usaha,
                simpananPokok, simpananWajib, totalSimpanan, status
            ]);
            no++;
        }
    });
    
    // Buat worksheet dari data
    const ws = XLSX.utils.aoa_to_sheet(excelData);
    
    // Set column widths
    ws['!cols'] = [
        { wch: 5 },   // #
        { wch: 15 },  // No. Anggota
        { wch: 25 },  // Nama
        { wch: 18 },  // NIK
        { wch: 15 },  // Tempat Lahir
        { wch: 12 },  // Tgl Lahir
        { wch: 8 },   // JK
        { wch: 15 },  // Status Kawin
        { wch: 15 },  // Pendidikan
        { wch: 12 },  // Agama
        { wch: 15 },  // No. HP
        { wch: 30 },  // Alamat
        { wch: 25 },  // Koperasi
        { wch: 25 },  // Usaha
        { wch: 15 },  // Simp. Pokok
        { wch: 15 },  // Simp. Wajib
        { wch: 15 },  // Total Simp.
        { wch: 12 }   // Status
    ];
    
    // Style untuk header
    const headerStyle = {
        font: { bold: true, color: { rgb: "FFFFFF" } },
        fill: { fgColor: { rgb: "1A3A6E" } },
        alignment: { horizontal: "center", vertical: "center" }
    };
    
    // Apply style ke header (baris pertama)
    const range = XLSX.utils.decode_range(ws['!ref']);
    for (let C = range.s.c; C <= range.e.c; ++C) {
        const address = XLSX.utils.encode_col(C) + "1";
        if (!ws[address]) continue;
        ws[address].s = headerStyle;
    }
    
    // Tambahkan worksheet ke workbook
    XLSX.utils.book_append_sheet(wb, ws, "Data Anggota");
    
    // Save file
    const filename = 'Data_Lengkap_Anggota_Koperasi_' + new Date().toISOString().slice(0,10) + '.xlsx';
    XLSX.writeFile(wb, filename);
}

// Export to PDF with Logo - SEMUA DATA LENGKAP (18 Kolom)
function exportPDFAnggota() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('l', 'mm', 'a3'); // A3 Landscape untuk muat semua kolom
    
    // Load logo
    const img = new Image();
    img.crossOrigin = 'Anonymous';
    img.src = window.location.origin + '/logo.png';
    
    img.onload = function() {
        // Header border
        doc.setDrawColor(26, 58, 110);
        doc.setLineWidth(1);
        doc.line(10, 10, 410, 10);
        doc.line(10, 52, 410, 52);
        
        // Logo kiri
        doc.addImage(img, 'PNG', 15, 15, 25, 30);
        
        // Judul
        doc.setFontSize(18);
        doc.setFont(undefined, 'bold');
        doc.setTextColor(26, 58, 110);
        doc.text('DATA LENGKAP ANGGOTA KOPERASI', 210, 20, { align: 'center' });
        
        doc.setFontSize(14);
        doc.setFont(undefined, 'bold');
        doc.setTextColor(0, 0, 0);
        doc.text('DINAS PERINDUSTRIAN, PERDAGANGAN DAN KOPERASI', 210, 28, { align: 'center' });
        
        doc.setFontSize(11);
        doc.setFont(undefined, 'normal');
        doc.text('Kabupaten Tolikara, Papua Pegunungan', 210, 35, { align: 'center' });
        
        // Info tanggal
        doc.setFontSize(9);
        doc.setFont(undefined, 'italic');
        doc.setTextColor(100, 100, 100);
        const tanggalCetak = new Date().toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        doc.text('Tanggal Cetak: ' + tanggalCetak, 210, 48, { align: 'center' });
        
        // Ambil SEMUA data dari tabel
        const tableData = [];
        const rows = document.querySelectorAll('.table-modern tbody tr');
        let no = 1;
        
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length > 1 && !cells[0].querySelector('.empty-state')) {
                // Ekstrak semua data
                const noAnggota = getCellText(cells[0]);
                const nama = cells[2].querySelector('strong') ? cells[2].querySelector('strong').innerText.trim() : getCellText(cells[2]).split('\n')[0];
                const nik = cells[2].querySelector('small') ? cells[2].querySelector('small').innerText.replace('NIK:', '').replace('🆔', '').trim() : '-';
                const tempatLahir = getCellText(cells[3]).split('\n')[0];
                const tglLahir = getCellText(cells[3]).split('\n')[1] || '-';
                const jk = getCellText(cells[4]);
                const statusKawin = getCellText(cells[5]);
                const pendidikan = getCellText(cells[6]);
                const agama = getCellText(cells[7]);
                const noHp = getCellText(cells[8]).split('\n')[0].replace('📱', '').trim();
                const alamat = getCellText(cells[9]).split('\n')[0].replace('📍', '').trim();
                const koperasi = getCellText(cells[10]).replace('🏢', '').trim();
                const usaha = getCellText(cells[11]).replace('🏪', '').trim();
                const simpananPokok = getCellText(cells[14]);
                const simpananWajib = getCellText(cells[15]);
                const totalSimpanan = getCellText(cells[16]);
                const status = getCellText(cells[18]);
                
                tableData.push([
                    no, noAnggota, nama, nik, tempatLahir, tglLahir, jk, statusKawin, 
                    pendidikan, agama, noHp, alamat, koperasi, usaha, 
                    simpananPokok, simpananWajib, totalSimpanan, status
                ]);
                no++;
            }
        });
        
        // Buat tabel dengan SEMUA kolom
        doc.autoTable({
            head: [[
                '#', 'No. Anggota', 'Nama', 'NIK', 'Tempat Lahir', 'Tgl Lahir', 'JK', 'Status Kawin',
                'Pendidikan', 'Agama', 'No. HP', 'Alamat', 'Koperasi', 'Usaha',
                'Simp. Pokok', 'Simp. Wajib', 'Total Simp.', 'Status'
            ]],
            body: tableData,
            startY: 57,
            styles: { 
                fontSize: 6, 
                cellPadding: 2,
                lineColor: [200, 200, 200],
                lineWidth: 0.1
            },
            headStyles: { 
                fillColor: [26, 58, 110], 
                fontStyle: 'bold',
                halign: 'center',
                textColor: [255, 255, 255],
                fontSize: 6
            },
            alternateRowStyles: { fillColor: [240, 245, 255] },
            margin: { left: 10, right: 10 },
            columnStyles: {
                0: { halign: 'center', cellWidth: 8 },
                1: { cellWidth: 22 },
                2: { cellWidth: 30 },
                3: { cellWidth: 25 },
                4: { cellWidth: 20 },
                5: { cellWidth: 18 },
                6: { halign: 'center', cellWidth: 10 },
                7: { cellWidth: 18 },
                8: { cellWidth: 18 },
                9: { cellWidth: 15 },
                10: { cellWidth: 22 },
                11: { cellWidth: 25 },
                12: { cellWidth: 30 },
                13: { cellWidth: 25 },
                14: { halign: 'right', cellWidth: 20 },
                15: { halign: 'right', cellWidth: 20 },
                16: { halign: 'right', cellWidth: 22 },
                17: { halign: 'center', cellWidth: 15 }
            }
        });
        
        // Footer
        const pageCount = doc.internal.getNumberOfPages();
        for (let i = 1; i <= pageCount; i++) {
            doc.setPage(i);
            doc.setFontSize(8);
            doc.setTextColor(150, 150, 150);
            doc.text('Halaman ' + i + ' dari ' + pageCount, 210, 285, { align: 'center' });
            doc.text('DISPERINDAGKOP Kab. Tolikara', 400, 285, { align: 'right' });
        }
        
        // Save PDF
        const filename = 'Data_Lengkap_Anggota_Koperasi_' + new Date().toISOString().slice(0,10) + '.pdf';
        doc.save(filename);
    };
    
    img.onerror = function() {
        alert('Logo tidak ditemukan. Pastikan file logo.png ada di folder public/');
    };
}

// Export to Word with Logo - SEMUA DATA LENGKAP (18 Kolom)
function exportWordAnggota() {
    // Convert logo to base64
    const img = new Image();
    img.crossOrigin = 'Anonymous';
    img.src = window.location.origin + '/logo.png';
    
    img.onload = function() {
        // Create canvas to convert image to base64
        const canvas = document.createElement('canvas');
        canvas.width = img.width;
        canvas.height = img.height;
        const ctx = canvas.getContext('2d');
        ctx.drawImage(img, 0, 0);
        const base64Logo = canvas.toDataURL('image/png');
        
        const tanggalCetak = new Date().toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        
        let html = `
            <html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'>
            <head>
                <meta charset='utf-8'>
                <title>Data Lengkap Anggota Koperasi</title>
                <style>
                    @page { size: A3 landscape; margin: 1.5cm; }
                    body { font-family: Arial, sans-serif; margin: 0; }
                    .header-container { 
                        text-align: center; 
                        margin-bottom: 20px; 
                        border-bottom: 3px solid #1a3a6e; 
                        padding-bottom: 15px;
                    }
                    .header-table { width: 100%; border: none; margin-bottom: 0; }
                    .logo-cell { width: 100px; text-align: center; vertical-align: middle; padding: 10px; }
                    .logo-img { width: 70px; height: auto; display: block; margin: 0 auto; }
                    .text-cell { text-align: center; vertical-align: middle; padding: 10px 20px; }
                    .title-main { margin: 0 0 8px 0; color: #1a3a6e; font-size: 20px; font-weight: bold; text-transform: uppercase; }
                    .title-sub { margin: 0 0 6px 0; font-size: 14px; font-weight: bold; color: #000; }
                    .location { margin: 0 0 6px 0; font-size: 12px; color: #333; }
                    .date { margin: 0; font-size: 11px; color: #666; font-style: italic; }
                    table.data-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
                    table.data-table th, table.data-table td { border: 1px solid #ddd; padding: 6px; text-align: left; font-size: 9px; }
                    table.data-table th { background-color: #1a3a6e; color: white; font-weight: bold; text-align: center; }
                    table.data-table tr:nth-child(even) { background-color: #f0f5ff; }
                    .footer { margin-top: 20px; padding-top: 15px; border-top: 2px solid #ddd; font-size: 10px; color: #666; }
                </style>
            </head>
            <body>
                <div class="header-container">
                    <table class="header-table" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="logo-cell">
                                <img src="${base64Logo}" class="logo-img" alt="Logo">
                            </td>
                            <td class="text-cell">
                                <h1 class="title-main">DATA LENGKAP ANGGOTA KOPERASI</h1>
                                <h2 class="title-sub">DINAS PERINDUSTRIAN, PERDAGANGAN DAN KOPERASI</h2>
                                <p class="location">Kabupaten Tolikara, Papua Pegunungan</p>
                                <p class="date">Tanggal: ${tanggalCetak}</p>
                            </td>
                            <td class="logo-cell"></td>
                        </tr>
                    </table>
                </div>
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 3%;">#</th>
                            <th style="width: 7%;">No. Anggota</th>
                            <th style="width: 10%;">Nama</th>
                            <th style="width: 8%;">NIK</th>
                            <th style="width: 7%;">Tempat Lahir</th>
                            <th style="width: 6%;">Tgl Lahir</th>
                            <th style="width: 3%;">JK</th>
                            <th style="width: 6%;">Status Kawin</th>
                            <th style="width: 6%;">Pendidikan</th>
                            <th style="width: 5%;">Agama</th>
                            <th style="width: 7%;">No. HP</th>
                            <th style="width: 8%;">Alamat</th>
                            <th style="width: 9%;">Koperasi</th>
                            <th style="width: 8%;">Usaha</th>
                            <th style="width: 6%;">Simp. Pokok</th>
                            <th style="width: 6%;">Simp. Wajib</th>
                            <th style="width: 7%;">Total Simp.</th>
                            <th style="width: 5%;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
        `;
        
        const rows = document.querySelectorAll('.table-modern tbody tr');
        let no = 1;
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length > 1 && !cells[0].querySelector('.empty-state')) {
                const noAnggota = getCellText(cells[0]);
                const nama = cells[2].querySelector('strong') ? cells[2].querySelector('strong').innerText.trim() : getCellText(cells[2]).split('\n')[0];
                const nik = cells[2].querySelector('small') ? cells[2].querySelector('small').innerText.replace('NIK:', '').replace('🆔', '').trim() : '-';
                const tempatLahir = getCellText(cells[3]).split('\n')[0];
                const tglLahir = getCellText(cells[3]).split('\n')[1] || '-';
                const jk = getCellText(cells[4]);
                const statusKawin = getCellText(cells[5]);
                const pendidikan = getCellText(cells[6]);
                const agama = getCellText(cells[7]);
                const noHp = getCellText(cells[8]).split('\n')[0].replace('📱', '').trim();
                const alamat = getCellText(cells[9]).split('\n')[0].replace('📍', '').trim();
                const koperasi = getCellText(cells[10]).replace('🏢', '').trim();
                const usaha = getCellText(cells[11]).replace('🏪', '').trim();
                const simpananPokok = getCellText(cells[14]);
                const simpananWajib = getCellText(cells[15]);
                const totalSimpanan = getCellText(cells[16]);
                const status = getCellText(cells[18]);
                
                html += `<tr>
                    <td style="text-align: center;">${no}</td>
                    <td>${noAnggota}</td>
                    <td>${nama}</td>
                    <td>${nik}</td>
                    <td>${tempatLahir}</td>
                    <td>${tglLahir}</td>
                    <td style="text-align: center;">${jk}</td>
                    <td>${statusKawin}</td>
                    <td>${pendidikan}</td>
                    <td>${agama}</td>
                    <td>${noHp}</td>
                    <td>${alamat}</td>
                    <td>${koperasi}</td>
                    <td>${usaha}</td>
                    <td style="text-align: right;">${simpananPokok}</td>
                    <td style="text-align: right;">${simpananWajib}</td>
                    <td style="text-align: right;">${totalSimpanan}</td>
                    <td style="text-align: center;">${status}</td>
                </tr>`;
                no++;
            }
        });
        
        html += `
                    </tbody>
                </table>
                <div class="footer">
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 50%; text-align: left;"><strong>DISPERINDAGKOP Kab. Tolikara</strong></td>
                            <td style="width: 50%; text-align: right;">Dicetak: ${new Date().toLocaleString('id-ID')}</td>
                        </tr>
                    </table>
                </div>
            </body>
            </html>
        `;
        
        const blob = new Blob(['\ufeff', html], {
            type: 'application/msword'
        });
        
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = 'Data_Lengkap_Anggota_Koperasi_' + new Date().toISOString().slice(0,10) + '.doc';
        link.click();
        URL.revokeObjectURL(url);
    };
    
    img.onerror = function() {
        alert('Logo tidak dapat dimuat. Pastikan file logo.png ada di folder public/');
    };
}

// Print Data with Logo - SEMUA DATA LENGKAP (18 Kolom)
function printDataAnggota() {
    const tanggalCetak = new Date().toLocaleDateString('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    
    let html = `
        <html>
        <head>
            <title>Print Data Lengkap Anggota Koperasi</title>
            <style>
                @page { size: A3 landscape; margin: 1.5cm; }
                body { font-family: Arial, sans-serif; margin: 0; }
                .header { 
                    text-align: center; 
                    margin-bottom: 20px; 
                    border-bottom: 3px solid #1a3a6e; 
                    padding-bottom: 15px;
                }
                .header-table { width: 100%; margin-bottom: 10px; }
                .header h1 { margin: 0; font-size: 22px; color: #1a3a6e; font-weight: bold; text-transform: uppercase; }
                .header h3 { margin: 5px 0; font-size: 16px; color: #333; font-weight: bold; }
                .header p { margin: 5px 0; font-size: 13px; color: #666; }
                .header .italic { font-style: italic; font-size: 11px; }
                table.data-table { width: 100%; border-collapse: collapse; margin-top: 15px; }
                table.data-table th, 
                table.data-table td { border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 9px; }
                table.data-table th { background-color: #1a3a6e; color: white; font-weight: bold; text-align: center; }
                table.data-table tr:nth-child(even) { background-color: #f0f5ff; }
                .footer { 
                    margin-top: 20px; 
                    padding-top: 15px; 
                    border-top: 2px solid #ddd; 
                    font-size: 10px; 
                    color: #666;
                }
                .footer-table { width: 100%; }
                @media print {
                    .no-print { display: none; }
                    body { margin: 0; }
                }
            </style>
        </head>
        <body>
            <div class="header">
                <table class="header-table">
                    <tr>
                        <td style="width: 12%; text-align: center; vertical-align: middle;">
                            <img src="${window.location.origin}/logo.png" style="width: 60px; height: auto;">
                        </td>
                        <td style="width: 76%; text-align: center; vertical-align: middle;">
                            <h1>DATA LENGKAP ANGGOTA KOPERASI</h1>
                            <h3>DINAS PERINDUSTRIAN, PERDAGANGAN DAN KOPERASI</h3>
                            <p>Kabupaten Tolikara, Papua Pegunungan</p>
                            <p class="italic">Tanggal: ${tanggalCetak}</p>
                        </td>
                        <td style="width: 12%;"></td>
                    </tr>
                </table>
            </div>
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 3%;">#</th>
                        <th style="width: 7%;">No. Anggota</th>
                        <th style="width: 10%;">Nama</th>
                        <th style="width: 8%;">NIK</th>
                        <th style="width: 7%;">Tempat Lahir</th>
                        <th style="width: 6%;">Tgl Lahir</th>
                        <th style="width: 3%;">JK</th>
                        <th style="width: 6%;">Status Kawin</th>
                        <th style="width: 6%;">Pendidikan</th>
                        <th style="width: 5%;">Agama</th>
                        <th style="width: 7%;">No. HP</th>
                        <th style="width: 8%;">Alamat</th>
                        <th style="width: 9%;">Koperasi</th>
                        <th style="width: 8%;">Usaha</th>
                        <th style="width: 6%;">Simp. Pokok</th>
                        <th style="width: 6%;">Simp. Wajib</th>
                        <th style="width: 7%;">Total Simp.</th>
                        <th style="width: 5%;">Status</th>
                    </tr>
                </thead>
                <tbody>
    `;
    
    const rows = document.querySelectorAll('.table-modern tbody tr');
    let no = 1;
    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        if (cells.length > 1 && !cells[0].querySelector('.empty-state')) {
            const noAnggota = getCellText(cells[0]);
            const nama = cells[2].querySelector('strong') ? cells[2].querySelector('strong').innerText.trim() : getCellText(cells[2]).split('\n')[0];
            const nik = cells[2].querySelector('small') ? cells[2].querySelector('small').innerText.replace('NIK:', '').replace('🆔', '').trim() : '-';
            const tempatLahir = getCellText(cells[3]).split('\n')[0];
            const tglLahir = getCellText(cells[3]).split('\n')[1] || '-';
            const jk = getCellText(cells[4]);
            const statusKawin = getCellText(cells[5]);
            const pendidikan = getCellText(cells[6]);
            const agama = getCellText(cells[7]);
            const noHp = getCellText(cells[8]).split('\n')[0].replace('📱', '').trim();
            const alamat = getCellText(cells[9]).split('\n')[0].replace('📍', '').trim();
            const koperasi = getCellText(cells[10]).replace('🏢', '').trim();
            const usaha = getCellText(cells[11]).replace('🏪', '').trim();
            const simpananPokok = getCellText(cells[14]);
            const simpananWajib = getCellText(cells[15]);
            const totalSimpanan = getCellText(cells[16]);
            const status = getCellText(cells[18]);
            
            html += `<tr>
                <td style="text-align: center;">${no}</td>
                <td>${noAnggota}</td>
                <td>${nama}</td>
                <td>${nik}</td>
                <td>${tempatLahir}</td>
                <td>${tglLahir}</td>
                <td style="text-align: center;">${jk}</td>
                <td>${statusKawin}</td>
                <td>${pendidikan}</td>
                <td>${agama}</td>
                <td>${noHp}</td>
                <td>${alamat}</td>
                <td>${koperasi}</td>
                <td>${usaha}</td>
                <td style="text-align: right;">${simpananPokok}</td>
                <td style="text-align: right;">${simpananWajib}</td>
                <td style="text-align: right;">${totalSimpanan}</td>
                <td style="text-align: center;">${status}</td>
            </tr>`;
            no++;
        }
    });
    
    html += `
                </tbody>
            </table>
            <div class="footer">
                <table class="footer-table">
                    <tr>
                        <td style="width: 50%; text-align: left;"><strong>DISPERINDAGKOP Kab. Tolikara</strong></td>
                        <td style="width: 50%; text-align: right;">Dicetak: ${new Date().toLocaleString('id-ID')}</td>
                    </tr>
                </table>
            </div>
        </body>
        </html>
    `;
    
    const printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write(html);
    printWindow.document.close();
    printWindow.focus();
    
    setTimeout(() => {
        printWindow.print();
        printWindow.close();
    }, 500);
}
