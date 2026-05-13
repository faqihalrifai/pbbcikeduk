<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Tunggakan;
use App\Models\Kolektor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Pembayaran::with(['tunggakan.wajibPajak', 'kolektor'])->latest()->get();
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $tunggakans = Tunggakan::with('wajibPajak')->where('status', 'Belum Lunas')->get();
        $collectors = Kolektor::all();
        return view('payments.create', compact('tunggakans', 'collectors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tunggakan_id' => 'required|exists:tunggakans,id',
            'kolektor_id' => 'required|exists:kolektors,id',
            'jumlah_bayar' => 'required|numeric',
            'tanggal_bayar' => 'required|date',
            'bukti_bayar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->except('bukti_bayar');

        if ($request->hasFile('bukti_bayar')) {
            $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');
            $data['bukti_bayar'] = $path;
        }

        Pembayaran::create($data);

        $tunggakan = Tunggakan::find($request->tunggakan_id);
        $tunggakan->update(['status' => 'Lunas']);

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil ditambahkan');
    }

    public function print(Pembayaran $payment)
    {
        $payment->load(['tunggakan.wajibPajak', 'kolektor']);
        
        if(class_exists(Pdf::class)) {
            $pdf = Pdf::loadView('payments.print', compact('payment'));
            return $pdf->stream('bukti_pembayaran_'.$payment->tunggakan->wajibPajak->nop.'.pdf');
        } else {
            return view('payments.print', compact('payment'));
        }
    }
}
