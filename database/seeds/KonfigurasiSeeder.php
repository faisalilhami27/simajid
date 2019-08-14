<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KonfigurasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('konfigurasi')->insert([
            [
                'kode_konfig' => "ALAMAT_MESJID",
                'nilai_konfig' => 'Kp. Rawasari RT/RW 02/01 Kecamatan Sukanagara Desa Sukanagara Kabupaten Cianjur, Jawa Barat, 42364.'
            ],
            [
                'kode_konfig' => "LOGO_MESJID",
                'nilai_konfig' => 'img/logo2.png'
            ],
            [
                'kode_konfig' => "NAMA_MESJID",
                'nilai_konfig' => 'Mesjid Nurul Huda'
            ],
            [
                'kode_konfig' => "KETUA",
                'nilai_konfig' => 'Lili Kusnadi, S.IP'
            ],
            [
                'kode_konfig' => "RESET_PASSWORD",
                'nilai_konfig' => 'nurulhuda'
            ],
            [
                'kode_konfig' => "VERSION",
                'nilai_konfig' => '1.0'
            ]
        ]);
    }
}
