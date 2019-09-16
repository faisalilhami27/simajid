<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPengurusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_pengurus')->insert([
            [
                'nama' => 'DKM',
            ],
            [
                'nama' => 'Majelis Taklim',
            ],
            [
                'nama' => 'Remaja Mesjid',
            ],
        ]);
    }
}
