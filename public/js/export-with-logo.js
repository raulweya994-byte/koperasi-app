// Export Functions with Logo for Koperasi Data

// Export to PDF with Logo
function exportPDFKoperasi() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('l', 'mm', 'a4');
    
    // Load logo
    const img = new Image();
    img.src = '/logo.png';
    
    img.onload = function() {
        // Header dengan border
        doc.setDrawColor(26, 58, 110);
        doc.setLineWidth(1);
        doc.line(10, 10, 287, 10);
        doc.line(10, 52, 287, 52);
        
        // Logo
        doc.addImage(img, 'PNG', 15, 15, 25, 30);
        
        // Judul
        doc.setFontSize(18);
        doc.setFont(undefined, 'bold');
        doc.setTextColor(26, 58, 110);
        doc.text('DATA KOPERASI', 148, 20, { align: 'center' });
        
        doc.setFontSize(14);
        doc.setFont(undefined, 'bold');
        doc.setTextColor(0, 0, 0);
        doc.text('DINAS PERINDUSTRIAN, PERDAGANGAN DAN KOPERASI', 148, 28, { align: 'center' });
        
        doc.setFontSize(11);
        doc.setFont(undefined, 'normal');
        doc.text('Kabupaten Tolikara, Papua Pegunungan', 148, 35, { align: 'center' });
        
        // Info tanggal
        doc.setFontSize(9);
        doc.setFont(undefined, 'italic');
        doc.setTextColor(100, 100, 100);
        doc.text('Tanggal Cetak: ' + new Date().toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        }), 148, 48, { align: 'center' });
        
        // Table
        const tableData = [];
        const rows = document.querySelectorAll('.table-modern tbody tr');
        
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length > 1) {
                const rowData = [
                    cells[0].innerText.trim(),
                    cells[1].innerText.trim(),
                    cells[2].innerText.split('\n')[0].trim(),
                    cells[3].innerText.split('\n')[0].trim(),
                    cells[4].innerText.trim(),
                    cells[5].innerText.trim(),
                    cells[6].innerText.trim(),
                    cells[7].innerText.trim(),
                ];
                tableData.push(rowData);
            }
        });
        
        doc.autoTable({
            head: [['#', 'No. Registrasi', 'Nama Usaha', 'Pemilik', 'Distrik', 'Jenis Usaha', 'Kategori', 'Status']],
            body: tableData,
            startY: 57,
            styles: { 
                fontSize: 8, 
                cellPadding: 3,
                lineColor: [200, 200, 200],
                lineWidth: 0.1
            },
            headStyles: { 
                fillColor: [26, 58, 110], 
                fontStyle: 'bold',
                halign: 'center',
                textColor: [255, 255, 255]
            },
            alternateRowStyles: { fillColor: [240, 245, 255] },
            margin: { left: 10, right: 10 },
            columnStyles: {
                0: { halign: 'center', cellWidth: 10 },
                1: { cellWidth: 35 },
                2: { cellWidth: 50 },
                3: { cellWidth: 40 },
                4: { cellWidth: 25 },
                5: { cellWidth: 35 },
                6: { halign: 'center', cellWidth: 20 },
                7: { halign: 'center', cellWidth: 25 }
            }
        });
        
        // Footer
        const pageCount = doc.internal.getNumberOfPages();
        for (let i = 1; i <= pageCount; i++) {
            doc.setPage(i);
            doc.setFontSize(8);
            doc.setTextColor(150, 150, 150);
            doc.text('Halaman ' + i + ' dari ' + pageCount, 148, 200, { align: 'center' });
            doc.text('DISPERINDAGKOP Kab. Tolikara', 277, 200, { align: 'right' });
        }
        
        doc.save('Data_Koperasi_' + new Date().toISOString().slice(0,10) + '.pdf');
    };
    
    img.onerror = function() {
        alert('Logo tidak ditemukan di /logo.png');
    };
}

