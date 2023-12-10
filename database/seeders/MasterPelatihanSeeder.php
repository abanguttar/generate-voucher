<?php

namespace Database\Seeders;

use App\Models\MasterPelatihan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MasterPelatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create('id_ID');
        MasterPelatihan::create([
            // 'id' =>     ,
            'nama_pelatihan' => $faker->name(),
            'jadwal' => $faker->name(),
            'jam_pelatihan' => $faker->dateTime(),
            'tipe' => 'daring',
            'harga_kelas' => $faker->randomNumber(6, true),
            'user_create' => 1,
            'user_update' => 1
        ]);
    }
}
