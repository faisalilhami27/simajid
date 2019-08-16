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
                'nilai_konfig' => 'Kp. Pasir Kelewih RT/RW 02/01 Kecamatan Sukanagara Desa Sukanagara Kabupaten Cianjur, Jawa Barat, 42364.'
            ],
            [
                'kode_konfig' => "KETUA",
                'nilai_konfig' => 'Lili Kusnadi, S.IP'
            ],
            [
                'kode_konfig' => "KOTA",
                'nilai_konfig' => 'Sukanagara'
            ],
            [
                'kode_konfig' => "LATITUDE",
                'nilai_konfig' => '-7.1002144'
            ],
            [
                'kode_konfig' => "LONGITUDE",
                'nilai_konfig' => '107.1285725'
            ],
            [
                'kode_konfig' => "METODE",
                'nilai_konfig' => '5'
            ],
            [
                'kode_konfig' => "NAMA_MESJID",
                'nilai_konfig' => 'Mesjid Nurul Huda'
            ],
            [
                'kode_konfig' => "RESET_PASSWORD",
                'nilai_konfig' => 'nurulhuda'
            ],
            [
                'kode_konfig' => "VERSION",
                'nilai_konfig' => '1.0'
            ],
        ]);
    }
}
