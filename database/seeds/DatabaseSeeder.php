<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserNavigationSeeder::class);
        $this->call(PengurusSeeder::class);
        $this->call(UserPengurusSeeder::class);
        $this->call(RoleLevelSeeder::class);
        $this->call(NavigationSeeder::class);
        $this->call(RoleUserPengurusSeeder::class);
        $this->call(KonfigurasiSeeder::class);
    }
}
