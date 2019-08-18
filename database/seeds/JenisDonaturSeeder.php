<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisDonaturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_donatur')->insert([
            [
                'nama' => 'Donatur Tetap',
            ],
            [
                'nama' => 'Donatur Tidak Tetap',
            ],
            [
                'nama' => 'Donatur Bebas',
            ],
        ]);
    }
}
