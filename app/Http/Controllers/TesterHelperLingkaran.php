<?php

namespace App\Http\Controllers;

use App\Helpers\Lingkaran;
use App\Helpers\GenerateVoucher;
use stdClass;

class TesterHelperLingkaran extends Controller
{
    public function index()
    {
        $judul = 'Generate Voucher';

        // $nilaiLingkaran = Lingkaran::cetakLingkaran(7);

        $nama_pelatihan = 'Bahasa Korea';
        $jadwal_pelatihan = 'Jadwal 1 (20 Oktober 2023 - 25 Oktober 2023)';
        $harga_pelatihan = 250000;
        $prefix = 'ISW';
        $judul_voucher = $nama_pelatihan . ' ' . $prefix;
        $nilai = 120000;
        $jumlah = 10;
        $tgl_expired = time();   
        $harga_akhir = $harga_pelatihan - $nilai;   // Nilai akhir
        $dataJSONArray = [];
        $sameVoucher = 0;
        $suksesVoucher = 0;
        $sameValue = "ISW-10";

        for ($i = 1; $i <= $jumlah; $i++) {

            $voucher = GenerateVoucher::generateVoucher($prefix); // Ini adalah function untuk generate kode voucher random

            if ($voucher == $sameValue) { // Cek apakah voucher baru hasil generate sudah exist atau belum
                $i--;
                $sameVoucher++;
            } else {
                $dataObject = new stdClass();
                $dataObject->nama_pelatihan = $nama_pelatihan . ' ' . $jadwal_pelatihan;
                $dataObject->judul_voucher = $judul_voucher;
                $dataObject->voucher = $voucher;
                $dataObject->harga_awal = $harga_pelatihan;
                $dataObject->nilai_diskon = $nilai;
                $dataObject->harga_akhir = $harga_akhir;
                $dataObject->tgl_expired = $tgl_expired;
                $dataObject->voucher_ke = $i;
                $dataJSON = json_encode($dataObject);
                $dataJSONArray[] = $dataJSON;
                $suksesVoucher++;
            }
        }
        $hasil = json_encode($dataJSONArray); // Konversi array to JSON
        $hasilAkhir = json_decode($hasil); // Deskripsi ulang JSON to String
        dd(
            'Voucher yang sama = ' . $sameVoucher,
            'Voucher tidak sama = ' . $suksesVoucher,
            $hasilAkhir

        );

        return view('index', [
            'judul' =>  $judul,
            // 'nilaiLingkaran' => $nilaiLingkaran,
            'voucher' => $voucher

        ]);
    }
}
