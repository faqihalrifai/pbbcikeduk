<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pbb;
use App\Models\Complaint;
use App\Models\Kolektor;
use App\Models\BalikNamaPbb;
use Barryvdh\DomPDF\Facade\Pdf;

class LandingController extends Controller
{
    public function index()
    {
        $stats = [
            'total_wp' => Pbb::count(),
            'total_bayar' => Pbb::sum('jumlah_bayar'),
            'total_tunggakan' => Pbb::where('status', '!=', 'Lunas')->sum('hutang_pbb'),
            'total_kolektor' => Kolektor::count(),
        ];
        
        $pembayaranTerbaru = Pbb::where('status', 'Lunas')
            ->latest('tgl_bayar')
            ->take(5)
            ->get();
            
        return view('landing.index', compact('pembayaranTerbaru', 'stats'));
    }

    public function paymentPage()
    {
        return view('landing.payment');
    }

    public function informasiPage(Request $request)
    {
        $search = $request->input('search');
        
        $query = Pbb::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nop', 'like', "%{$search}%")
                  ->orWhere('nama_wp', 'like', "%{$search}%");
            });
        }

        $pbb = $query->latest()->paginate(10);
        
        return view('landing.informasi', compact('pbb', 'search'));
    }

    public function historyPage(Request $request)
    {
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $query = Pbb::where('status', 'Lunas');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nop', 'like', "%{$search}%")
                  ->orWhere('nama_wp', 'like', "%{$search}%");
            });
        }

        if ($startDate) {
            $query->whereDate('tgl_bayar', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('tgl_bayar', '<=', $endDate);
        }

        $pembayaran = $query->latest('tgl_bayar')->paginate(10);
        
        return view('landing.history', compact('pembayaran', 'search', 'startDate', 'endDate'));
    }

    public function complaintPage()
    {
        $complaints = Complaint::latest()->take(10)->get();
        return view('landing.complaint', compact('complaints'));
    }

    public function storeComplaint(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        Complaint::create($request->all());

        return redirect()->back()->with('success', 'Pengaduan Anda berhasil dikirim! Kami akan segera menindaklanjuti.');
    }

    public function lookupNop($nop)
    {
        $cleanNop = str_replace(['.', ' '], '', $nop);
        $pbb = Pbb::whereRaw("REPLACE(REPLACE(nop, '.', ''), ' ', '') = ?", [$cleanNop])->first();

        if ($pbb) {
            return response()->json([
                'success' => true,
                'nama' => $pbb->nama_wp,
                'tagihan' => $pbb->hutang_pbb,
                'formatted_tagihan' => number_format($pbb->hutang_pbb, 0, ',', '.'),
                'alamat' => $pbb->alamat_wajib_pajak,
                'tahun' => '2026'
            ]);
        }
        return response()->json(['success' => false]);
    }

    public function spptPage()
    {
        return view('landing.sppt');
    }

    public function generateSppt(Request $request)
    {
        $request->validate(['nop' => 'required']);
        
        $cleanNop = str_replace(['.', ' '], '', $request->nop);
        $pbb = Pbb::whereRaw("REPLACE(REPLACE(nop, '.', ''), ' ', '') = ?", [$cleanNop])->firstOrFail();

        $pbb->tahun_pajak = '2026';
        
        $pdf = Pdf::loadView('landing.sppt_pdf', compact('pbb'));
        
        if ($request->action == 'download') {
            return $pdf->download('SPPT-'.$pbb->nop.'.pdf');
        }
        
        return $pdf->stream('SPPT-'.$pbb->nop.'.pdf');
    }

    public function cekTagihan(Request $request)
    {
        $request->validate([
            'nop' => 'required'
        ]);

        $stats = [
            'total_wp' => Pbb::count(),
            'total_bayar' => Pbb::sum('jumlah_bayar'),
            'total_tunggakan' => Pbb::where('status', '!=', 'Lunas')->sum('hutang_pbb'),
            'total_kolektor' => Kolektor::count(),
        ];

        $pbb = Pbb::where('nop', $request->nop)->first();
        $pembayaranTerbaru = Pbb::where('status', 'Lunas')->latest('tgl_bayar')->take(5)->get();

        return view('landing.index', compact('pbb', 'pembayaranTerbaru', 'stats'));
    }

    public function balikNamaPage()
    {
        return view('landing.balik_nama');
    }

    public function storeBalikNama(Request $request)
    {
        $request->validate([
            'nop' => 'required',
            'nama_pemilik_lama' => 'required',
            'alamat_objek' => 'required',
            'nama_pemilik_baru' => 'required',
            'nik' => 'required',
            'no_hp' => 'required',
            'alamat_baru' => 'required',
            'ktp' => 'required|file|mimes:pdf,jpg,png,jpeg|max:2048',
            'kk' => 'required|file|mimes:pdf,jpg,png,jpeg|max:2048',
            'bukti_kepemilikan' => 'required|file|mimes:pdf,jpg,png,jpeg|max:2048',
            'sppt_lama' => 'required|file|mimes:pdf,jpg,png,jpeg|max:2048',
        ]);

        $data = $request->all();

        // Handle File Uploads
        $files = ['ktp', 'kk', 'bukti_kepemilikan', 'sppt_lama'];
        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                $path = $request->file($file)->store('balik_nama', 'public');
                $data[$file] = $path;
            }
        }

        BalikNamaPbb::create($data);

        return redirect()->back()->with('success', 'Pengajuan balik nama PBB berhasil dikirim! Status dapat dipantau melalui admin.');
    }
}
