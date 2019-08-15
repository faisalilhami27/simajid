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
                'title' => 'Kelola Menu',
                'url' => 'navigation',
                'icon' => 'icon icon-server',
                'order_num' => 1,
                'order_sub' => 0,
                'is_main_menu' => 0,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'title' => 'Kelola Pengurus DKM',
                'url' => 'pengurus',
                'icon' => 'icon icon-user-plus',
                'order_num' => 2,
                'order_sub' => 0,
                'is_main_menu' => 0,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'title' => 'Level Pengguna',
                'url' => 'role_level',
                'icon' => 'icon icon-users',
                'order_num' => 3,
                'order_sub' => 0,
                'is_main_menu' => 0,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'title' => 'Akses User Navigasi',
                'url' => 'akses',
                'icon' => 'icon icon-universal-access',
                'order_num' => 4,
                'order_sub' => 0,
                'is_main_menu' => 0,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'title' => 'Kelola Pengguna',
                'url' => 'user',
                'icon' => 'icon icon-user',
                'order_num' => 5,
                'order_sub' => 0,
                'is_main_menu' => 0,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'title' => 'Konfigurasi Website',
                'url' => 'konfigurasi',
                'icon' => 'icon icon-gear',
                'order_num' => 6,
                'order_sub' => 0,
                'is_main_menu' => 0,
                'is_aktif' => 'y',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
