<?php
namespace App\Http\Controllers\Pimpinan;
use App\Http\Controllers\Controller;
use App\Models\Bantuan;
use App\Models\PenerimaBantuan;
use App\Models\Koperasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index() {
        // Check permission
        if (!can_view('laporan')) {
            return redirect()->route('pimpinan.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk mengakses Laporan. Silakan hubungi Admin untuk mendapatkan akses.');
        }
        
        $stats = ['total_koperasi'=>Koperasi::count(),'koperasi_verified'=>Koperasi::where('status_verifikasi','diverifikasi')->count(),'total_bantuan'=>Bantuan::count(),'penerima_bantuan'=>PenerimaBantuan::where('status','diterima')->count()];
        return view('pimpinan.laporan.index', compact('stats'));
    }
    
    public function koperasi(Request $request) {
        // Check permission
        if (!can_view('laporan')) {
            return redirect()->route('pimpinan.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk mengakses Laporan Pendaftaran Anggota.');
        }
        
        $query = \App\Models\Anggota::with(['koperasi']);
        
        // Apply filters
        if ($request->filled('distrik')) $query->where('distrik', $request->distrik);
        if ($request->filled('koperasi_id')) $query->where('koperasi_id', $request->koperasi_id);
        if ($request->filled('status')) $query->where('status', $request->status);
        
        $anggota = $query->latest()->get();
        
        // Stats berdasarkan filter
        $stats = [
            'total' => $anggota->count(),
            'aktif' => $anggota->where('status', 'Aktif')->count(),
            'pending' => $anggota->where('status', 'Pending')->count(),
            'nonaktif' => $anggota->where('status', 'Nonaktif')->count(),
        ];
        
        $distrikList = ['Karubaga', 'Bokondini', 'Kanggime', 'Kembu', 'Kondaga', 'Wunim', 'Wari', 'Wina', 'Wugi', 'Wulik', 'Dow', 'Dundu', 'Egiam', 'Gearek', 'Geya', 'Gilubandu', 'Goyage', 'Gundagi', 'Kai', 'Kamboneri', 'Kuari', 'Kubu', 'Kumbiagama', 'Kumo', 'Nabunage', 'Nelawi', 'Numba', 'Nunggawi', 'Panaga', 'Poganeri', 'Tagime', 'Tagineri', 'Telenggeme', 'Timori', 'Umagi', 'Wakuwo', 'Wenam', 'Wollo', 'Yuko', 'Yuneri'];
        
        $koperasiList = Koperasi::where('status_verifikasi', 'diverifikasi')
            ->where('status_usaha', 'aktif')
            ->orderBy('nama_usaha')
            ->get();
        
        return view('pimpinan.laporan.koperasi', compact('anggota', 'stats', 'distrikList', 'koperasiList'));
    }
    
    public function bantuan() {
        // Check permission
        if (!can_view('laporan')) {
            return redirect()->route('pimpinan.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk mengakses Laporan Bantuan.');
        }
        
        $bantuan = Bantuan::with('penerima.koperasi')->latest()->paginate(20); 
        return view('pimpinan.laporan.bantuan', compact('bantuan')); 
    }
    
    public function bantuanCreate() {
        // Check permission
        if (!can_create('laporan')) {
            return redirect()->route('pimpinan.laporan.bantuan')
                ->with('error', 'Anda tidak memiliki izin untuk menambah Program Bantuan. Silakan hubungi Admin untuk mendapatkan akses.');
        }
        
        return view('pimpinan.laporan.bantuan-create');
    }
    
    public function bantuanStore(Request $request) {
        // Check permission
        if (!can_create('laporan')) {
            return redirect()->route('pimpinan.laporan.bantuan')
                ->with('error', 'Anda tidak memiliki izin untuk menambah Program Bantuan.');
        }
        
        $validated = $request->validate([
            'kode_bantuan' => 'required|string|max:50|unique:bantuans,kode_bantuan',
            'nama_bantuan' => 'required|string|max:255',
            'jenis_bantuan' => 'required|in:uang,barang,pelatihan',
            'tahun' => 'required|integer|min:2020|max:2100',
            'anggaran' => 'required|numeric|min:0',
            'kuota' => 'required|integer|min:1',
            'status' => 'required|in:aktif,nonaktif,selesai',
            'deskripsi' => 'nullable|string',
            'satuan' => 'nullable|string|max:50',
        ]);
        
        $validated['jumlah_penerima'] = 0;
        $validated['created_by'] = auth()->id();
        
        Bantuan::create($validated);
        
        return redirect()->route('pimpinan.laporan.bantuan')
            ->with('success', 'Program bantuan berhasil ditambahkan.');
    }
    
    public function bantuanEdit($id) {
        // Check permission
        if (!can_edit('laporan')) {
            return redirect()->route('pimpinan.laporan.bantuan')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit Program Bantuan. Silakan hubungi Admin untuk mendapatkan akses.');
        }
        
        $bantuan = Bantuan::findOrFail($id);
        
        return view('pimpinan.laporan.bantuan-edit', compact('bantuan'));
    }
    
    public function bantuanUpdate(Request $request, $id) {
        // Check permission
        if (!can_edit('laporan')) {
            return redirect()->route('pimpinan.laporan.bantuan')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit Program Bantuan.');
        }
        
        $bantuan = Bantuan::findOrFail($id);
        
        $validated = $request->validate([
            'kode_bantuan' => 'required|string|max:50|unique:bantuans,kode_bantuan,' . $id,
            'nama_bantuan' => 'required|string|max:255',
            'jenis_bantuan' => 'required|in:uang,barang,pelatihan',
            'tahun' => 'required|integer|min:2020|max:2100',
            'anggaran' => 'required|numeric|min:0',
            'kuota' => 'required|integer|min:1',
            'status' => 'required|in:aktif,nonaktif,selesai',
            'deskripsi' => 'nullable|string',
            'satuan' => 'nullable|string|max:50',
        ]);
        
        $bantuan->update($validated);
        
        return redirect()->route('pimpinan.laporan.bantuan')
            ->with('success', 'Program bantuan berhasil diperbarui.');
    }
    
    public function bantuanDetail($id) {
        // Check permission
        if (!can_view('laporan')) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk melihat detail bantuan.'
            ], 403);
        }
        
        try {
            $bantuan = Bantuan::with('penerima.koperasi')->findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $bantuan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }
    
    public function bantuanDelete($id) {
        // Check permission
        if (!can_delete('laporan')) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk menghapus data bantuan.'
            ], 403);
        }
        
        try {
            $bantuan = Bantuan::findOrFail($id);
            
            // Check if bantuan has penerima
            if ($bantuan->penerima()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Program bantuan tidak dapat dihapus karena sudah memiliki penerima.'
                ], 400);
            }
            
            $bantuan->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Program bantuan berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function anggota(Request $request) {
        // Check permission
        if (!can_view('laporan')) {
            return redirect()->route('pimpinan.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk mengakses Laporan Anggota.');
        }
        
        $query = \App\Models\Anggota::with(['koperasi']);
        
        // Apply filters
        if ($request->filled('distrik')) $query->where('distrik', $request->distrik);
        if ($request->filled('koperasi_id')) $query->where('koperasi_id', $request->koperasi_id);
        if ($request->filled('status')) $query->where('status', $request->status);
        
        $anggota = $query->latest()->get();
        
        // Stats berdasarkan filter
        $stats = [
            'total' => $anggota->count(),
            'aktif' => $anggota->where('status', 'Aktif')->count(),
            'pending' => $anggota->where('status', 'Pending')->count(),
            'nonaktif' => $anggota->where('status', 'Nonaktif')->count(),
        ];
        
        $distrikList = ['Karubaga', 'Bokondini', 'Kanggime', 'Kembu', 'Kondaga', 'Wunim', 'Wari', 'Wina', 'Wugi', 'Wulik', 'Dow', 'Dundu', 'Egiam', 'Gearek', 'Geya', 'Gilubandu', 'Goyage', 'Gundagi', 'Kai', 'Kamboneri', 'Kuari', 'Kubu', 'Kumbiagama', 'Kumo', 'Nabunage', 'Nelawi', 'Numba', 'Nunggawi', 'Panaga', 'Poganeri', 'Tagime', 'Tagineri', 'Telenggeme', 'Timori', 'Umagi', 'Wakuwo', 'Wenam', 'Wollo', 'Yuko', 'Yuneri'];
        
        $koperasiList = Koperasi::where('status_verifikasi', 'diverifikasi')
            ->where('status_usaha', 'aktif')
            ->orderBy('nama_usaha')
            ->get();
        
        return view('pimpinan.laporan.anggota', compact('anggota', 'stats', 'distrikList', 'koperasiList'));
    }
    
    public function anggotaDetail($id) {
        // Check permission
        if (!can_view('laporan')) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk melihat detail laporan.'
            ], 403);
        }
        
        try {
            $anggota = \App\Models\Anggota::with('koperasi')->findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $anggota->id,
                    'no_anggota' => $anggota->no_anggota,
                    'nama_lengkap' => $anggota->nama ?? $anggota->nama_lengkap ?? '-',
                    'nik' => $anggota->nik,
                    'tempat_lahir' => $anggota->tempat_lahir,
                    'tanggal_lahir' => $anggota->tanggal_lahir ? \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d M Y') : '-',
                    'jenis_kelamin' => $anggota->jenis_kelamin,
                    'no_hp' => $anggota->no_hp,
                    'email' => $anggota->email ?? '-',
                    'distrik' => $anggota->distrik,
                    'alamat' => $anggota->alamat_lengkap ?? $anggota->alamat ?? '-',
                    'koperasi_nama' => $anggota->koperasi->nama_usaha ?? '-',
                    'simpanan_pokok' => $anggota->simpanan_pokok ?? 0,
                    'simpanan_wajib' => $anggota->simpanan_wajib ?? 0,
                    'status' => $anggota->status,
                    'tanggal_bergabung' => $anggota->tanggal_bergabung ? \Carbon\Carbon::parse($anggota->tanggal_bergabung)->format('d M Y') : '-',
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }
    
    public function exportAnggotaWord(Request $request) {
        // Check permission
        if (!can_export('laporan')) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengekspor laporan.');
        }
        
        // Implementation similar to koperasi export
        return redirect()->back()->with('info', 'Fitur export Word sedang dalam pengembangan.');
    }
    
    public function exportAnggotaExcel(Request $request) {
        // Check permission
        if (!can_export('laporan')) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengekspor laporan.');
        }
        
        // Implementation similar to koperasi export
        return redirect()->back()->with('info', 'Fitur export Excel sedang dalam pengembangan.');
    }
    
    public function koperasiDetail($id) {
        // Check permission
        if (!can_view('laporan')) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk melihat detail laporan.'
            ], 403);
        }
        
        try {
            $anggota = \App\Models\Anggota::with('koperasi')->findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $anggota->id,
                    'no_anggota' => $anggota->no_anggota,
                    'nama_lengkap' => $anggota->nama ?? $anggota->nama_lengkap ?? '-',
                    'nik' => $anggota->nik,
                    'tempat_lahir' => $anggota->tempat_lahir ?? '-',
                    'tanggal_lahir' => $anggota->tanggal_lahir ? \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d M Y') : '-',
                    'jenis_kelamin' => $anggota->jenis_kelamin ?? '-',
                    'status_perkawinan' => $anggota->status_perkawinan ?? '-',
                    'pendidikan_terakhir' => $anggota->pendidikan_terakhir ?? '-',
                    'agama' => $anggota->agama ?? '-',
                    'no_hp' => $anggota->no_hp ?? '-',
                    'email' => $anggota->email ?? '-',
                    'distrik' => $anggota->distrik ?? '-',
                    'alamat' => $anggota->alamat_lengkap ?? $anggota->alamat ?? '-',
                    'koperasi_nama' => $anggota->koperasi->nama_usaha ?? '-',
                    'nama_usaha' => $anggota->nama_usaha ?? '-',
                    'bidang_usaha' => $anggota->bidang_usaha ?? '-',
                    'simpanan_pokok' => $anggota->simpanan_pokok ?? 0,
                    'simpanan_wajib' => $anggota->simpanan_wajib ?? 0,
                    'status' => $anggota->status ?? '-',
                    'tanggal_bergabung' => $anggota->tanggal_bergabung ? \Carbon\Carbon::parse($anggota->tanggal_bergabung)->format('d M Y') : '-',
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }
    
    public function exportKoperasiWord(Request $request) {
        try {
            // Check permission
            if (!can_export('laporan')) {
                return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengekspor laporan.');
            }
            
            // Query SEMUA data - start with base query
            $query = \App\Models\Anggota::query();
            
            // Apply filters
            if ($request->filled('distrik')) $query->where('distrik', $request->distrik);
            if ($request->filled('koperasi_id')) $query->where('koperasi_id', $request->koperasi_id);
            if ($request->filled('status')) $query->where('status', $request->status);
            
            // Get data dengan eager loading koperasi (optional - won't filter out null koperasi_id)
            $data = $query->with('koperasi')->latest()->get();
            
            // Check if data exists
            if ($data->isEmpty()) {
                return redirect()->back()->with('error', 'Tidak ada data untuk diekspor.');
            }
            
            \Log::info('Export Word - Total data: ' . $data->count());
            
            // Stats
            $stats = [
                'total' => $data->count(),
                'aktif' => $data->where('status', 'Aktif')->count(),
                'pending' => $data->where('status', 'Pending')->count(),
                'nonaktif' => $data->where('status', 'Nonaktif')->count(),
            ];
            
            // Filter text
            $filterText = 'Filter: ';
            if ($request->filled('distrik')) $filterText .= 'Distrik ' . $request->distrik . ' | ';
            if ($request->filled('koperasi_id')) {
                $kop = \App\Models\Koperasi::find($request->koperasi_id);
                $filterText .= 'Koperasi ' . ($kop->nama_usaha ?? '') . ' | ';
            }
            if ($request->filled('status')) $filterText .= 'Status ' . $request->status . ' | ';
            if (!$request->hasAny(['distrik', 'koperasi_id', 'status'])) {
                $filterText = 'Semua Data';
            } else {
                $filterText = rtrim($filterText, ' | ');
            }
            
            // Check if service class exists
            if (!class_exists('\App\Services\AnggotaKoperasiExportService')) {
                \Log::error('Service class not found');
                return redirect()->back()->with('error', 'Service class tidak ditemukan. Silakan hubungi administrator.');
            }
            
            // Generate Word document using service
            $phpWord = \App\Services\AnggotaKoperasiExportService::exportToWord($data, $stats, $filterText);
            
            // Generate filename
            $filename = 'Rekap-Anggota-Koperasi-' . date('d-M-Y') . '.docx';
            
            // Save ke temporary file
            $temp_file = tempnam(sys_get_temp_dir(), 'PHPWord');
            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save($temp_file);
            
            \Log::info('Export Word success - File: ' . $filename);
            
            // Download
            return response()->download($temp_file, $filename, [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            ])->deleteFileAfterSend(true);
            
        } catch (\Exception $e) {
            \Log::error('Export Word Error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()->with('error', 'Gagal membuat dokumen Word: ' . $e->getMessage());
        }
    }
    
    public function exportKoperasiExcel(Request $request) {
        try {
            // Check permission
            if (!can_export('laporan')) {
                return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengekspor laporan.');
            }
            
            // Query SEMUA data - start with base query
            $query = \App\Models\Anggota::query();
            
            // Apply filters
            if ($request->filled('distrik')) $query->where('distrik', $request->distrik);
            if ($request->filled('koperasi_id')) $query->where('koperasi_id', $request->koperasi_id);
            if ($request->filled('status')) $query->where('status', $request->status);
            
            // Get data dengan eager loading koperasi (optional - won't filter out null koperasi_id)
            $data = $query->with('koperasi')->latest()->get();
            
            // Check if data exists
            if ($data->isEmpty()) {
                return redirect()->back()->with('error', 'Tidak ada data untuk diekspor.');
            }
            
            \Log::info('Export Excel - Total data: ' . $data->count());
            
            $filename = 'Rekap-Anggota-Koperasi-' . date('d-M-Y') . '.xlsx';
            
            return \Maatwebsite\Excel\Facades\Excel::download(
                new \App\Exports\AnggotaKoperasiExport($data), 
                $filename
            );
            
        } catch (\Exception $e) {
            \Log::error('Export Excel Error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()->with('error', 'Gagal membuat file Excel: ' . $e->getMessage());
        }
    }
    
    public function exportKoperasiPdf(Request $request) {
        try {
            // Check permission
            if (!can_export('laporan')) {
                return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk mengekspor laporan.');
            }
            
            // Query SEMUA data - start with base query
            $query = \App\Models\Anggota::query();
            
            // Apply filters
            if ($request->filled('distrik')) $query->where('distrik', $request->distrik);
            if ($request->filled('koperasi_id')) $query->where('koperasi_id', $request->koperasi_id);
            if ($request->filled('status')) $query->where('status', $request->status);
            
            // Get data dengan eager loading koperasi (optional - won't filter out null koperasi_id)
            $data = $query->with('koperasi')->latest()->get();
            
            // Check if data exists
            if ($data->isEmpty()) {
                return redirect()->back()->with('error', 'Tidak ada data untuk diekspor.');
            }
            
            \Log::info('Export PDF - Total data: ' . $data->count());
            
            // Stats
            $stats = [
                'total' => $data->count(),
                'aktif' => $data->where('status', 'Aktif')->count(),
                'pending' => $data->where('status', 'Pending')->count(),
                'nonaktif' => $data->where('status', 'Nonaktif')->count(),
            ];
            
            // Filter info
            $filterText = '';
            if ($request->filled('distrik')) $filterText .= 'Distrik: ' . $request->distrik . ' | ';
            if ($request->filled('koperasi_id')) {
                $kop = \App\Models\Koperasi::find($request->koperasi_id);
                $filterText .= 'Koperasi: ' . ($kop->nama_usaha ?? '') . ' | ';
            }
            if ($request->filled('status')) $filterText .= 'Status: ' . $request->status . ' | ';
            if (!$request->hasAny(['distrik', 'koperasi_id', 'status'])) {
                $filterText = 'Semua Data';
            } else {
                $filterText = rtrim($filterText, ' | ');
            }
            
            // Generate PDF
            $pdf = Pdf::loadView('pimpinan.laporan.pdf.koperasi', [
                'data' => $data,
                'stats' => $stats,
                'filterText' => $filterText,
                'tanggalCetak' => date('d F Y, H:i') . ' WIT'
            ]);
            
            // Set paper size to landscape A4
            $pdf->setPaper('a4', 'landscape');
            
            $filename = 'Rekap-Anggota-Koperasi-' . date('d-M-Y') . '.pdf';
            
            return $pdf->download($filename);
            
        } catch (\Exception $e) {
            \Log::error('Export PDF Error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->back()->with('error', 'Gagal membuat file PDF: ' . $e->getMessage());
        }
    }
}
