<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPemasukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_pemasukan')->insert([
            [
                'nama' => 'Infaq',
            ],
            [
                'nama' => 'Shodaqoh',
            ],
            [
                'nama' => 'Iuran',
            ],
        ]);
    }
}
