<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonaturSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('donatur')->insert([
            [
                'nama' => 'Hamba Allah',
                'id_jenis' => 1,
                'tempat_lahir' => null,
                'tanggal_lahir' => null,
                'jenis_kelamin' => null,
                'alamat' => null,
                'no_hp' => null
            ],
        ]);
    }
}
