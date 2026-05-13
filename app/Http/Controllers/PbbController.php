<?php

namespace App\Http\Controllers;

use App\Models\Pbb;
use Illuminate\Http\Request;
use App\Exports\PbbExport;
use App\Imports\PbbImport;
use Maatwebsite\Excel\Facades\Excel;

class PbbController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $pbbs = Pbb::when($search, function ($query) use ($search) {
                $query->where('nop', 'like', "%{$search}%")
                      ->orWhere('nama_wp', 'like', "%{$search}%")
                      ->orWhere('nop_gabung', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);
            
        return view('pbbs.index', compact('pbbs', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nop' => 'required',
            'nama_wp' => 'required',
            'alamat_wajib_pajak' => 'required',
            'hutang_pbb' => 'required|numeric',
        ]);

        Pbb::create([
            'nop' => $request->nop,
            'nama_wp' => $request->nama_wp,
            'alamat_wajib_pajak' => $request->alamat_wajib_pajak,
            'hutang_pbb' => $request->hutang_pbb,
            'status' => 'Belum Lunas'
        ]);

        return redirect()->route('pbbs.index')->with('success', 'Data PBB berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $pbb = Pbb::findOrFail($id);
        
        $request->validate([
            'nama_wp' => 'required',
            'alamat_wajib_pajak' => 'required',
            'hutang_pbb' => 'required|numeric',
        ]);

        $pbb->update([
            'nama_wp' => $request->nama_wp,
            'alamat_wajib_pajak' => $request->alamat_wajib_pajak,
            'hutang_pbb' => $request->hutang_pbb
        ]);

        return redirect()->route('pbbs.index')->with('success', 'Data PBB berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pbb = Pbb::findOrFail($id);
        $pbb->delete();
        return redirect()->route('pbbs.index')->with('success', 'Data PBB berhasil dihapus');
    }

    public function export()
    {
        if (!class_exists(Excel::class)) {
            return back()->with('error', 'Package Maatwebsite/Excel belum terinstall.');
        }
        return Excel::download(new PbbExport, 'data-pbb.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file_excel' => 'required|mimes:xlsx,xls,csv'
        ]);

        if (!class_exists(Excel::class)) {
            return back()->with('error', 'Package Maatwebsite/Excel belum terinstall.');
        }

        try {
            $import = new PbbImport();
            Excel::import($import, $request->file('file_excel'));

            $msg = "Import selesai. Berhasil: {$import->successCount} data, Gagal: {$import->failedCount} data.";
            
            if ($import->failedCount > 0) {
                return redirect()->route('pbbs.index')
                    ->with('warning', $msg)
                    ->with('import_errors', $import->errors);
            }

            return redirect()->route('pbbs.index')->with('success', $msg);
            
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat import: ' . $e->getMessage());
        }
    }
}
