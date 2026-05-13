<?php

namespace App\Http\Controllers;

use App\Models\Pbb;
use App\Models\Kolektor;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalWajibPajak = Pbb::count();
        $totalPbb = Pbb::sum('ketetapan_pbb');
        $totalPembayaran = Pbb::sum('jumlah_bayar');
        $totalTunggakan = Pbb::where('status', '!=', 'Lunas')->sum('hutang_pbb');
        $totalKolektor = Kolektor::count();
        
        $pembayaranTerbaru = Pbb::where('status', 'Lunas')
            ->orderBy('tgl_bayar', 'desc')
            ->take(5)
            ->get();
        
        // Data untuk grafik
        $grafikPembayaran = Pbb::selectRaw('MONTH(tgl_bayar) as bulan, SUM(jumlah_bayar) as total')
            ->whereNotNull('tgl_bayar')
            ->whereYear('tgl_bayar', date('Y'))
            ->groupBy('bulan')
            ->pluck('total', 'bulan')->toArray();
            
        $dataPembayaran = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataPembayaran[] = $grafikPembayaran[$i] ?? 0;
        }

        return view('dashboard.index', compact(
            'totalWajibPajak', 'totalPbb', 'totalPembayaran', 'totalTunggakan', 'totalKolektor',
            'pembayaranTerbaru', 'dataPembayaran'
        ));
    }

    public function collectorIndex()
    {
        $user = auth()->user();
        
        $totalWajibPajak = Pbb::where('nama_kolektor', $user->name)->count();
        if ($totalWajibPajak == 0) {
            // Fallback if collector name doesn't match exactly
            $totalWajibPajak = Pbb::count();
        }

        $totalSetoran = Pbb::where('nama_kolektor', $user->name)->sum('jumlah_bayar');
        $jumlahTagihan = Pbb::where('nama_kolektor', $user->name)
            ->where('status', '!=', 'Lunas')
            ->sum('hutang_pbb');
            
        $setoranHariIni = Pbb::where('nama_kolektor', $user->name)
            ->whereDate('tgl_bayar', date('Y-m-d'))
            ->sum('jumlah_bayar');
        
        $pembayaranTerbaru = Pbb::where('nama_kolektor', $user->name)
            ->where('status', 'Lunas')
            ->latest('tgl_bayar')
            ->take(10)
            ->get();

        return view('dashboard.collector', compact(
            'totalWajibPajak', 'totalSetoran', 'jumlahTagihan', 'setoranHariIni', 'pembayaranTerbaru'
        ));
    }

    public function reportIndex(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        
        $query = Pbb::query();
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nop', 'like', "%{$search}%")
                  ->orWhere('nama_wp', 'like', "%{$search}%");
            });
        }
        
        if ($status) {
            $query->where('status', $status);
        }
        
        $pbbs = $query->latest()->paginate(20);
        
        return view('dashboard.report', compact('pbbs', 'search', 'status'));
    }
}
