<?php

namespace App\Helpers;

class Lingkaran
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
        
    public static function cetakLingkaran($jariJari)
    {
        $r = $jariJari;
        $luasLingkaran = 22 / 7 * $r * $r;

        return $luasLingkaran;
    }
}
