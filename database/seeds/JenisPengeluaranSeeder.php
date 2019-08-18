<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class JenisPengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_pengeluaran')->insert([
            [
                'nama' => 'Pembelian',
            ],
            [
                'nama' => 'Pembayaran',
            ],
        ]);
    }
}
