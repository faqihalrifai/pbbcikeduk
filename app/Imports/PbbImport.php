<?php

namespace App\Imports;

use App\Models\Pbb;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Illuminate\Support\Facades\Log;

class PbbImport implements ToCollection, WithHeadingRow
{
    public $successCount = 0;
    public $failedCount = 0;
    public $errors = [];

    public function __construct()
    {
        HeadingRowFormatter::default('none');
    }

    public function collection(Collection $rows)
    {
        Log::info("Mulai import Excel. Jumlah baris: " . $rows->count());
        
        if ($rows->isEmpty()) {
            Log::warning("File Excel kosong atau sheet pertama tidak berisi data.");
            $this->errors[] = "File Excel kosong atau sheet pertama tidak berisi data.";
            return;
        }

        // Cek header dari row pertama
        $firstRow = $rows->first();
        Log::info("Header Excel terbaca:", is_object($firstRow) ? $firstRow->toArray() : (array)$firstRow);

        foreach ($rows as $index => $row) {
            $rowArray = is_object($row) ? $row->toArray() : (array) $row;
            
            // Log setiap row ke laravel.log
            Log::info("Row " . ($index + 2) . ":", $rowArray);

            // Karena kita pakai default('none'), key array akan persis seperti header di Excel, termasuk spasi dan huruf besar/kecil.
            // Kita akan buat helper untuk mencari key dengan mengabaikan case dan spasi jika diperlukan,
            // atau langsung cari exact match jika sudah pasti.

            $nop = $this->findValue($rowArray, ['nop', 'n o p', 'nomor objek pajak']);
            $nopGabung = $this->findValue($rowArray, ['nop gabung', 'nop_gabung', 'nop gabungan']);
            
            if (empty($nop) && empty($nopGabung)) {
                Log::warning("Baris " . ($index + 2) . " dilewati karena NOP dan NOP Gabung kosong.", $rowArray);
                continue;
            }

            try {
                $namaWp = $this->findValue($rowArray, ['nama wp', 'nama wajib pajak', 'namawp']);
                $ketetapanPbb = $this->findValue($rowArray, ['ketetapan', 'ketetapan pbb', 'pajak terhutang', 'pbb']);
                $hutangPbb = $this->findValue($rowArray, ['hutang', 'hutang pbb', 'tunggakan']);
                $jumlahBayar = $this->findValue($rowArray, ['jumlah bayar', 'bayar', 'dibayar']);
                $tglBayarRaw = $this->findValue($rowArray, ['tanggal bayar', 'tgl bayar', 'tgl_bayar']);
                $alamatWp = $this->findValue($rowArray, ['alamat', 'alamat wp', 'alamat wajib pajak', 'letak objek pajak']);

                $ketetapan = preg_replace('/[^0-9]/', '', (string)$ketetapanPbb);
                $hutang = preg_replace('/[^0-9]/', '', (string)$hutangPbb);
                $jumlah = preg_replace('/[^0-9]/', '', (string)$jumlahBayar);

                $tglBayar = null;
                if (!empty($tglBayarRaw)) {
                    if (is_numeric($tglBayarRaw)) {
                        $tglBayar = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($tglBayarRaw)->format('Y-m-d');
                    } else {
                        $tglBayar = date('Y-m-d', strtotime($tglBayarRaw));
                    }
                }

                $data = [
                    'no_urut' => $this->findValue($rowArray, ['no', 'no urut', 'nomor']),
                    'blok' => $this->findValue($rowArray, ['blok']),
                    'urut' => $this->findValue($rowArray, ['urut']),
                    'nop_gabung' => $nopGabung ?: null,
                    'nop' => $nop ?: null,
                    'nama_wp' => $namaWp,
                    'nama_wp_lainnya' => $this->findValue($rowArray, ['nama wp lainnya', 'nama wp 2']),
                    'ketetapan_pbb' => empty($ketetapan) ? 0 : (float)$ketetapan,
                    'nama_kolektor' => $this->findValue($rowArray, ['kolektor', 'nama kolektor', 'petugas']),
                    'luas' => $this->findValue($rowArray, ['luas', 'luas bumi', 'luas bangunan']),
                    'alamat_wajib_pajak' => $alamatWp,
                    'hutang_pbb' => empty($hutang) ? 0 : (float)$hutang,
                    'tgl_bayar' => $tglBayar,
                    'jumlah_bayar' => empty($jumlah) ? 0 : (float)$jumlah,
                    'status' => $this->findValue($rowArray, ['status', 'keterangan']) ?: 'Belum Lunas',
                    'column1' => $this->findValue($rowArray, ['column1']),
                ];

                $searchField = !empty($nopGabung) ? ['nop_gabung' => $nopGabung] : ['nop' => $nop];
                Pbb::updateOrCreate($searchField, $data);

                $this->successCount++;
            } catch (\Exception $e) {
                $this->failedCount++;
                $errorMsg = "Baris " . ($index + 2) . " (NOP: {$nop}): " . $e->getMessage();
                $this->errors[] = $errorMsg;
                Log::error("Import PBB Gagal: " . $errorMsg);
            }
        }
        Log::info("Selesai import. Success: {$this->successCount}, Failed: {$this->failedCount}");
    }

    private function findValue($rowArray, $possibleKeys)
    {
        foreach ($possibleKeys as $key) {
            // Cari exact match
            if (array_key_exists($key, $rowArray)) {
                return $rowArray[$key];
            }
            // Cari case-insensitive match
            foreach ($rowArray as $rowKey => $value) {
                if (strtolower(trim($rowKey)) === strtolower($key)) {
                    return $value;
                }
            }
        }
        return null;
    }
}
