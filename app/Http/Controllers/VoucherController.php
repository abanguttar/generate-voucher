<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\Voucher;
use Illuminate\Http\Request;
use App\Models\MasterPelatihan;
use App\Helpers\GenerateVoucher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $judul = 'List Voucher';

        // if ($judul) {
        //     $nilaiLingkaran = Lingkaran::cetakLingkaran(7);

        //     $masterPelatihan = MasterPelatihan::get();

        //     $nama_pelatihan = 'Bahasa Korea';
        //     $jadwal_pelatihan = 'Jadwal 1 (20 Oktober 2023 - 25 Oktober 2023)';
        //     $harga_pelatihan = 250000;
        //     $prefix = 'ISW';
        //     $judul_voucher = $nama_pelatihan . ' ' . $prefix;
        //     $nilai = 120000;
        //     $jumlah = 10;
        //     $tgl_expired = time();
        //     $harga_akhir = $harga_pelatihan - $nilai;   // Nilai akhir
        //     $dataJSONArray = [];
        //     $sameVoucher = 0;
        //     $suksesVoucher = 0;
        //     $sameValue = "ISW-10";

        //     for ($i = 1; $i <= $jumlah; $i++) {

        //         $voucher = GenerateVoucher::generateVoucher($prefix); // Ini adalah function untuk generate kode voucher random

        //         if ($voucher == $sameValue) { // Cek apakah voucher baru hasil generate sudah exist atau belum
        //             $i--;
        //             $sameVoucher++;
        //         } else {
        //             $dataObject = new stdClass();
        //             $dataObject->nama_pelatihan = $nama_pelatihan . ' ' . $jadwal_pelatihan;
        //             $dataObject->judul_voucher = $judul_voucher;
        //             $dataObject->voucher = $voucher;
        //             $dataObject->harga_awal = $harga_pelatihan;
        //             $dataObject->nilai_diskon = $nilai;
        //             $dataObject->harga_akhir = $harga_akhir;
        //             $dataObject->tgl_expired = $tgl_expired;
        //             $dataObject->voucher_ke = $i;
        //             $dataJSON = json_encode($dataObject);
        //             $dataJSONArray[] = $dataJSON;
        //             $suksesVoucher++;
        //         }
        //     }
        //     $hasil = json_encode($dataJSONArray); // Konversi array to JSON
        //     $hasilAkhir = json_decode($hasil); // Deskripsi ulang JSON to String
        //     // dd(
        //     //     'Voucher yang sama = ' . $sameVoucher,
        //     //     'Voucher tidak sama = ' . $suksesVoucher,
        //     //     $hasilAkhir

        //     // );
        // }

        // $voucher = Voucher::paginate(25)
        // ->appends(request()->query());
        if ($request->status == null) {
            $voucher = Voucher::paginate(25)
                ->appends(request()->query());
        } else {
            $status = $request->status;
            // dd($status);
            if ($status == "all") {
                $voucher = Voucher::paginate(25)
                    ->appends(request()->query());
            } else {
                $voucher =
                    Voucher::where('status', $request->status)
                    ->paginate(25)
                    ->appends(request()->query());
            }
        }




        return view('voucher', [
            'judul' =>  $judul,
            'voucher' => $voucher,



        ]);
    }



    public function addVoucher()
    {
        $judul = 'Generate Voucher';
        $masterPelatihan = MasterPelatihan::get();

        return view('generate-voucher', [
            'judul' =>  $judul,
            // 'voucher' => $voucher,
            'masterPelatihan' => $masterPelatihan


        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // $nama_pelatihan = 'Bahasa Korea';
        // $jadwal_pelatihan = 'Jadwal 1 (20 Oktober 2023 - 25 Oktober 2023)';

        $request->validate([
            'judul_voucher' => 'required',
            'prefix' => 'required',
            'nilai' => 'required',
            'jumlah' => 'required',
            'tgl_expired' => 'required'
        ]);

        $nama_pelatihan = $request->master_pelatihan;
        $keyWherePelatihan = explode('-', $nama_pelatihan);
        $keyWhere = trim($keyWherePelatihan[0], ' ');
        $harga_pelatihan = MasterPelatihan::where('nama_pelatihan', $keyWhere)->first();
        $harga_awal = $harga_pelatihan->harga_kelas;
        $prefix = $request->prefix;
        $prefixLength = strlen($request->prefix . '-');
        $judul_voucher = $request->judul_voucher;
        $nilai = $request->nilai;
        $jumlah = $request->jumlah;
        $tgl_expired = $request->tgl_expired;
        $harga_akhir = $harga_awal - $nilai;   // Nilai akhir
        $dataJSONArray = [];
        $sameVoucher = 0;
        $suksesVoucher = 0;
        // $sameValue = "ISW-10";

        for ($i = 1; $i <= $jumlah; $i++) {

            $voucher = GenerateVoucher::generateVoucher($prefix, $prefixLength); // Ini adalah function untuk generate kode voucher random
            $sameValue = Voucher::where('voucher', $voucher)->count();
            if ($sameValue >= 1) { // Cek apakah voucher baru hasil generate sudah exist atau belum
                $i--;
                $sameVoucher++;
            } else {
                // $dataObject = new stdClass();
                // $dataObject->nama_pelatihan = $nama_pelatihan;
                // $dataObject->judul_voucher = $judul_voucher;
                // $dataObject->voucher = $voucher;
                // $dataObject->harga_awal = $harga_awal;
                // $dataObject->nilai_diskon = $nilai;
                // $dataObject->harga_akhir = $harga_akhir;
                // $dataObject->tgl_expired = $tgl_expired;
                // $dataObject->voucher_ke = $i;
                // $dataJSON = json_encode($dataObject);
                // $dataJSONArray[] = $dataJSON;

                Voucher::create([
                    'nama_pelatihan' => $nama_pelatihan,
                    'judul_voucher' => $judul_voucher,
                    'voucher' => $voucher,
                    'nilai_diskon' => $nilai,
                    'tgl_expired' => $tgl_expired,
                ]);

                $suksesVoucher++;
            }
        }
        // $hasil = json_encode($dataJSONArray); // Konversi array to JSON
        // $hasilAkhir = json_decode($hasil);

        // dd(
        //     'Voucher yang sama = ' . $sameVoucher,
        //     'Voucher tidak sama = ' . $suksesVoucher,
        //     $hasilAkhir

        // );
        Session::flash('status', 'success');
        Session::flash('messages', 'Voucher yang berhasil dibuat ' . $suksesVoucher);
        Session::flash('failstatus', 'success');
        Session::flash('message', 'Kondisi generate yang diulang ' . $sameVoucher);
        return  redirect('/voucher');
    }

    public function delete(Request $request)
    {
        // Retrieve the selected voucher IDs from the request
        $selectedIds = $request->input('ids');

        $loop = count($selectedIds);

        if ($loop >= 1) {
            for ($i = 0; $i < $loop; $i++) {
                $voucher = Voucher::where('voucher', $selectedIds[$i]);

                $voucher->delete();
            }
        }


        // dd($selectedIds);

        // dd('ada delete');
        if ($voucher) {
            return response()->json(['message' => 'Vouchers deleted successfully']);
        } else {
        }
        return response()->json(['message' => 'Gagal Dihapus!']);
        // return response()->json(['message' => 'Vouchers deleted successfully']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVoucherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoucherRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function show(Voucher $voucher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function edit(Voucher $voucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVoucherRequest  $request
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoucherRequest $request, Voucher $voucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voucher $voucher)
    {
        //
    }
}
