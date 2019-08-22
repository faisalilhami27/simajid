<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserNavigationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_navigation')->insert([
            [
                'id_user_level' => 1,
                'id_menu' => 1,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 1,
                'id_menu' => 2,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 1,
                'id_menu' => 3,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 1,
                'id_menu' => 4,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 1,
                'id_menu' => 5,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 1,
                'id_menu' => 15,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 1,
                'id_menu' => 16,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 1,
                'id_menu' => 17,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 1,
                'id_menu' => 18,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 1,
                'id_menu' => 19,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 1,
                'id_menu' => 20,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 5,
                'id_menu' => 2,
                'create' => 0,
                'read' => 1,
                'update' => 0,
                'delete' => 0,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 5,
                'id_menu' => 6,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 5,
                'id_menu' => 7,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 5,
                'id_menu' => 8,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 5,
                'id_menu' => 9,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 5,
                'id_menu' => 10,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 5,
                'id_menu' => 11,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 5,
                'id_menu' => 12,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 5,
                'id_menu' => 13,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 5,
                'id_menu' => 14,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 1,
                'id_menu' => 21,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'id_user_level' => 1,
                'id_menu' => 22,
                'create' => 1,
                'read' => 1,
                'update' => 1,
                'delete' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
