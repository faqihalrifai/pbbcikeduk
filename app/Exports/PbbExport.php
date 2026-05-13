<?php

namespace App\Exports;

use App\Models\Tunggakan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PbbExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Tunggakan::with('wajibPajak')->get();
    }

    public function headings(): array
    {
        return [
            'NOP',
            'Nama Wajib Pajak',
            'Alamat',
            'Tahun Pajak',
            'Jumlah Tagihan',
            'Status'
        ];
    }

    public function map($tunggakan): array
    {
        return [
            $tunggakan->wajibPajak->nop,
            $tunggakan->wajibPajak->nama,
            $tunggakan->wajibPajak->alamat,
            $tunggakan->tahun,
            $tunggakan->jumlah_tagihan,
            $tunggakan->status
        ];
    }
}
