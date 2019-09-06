<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('navigation')->insert([
            [
                'id' => 1,
                'title' => 'Jadwal Sholat',
                'url' => 'jadwal',
                'icon' => 'icon icon-clock-o',
                'order_num' => 1,
                'order_sub' => 0,
                'is_main_menu' => 0,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'title' => 'Donatur',
                'url' => 'donatur',
                'icon' => 'icon icon-users',
                'order_num' => 2,
                'order_sub' => 0,
                'is_main_menu' => 0,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'title' => 'Jabatan Kepengurusan',
                'url' => 'jabatan',
                'icon' => 'icon icon-user',
                'order_num' => 3,
                'order_sub' => 0,
                'is_main_menu' => 0,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'title' => 'Kepengurusan',
                'url' => 'pengurus.dkm',
                'icon' => 'icon icon-users',
                'order_num' => 4,
                'order_sub' => 0,
                'is_main_menu' => 0,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'title' => 'Pengurus',
                'url' => 'pengurus.dkm',
                'icon' => 'icon icon-user-plus',
                'order_num' => 5,
                'order_sub' => 0,
                'is_main_menu' => 4,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'title' => 'Jenis Data Keuangan',
                'url' => 'jenis_donatur',
                'icon' => 'icon icon-server',
                'order_num' => 6,
                'order_sub' => 0,
                'is_main_menu' => 0,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'title' => 'Jenis Donatur',
                'url' => 'jenis_donatur',
                'icon' => 'icon icon-server',
                'order_num' => 7,
                'order_sub' => 0,
                'is_main_menu' => 6,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 8,
                'title' => 'Jenis Infaq',
                'url' => 'jenis_infaq',
                'icon' => 'icon icon-server',
                'order_num' => 8,
                'order_sub' => 0,
                'is_main_menu' => 6,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 9,
                'title' => 'Jenis Pengeluaran',
                'url' => 'jenis_pengeluaran',
                'icon' => 'icon icon-server',
                'order_num' => 9,
                'order_sub' => 0,
                'is_main_menu' => 6,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 10,
                'title' => 'Pemasukan Keuangan',
                'url' => 'pemasukan.infaq',
                'icon' => 'icon icon-money',
                'order_num' => 10,
                'order_sub' => 0,
                'is_main_menu' => 0,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 11,
                'title' => 'Riwayat Pemasukan Infaq',
                'url' => 'pemasukan.infaq',
                'icon' => 'icon icon-server',
                'order_num' => 11,
                'order_sub' => 0,
                'is_main_menu' => 10,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 12,
                'title' => 'Riwayat Pemasukan Shodaqoh',
                'url' => 'pemasukan.shodaqoh',
                'icon' => 'icon icon-server',
                'order_num' => 12,
                'order_sub' => 0,
                'is_main_menu' => 10,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 13,
                'title' => 'Pengeluaran Keuangan',
                'url' => 'pengeluaran',
                'icon' => 'icon icon-money',
                'order_num' => 13,
                'order_sub' => 0,
                'is_main_menu' => 0,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 14,
                'title' => 'Riwayat Pengeluaran',
                'url' => 'pengeluaran',
                'icon' => 'icon icon-money',
                'order_num' => 14,
                'order_sub' => 0,
                'is_main_menu' => 13,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 21,
                'title' => 'Struktur Organisasi',
                'url' => 'struktur.dkm',
                'icon' => 'icon icon-th',
                'order_num' => 21,
                'order_sub' => 0,
                'is_main_menu' => 0,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 22,
                'title' => 'DKM',
                'url' => 'struktur.dkm',
                'icon' => 'icon icon-th',
                'order_num' => 15,
                'order_sub' => 0,
                'is_main_menu' => 21,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 23,
                'title' => 'Majelis Taklim',
                'url' => 'struktur.majelis',
                'icon' => 'icon icon-th',
                'order_num' => 15,
                'order_sub' => 0,
                'is_main_menu' => 21,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 24,
                'title' => 'Remaja Mesjid',
                'url' => 'struktur.remaja',
                'icon' => 'icon icon-th',
                'order_num' => 15,
                'order_sub' => 0,
                'is_main_menu' => 21,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 15,
                'title' => 'Pengaturan Aplikasi',
                'url' => 'konfigurasi',
                'icon' => 'icon icon-gear',
                'order_num' => 22,
                'order_sub' => 0,
                'is_main_menu' => 0,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 16,
                'title' => 'Kelola Menu',
                'url' => 'navigation',
                'icon' => 'icon icon-server',
                'order_num' => 16,
                'order_sub' => 0,
                'is_main_menu' => 15,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 17,
                'title' => 'Level Pengguna',
                'url' => 'role_level',
                'icon' => 'icon icon-users',
                'order_num' => 17,
                'order_sub' => 0,
                'is_main_menu' => 15,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 18,
                'title' => 'Akses User Navigasi',
                'url' => 'akses',
                'icon' => 'icon icon-universal-access',
                'order_num' => 18,
                'order_sub' => 0,
                'is_main_menu' => 15,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 19,
                'title' => 'Kelola Pengguna',
                'url' => 'user',
                'icon' => 'icon icon-user',
                'order_num' => 19,
                'order_sub' => 0,
                'is_main_menu' => 15,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id' => 20,
                'title' => 'Konfigurasi Website',
                'url' => 'konfigurasi',
                'icon' => 'icon icon-gear',
                'order_num' => 20,
                'order_sub' => 0,
                'is_main_menu' => 15,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