// Export to Word with Logo (Base64)
function exportWordKoperasi() {
    const img = new Image();
    img.crossOrigin = 'Anonymous';
    img.src = '/logo.png';
    
    img.onload = function() {
        // Create canvas to convert image to base64
        const canvas = document.createElement('canvas');
        canvas.width = img.width;
        canvas.height = img.height;
        const ctx = canvas.getContext('2d');
        ctx.drawImage(img, 0, 0);
        const base64Logo = canvas.toDataURL('image/png');
        
        let html = `
            <html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'>
            <head>
                <meta charset='utf-8'>
                <title>Data Koperasi</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    .header-container { 
                        text-align: center; 
                        margin-bottom: 30px; 
                        border-bottom: 3px solid #1a3a6e; 
                        padding-bottom: 20px;
                    }
                    .header-table { 
                        width: 100%; 
                        border: none; 
                        margin-bottom: 0;
                    }
                    .logo-cell { 
                        width: 120px; 
                        text-align: center; 
                        vertical-align: middle;
                        padding: 10px;
                    }
                    .logo-img { 
                        width: 90px; 
                        height: auto; 
                        display: block; 
                        margin: 0 auto;
                    }
                    .text-cell { 
                        text-align: center; 
                        vertical-align: middle; 
                        padding: 10px 20px;
                    }
                    .title-main { 
                        margin: 0 0 10px 0; 
                        color: #1a3a6e; 
                        font-size: 22px; 
                        font-weight: bold; 
                        text-transform: uppercase;
                    }
                    .title-sub { 
                        margin: 0 0 8px 0; 
                        font-size: 16px; 
                        font-weight: bold; 
                        color: #000;
                    }
                    .location { 
                        margin: 0 0 8px 0; 
                        font-size: 14px; 
                        color: #333;
                    }
                    .date { 
                        margin: 0; 
                        font-size: 12px; 
                        color: #666; 
                        font-style: italic;
                    }
                </style>
            </head>
            <body>
                <div class="header-container">
                    <table class="header-table" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="logo-cell">
                                <img src="${base64Logo}" class="logo-img" alt="Logo Tolikara">
                            </td>
                            <td class="text-cell">
                                <h1 class="title-main">DATA KOPERASI</h1>
                                <h2 class="title-sub">DINAS PERINDUSTRIAN, PERDAGANGAN DAN KOPERASI</h2>
                                <p class="location">Kabupaten Tolikara, Papua Pegunungan</p>
                                <p class="date">Tanggal: ${new Date().toLocaleDateString('id-ID', {
                                    weekday: 'long',
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                })}</p>
                            </td>
                            <td class="logo-cell"></td>
                        </tr>
                    </table>
                </div>
                <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                    <thead>
                        <tr style="background-color: #1a3a6e; color: white;">
                            <th style="text-align: center;">#</th>
                            <th>No. Registrasi</th>
                            <th>Nama Usaha</th>
                            <th>Pemilik</th>
                            <th>Distrik</th>
                            <th>Jenis Usaha</th>
                            <th style="text-align: center;">Kategori</th>
                            <th style="text-align: center;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
        `;
        
        const rows = document.querySelectorAll('.table-modern tbody tr');
        let no = 1;
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length > 1) {
                html += '<tr style="' + (no % 2 === 0 ? 'background-color: #f0f5ff;' : '') + '">';
                html += `<td style="text-align: center;">${no}</td>`;
                html += `<td>${cells[1].innerText.trim()}</td>`;
                html += `<td>${cells[2].innerText.split('\n')[0].trim()}</td>`;
                html += `<td>${cells[3].innerText.split('\n')[0].trim()}</td>`;
                html += `<td>${cells[4].innerText.trim()}</td>`;
                html += `<td>${cells[5].innerText.trim()}</td>`;
                html += `<td style="text-align: center;">${cells[6].innerText.trim()}</td>`;
                html += `<td style="text-align: center;">${cells[7].innerText.trim()}</td>`;
                html += '</tr>';
                no++;
            }
        });
        
        html += `
                    </tbody>
                </table>
                <div style="margin-top: 30px; padding-top: 20px; border-top: 2px solid #ddd;">
                    <table style="width: 100%; font-size: 11px; color: #666;">
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
        link.download = 'Data_Koperasi_' + new Date().toISOString().slice(0,10) + '.doc';
        link.click();
        URL.revokeObjectURL(url);
    };
    
    img.onerror = function() {
        alert('Logo tidak dapat dimuat. Pastikan file logo.png ada di folder public/');
    };
}

// Print Data with Logo
function printDataKoperasi() {
    const printWindow = window.open('', '', 'height=600,width=800');
    
    let html = `
        <html>
        <head>
            <title>Print Data Koperasi</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .header { 
                    text-align: center; 
                    margin-bottom: 30px; 
                    border-bottom: 3px solid #1a3a6e; 
                    padding-bottom: 20px;
                }
                .header-table { width: 100%; margin-bottom: 10px; }
                .header h1 { margin: 0; font-size: 24px; color: #1a3a6e; font-weight: bold; }
                .header h3 { margin: 5px 0; font-size: 18px; color: #333; font-weight: bold; }
                .header p { margin: 5px 0; font-size: 14px; color: #666; }
                .header .italic { font-style: italic; font-size: 12px; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 10px; text-align: left; font-size: 12px; }
                th { background-color: #1a3a6e; color: white; font-weight: bold; text-align: center; }
                tr:nth-child(even) { background-color: #f0f5ff; }
                .footer { 
                    margin-top: 30px; 
                    padding-top: 20px; 
                    border-top: 2px solid #ddd; 
                    font-size: 11px; 
                    color: #666;
                }
                .footer-table { width: 100%; }
                @media print {
                    .no-print { display: none; }
                    body { margin: 15px; }
                }
            </style>
        </head>
        <body>
            <div class="header">
                <table class="header-table">
                    <tr>
                        <td style="width: 15%; text-align: center; vertical-align: middle;">
                            <img src="${window.location.origin}/logo.png" style="width: 70px; height: auto;">
                        </td>
                        <td style="width: 70%; text-align: center; vertical-align: middle;">
                            <h1>DATA KOPERASI</h1>
                            <h3>DINAS PERINDUSTRIAN, PERDAGANGAN DAN KOPERASI</h3>
                            <p>Kabupaten Tolikara, Papua Pegunungan</p>
                            <p class="italic">Tanggal: ${new Date().toLocaleDateString('id-ID', {
                                weekday: 'long',
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            })}</p>
                        </td>
                        <td style="width: 15%;"></td>
                    </tr>
                </table>
            </div>
            <table>
                <thead>
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 15%;">No. Registrasi</th>
                        <th style="width: 20%;">Nama Usaha</th>
                        <th style="width: 15%;">Pemilik</th>
                        <th style="width: 10%;">Distrik</th>
                        <th style="width: 15%;">Jenis Usaha</th>
                        <th style="width: 10%;">Kategori</th>
                        <th style="width: 10%;">Status</th>
                    </tr>
                </thead>
                <tbody>
    `;
    
    const rows = document.querySelectorAll('.table-modern tbody tr');
    let no = 1;
    rows.forEach(row => {
        const cells = row.querySelectorAll('td');
        if (cells.length > 1) {
            html += '<tr>';
            html += `<td style="text-align: center;">${no}</td>`;
            html += `<td>${cells[1].innerText.trim()}</td>`;
            html += `<td>${cells[2].innerText.split('\n')[0].trim()}</td>`;
            html += `<td>${cells[3].innerText.split('\n')[0].trim()}</td>`;
            html += `<td>${cells[4].innerText.trim()}</td>`;
            html += `<td>${cells[5].innerText.trim()}</td>`;
            html += `<td style="text-align: center;">${cells[6].innerText.trim()}</td>`;
            html += `<td style="text-align: center;">${cells[7].innerText.trim()}</td>`;
            html += '</tr>';
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
    
    printWindow.document.write(html);
    printWindow.document.close();
    printWindow.focus();
    
    setTimeout(() => {
        printWindow.print();
        printWindow.close();
    }, 500);
}
