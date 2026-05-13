<?php

namespace App\Http\Controllers;

use App\Models\BalikNamaPbb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BalikNamaController extends Controller
{
    public function index()
    {
        $requests = BalikNamaPbb::latest()->paginate(10);
        return view('dashboard.balik_nama.index', compact('requests'));
    }

    public function show(BalikNamaPbb $balikNama)
    {
        return view('dashboard.balik_nama.show', compact('balikNama'));
    }

    public function updateStatus(Request $request, BalikNamaPbb $balikNama)
    {
        $request->validate([
            'status' => 'required|in:Menunggu Verifikasi,Diproses,Disetujui,Ditolak'
        ]);

        $balikNama->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    public function download(BalikNamaPbb $balikNama, $type)
    {
        $allowedTypes = ['ktp', 'kk', 'bukti_kepemilikan', 'sppt_lama'];
        
        if (!in_array($type, $allowedTypes)) {
            abort(404);
        }

        $path = $balikNama->$type;

        if (!Storage::disk('public')->exists($path)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($path);
    }
}
