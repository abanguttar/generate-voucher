<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class GenerateVoucher
{

    // Membuat Helpers sendiri buat Folder Helpers->{namaHelpers.php} lalu 
    // Langkah selanjutnya adalah dengan membuat service provider, jalankan command berikut:
    // php artisan make:provider UserServiceProvider
    // Buka file app/Providers/UserServiceProvider.php 
    // public function register()
    // {
    //     require_once app_path() . '/Helpers/{namaHelpers}.php';
    //  }
    // buka file config/app.php
    // tambahkan code berikut pada bagian aliases:
    // 'UserHelp' => App\Helpers\{namaHelpers}::class,

    public static function generateVoucher($prefix, $prefixLength)
    {
        // $voucherGenerate = $prefix .'-'. uniqid();
        // Nilai konstant voucher berapa karakter
        // Total karakter length 20
        // Prefix - + sisa random
        $randomStrLength = 20 - $prefixLength;
        // dd($randomStrLength);
        // $define = "12";
        // $voucherGenerate = $prefix .'-'. Str::random(15);
        $voucherGenerate = $prefix . '-' . Str::random($randomStrLength);
        // $voucherGenerate = $prefix .'-'. rand(1, $define);

        return $voucherGenerate;
    }
}
