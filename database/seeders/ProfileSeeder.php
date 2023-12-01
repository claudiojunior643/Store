<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $roles = config('enums.profiles');

      collect($roles)->each(function ($role) {
        DB::table('profiles')->insert([
          'role' => $role,
          'active' => true,
        ]);
      });

    }
}
