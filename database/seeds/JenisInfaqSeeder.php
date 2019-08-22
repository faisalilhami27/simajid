<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisInfaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_infaq')->insert([
            [
                'nama' => 'Infaq Jumat',
            ],
            [
                'nama' => 'Infaq Zakat',
            ]
        ]);
    }
}
